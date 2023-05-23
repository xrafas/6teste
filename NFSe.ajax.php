<?php
session_start();
ob_start();
require_once '../_class/AutoLoad.php';
$DB = new Database();
$Ferraments = new Ferraments();

$jSON = array();
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$getGET = addslashes($_GET['action']);
if($getGET != ''){
    $getInfo = '1';
    $getPost = $_GET;
}elseif(empty($getPost['action'])){
    $getInfo = '0';
}else{
    $getInfo = '1';
}
if (empty($getPost['action'])):
    $jSON['msg'] = 'Uma ação não foi selecionada no formulário!';
    $jSON['type'] = 'error';
    $jSON['title'] = 'Erro';
else:
    $Post1 = array_map("strip_tags", $getPost);
    $Post = array_map("trim", $Post1);
    $Action = $Post['action'];
    unset($Post['action']);
    
    switch ($Action):
        case 'select':
            //PAGINATION
            $pag = (empty($_POST['pageNo']) ? '1' : $_GET['pageNo']);
            if(empty($_GET['size'])):
                $maximo = '100';
            else:
                $maximo = $_GET['size'];
            endif;
            $inicio = ($pag * $maximo) - $maximo;
            //ORDENATION
            if(empty($_GET['sort']) && empty($_GET['sort_dir'])):
                $order_by = "ORDER BY nfe_id DESC";
            else:
                $sort       = addslashes($_GET['sort']);
                $sort_dir   = addslashes($_GET['sort_dir']);
                $order_by   = "ORDER BY ".$sort." ".$sort_dir."";
            endif;
            //PESQUISAR
            if(isset($_POST['search']) && $_GET['search'] == 'true'):
                if($Post['id'] != ''):
                    $sql_id = "AND nfse_numero = '".$Post['id']."'";
                else:
                    $sql_id = "";
                endif;
                if($Post['status'] != ''):
                    $sql_status = "AND nfse_status = '".$Post['status']."'";
                else:
                    $sql_status = "";
                endif;
                if($Post['data_inicial'] != '' && $Post['data_final'] != ''):
                    $sql_periodo = "AND nfse_data_hora BETWEEN '".$Post['data_inicial']."' AND '".$Post['data_final']."'";
                else:
                    $sql_periodo = "";
                endif;
                $jSONsEARCH['type'] = 'ok';
                $jSONsEARCH['info'] = $Post;
                $_SESSION['search_nfse'] = $jSONsEARCH;
                $_SESSION['sql_nfse'] = " ".$sql_id." ".$sql_status." ".$sql_periodo." ";
            endif;
            //QUERY
            $read_nfe_paginator = $DB->ReadComposta("SELECT nfse_id, nfse_servico_valor_servico FROM nfse WHERE nfse_id != '' {$_SESSION['sql_nfse']}");
            if($DB->NumQuery($read_nfe_paginator) > '0'):
                foreach($read_nfe_paginator as $read_nfe_paginator_view):
                    $quantidade_nfe += '1';
                    $valor_total_nfe += $read_nfe_paginator_view['nfse_servico_valor_servico'];
                endforeach;
            endif;
            $read_nfe = $DB->Read('nfse', "WHERE nfse_id != '' {$_SESSION['sql_nfse']} ".$order_by." LIMIT $inicio,$maximo");
            if($DB->NumQuery($read_nfe) > '0'):
                $paginas = ceil($DB->NumQuery($read_nfe_paginator) / $maximo);
                $jSON["last_page"] = $paginas;
                $jSON["nfe_qtd"] = $quantidade_nfe;
                $jSON["nfe_valor"] = $valor_total_nfe;
                foreach($read_nfe as $read_nfe_view):
                    if($read_nfe_view['nfse_status'] == '0'):
                        $read_nfe_view['nfse_status'] = 'Em digitação';
                    elseif($read_nfe_view['nfse_status'] == '1'):
                        $read_nfe_view['nfse_status'] = 'Assinada';
                    elseif($read_nfe_view['nfse_status'] == '2'):
                        $read_nfe_view['nfse_status'] = 'Validada';
                    elseif($read_nfe_view['nfse_status'] == '3'):
                        $read_nfe_view['nfse_status'] = 'Autorizada';
                    elseif($read_nfe_view['nfse_status'] == '4'):
                        $read_nfe_view['nfse_status'] = 'Cancelada';
                    elseif($read_nfe_view['nfse_status'] == '5'):
                        $read_nfe_view['nfse_status'] = 'Autorizada(CCe)';
                    endif;
                    
                    $jSON['data'][] = $read_nfe_view;
                endforeach;
            endif;
            break;
        case 'search_load':
            unset($_SESSION['search_nfse']['info']['search']);
            $jSON = $_SESSION['search_nfse'];
            break;
        case 'create':
            if($Post['BnNF'] == ''):
                $Post['BnNF'] = $Ferraments->NextNFe($Ferraments->GetConfigNFe('config_nfe_ambiente'), $Ferraments->GetConfigNFe('config_nfe_serie'));
            endif;
            $Post['serie'] = $Ferraments->GetConfigNFe('config_nfe_serie');
            $Post['nfe_status'] = '0';
            $Post['nfe_ambiente'] = $Ferraments->GetConfigNFe('config_nfe_ambiente');
            if($DB->Create('nfe', $Post)):
                $read_ultima_nfe = $DB->ReadComposta("SELECT nfe_id FROM nfe ORDER BY nfe_id DESC LIMIT 1");
                if($DB->NumQuery($read_ultima_nfe) > '0'):
                    foreach($read_ultima_nfe as $read_ultima_nfe_view):
                        $itens_nfe_session_update['itens_nfe_session_type'] = $read_ultima_nfe_view['nfe_id'];
                        $DB->Update('itens_nfe_temp', $itens_nfe_session_update, "WHERE itens_nfe_session_type = '".$_SESSION['session_itens_nfe']."'");
                        $DB->Update('duplicata_nfe', $itens_nfe_session_update, "WHERE duplicata_nfe_id_nfe = '".$_SESSION['session_itens_nfe']."'");
                        $jSON['msg'] = "O registro foi gravado(a) com sucesso!";
                        $jSON['type'] = 'ok';
                        $jSON['title'] = 'Parabéns';
                    endforeach;
                endif;
            else:
                $jSON['msg'] = 'Houve algum problema!';
                $jSON['type'] = 'error';
                $jSON['title'] = 'Erro';
            endif;
            
            break;
        case 'select_id':
            $read_nfe = $DB->Read('nfe', "WHERE nfe_id = '".$Post['ide']."' AND nfe_status IN(0,1,2);");
            if($DB->NumQuery($read_nfe) > '0'):
                foreach($read_nfe as $read_nfe_view):
                endforeach;
                $jSON['type'] = 'ok';
                $jSON['info'] = $read_nfe_view;
            else:
                $jSON['msg'] = 'Não encontrei nenhum registro!';
                $jSON['type'] = 'error';
                $jSON['title'] = 'Erro';
            endif;
            break;
        case 'update':
            $ide = $Post['ide'];
            unset($Post['ide']);
            if($DB->Update('nfe', $Post, "WHERE nfe_id = '".$ide."'")):
                $jSON['msg'] = "O registro foi gravado(a) com sucesso!";
                $jSON['type'] = 'ok';
                $jSON['title'] = 'Parabéns';
            else:
                $jSON['msg'] = 'Houve algum problema!';
                $jSON['type'] = 'error';
                $jSON['title'] = 'Erro';
            endif;
            break;
    endswitch;
endif;
echo json_encode($jSON);