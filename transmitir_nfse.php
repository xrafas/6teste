<?php

include 'vendor/autoload.php';
//include_once('../session.php');
include_once('../../db_functions.php');

$con = dbConnect();

use CloudDfe\SdkPHP\Nfse;

$id_nota = $_POST['Id'];

//$sql_nfse = "SELECT * FROM nfse WHERE Id = " . $id_nota . " AND Codigo = " . $_SESSION['codigo'] . " ";
$sql_nfse = "SELECT * FROM nfse WHERE Id = " . $id_nota . " ";
$row = querySQL($con, $sql_nfse);


$date = new DateTime($row["Data_Emissao"]);

$tz = new DateTimeZone('America/Sao_Paulo');
$date->setTimezone($tz);

// converter para string no formato correto
$dataEmissao = $date->format('Y-m-d\TH:i:sP');

$date = new DateTime($row["Data_Competencia"]);
$date->setTimezone($tz);
$dataCompetencia = $date->format('Y-m-d\TH:i:sP');


try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjUxNjIsInVzciI6MTI1LCJ0cCI6MiwiaWF0IjoxNjgzNzI2NDI4fQ.McZnjqQluS3XASAY1zKhKxIM1fNQUG_4IAUQWznqMYk',
        'ambiente' => Nfse::AMBIENTE_PRODUCAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    //dados do RPS para geração da NFSe    
    $payload = [
        "numero" => $row["Numero"],
        "serie" => $row["Serie"],
        "tipo" => $row["Tipo"],
        "status" => $row["Status"],
        "data_emissao" => $dataEmissao,
        "data_competencia" => $dataCompetencia,
        "tomador" => [
            "cpf" => $row["Tomador_Cpf"],
            "razao_social" => $row["Tomador_Razao_Social"],
            "endereco" => [
                "logradouro" => $row["Tomador_Endereco_Logradouro"],
                "numero" => $row["Tomador_Endereco_Numero"],
                "bairro" => $row["Tomador_Endereco_Bairro"],
                "codigo_municipio" => $row["Tomador_Endereco_Codigo_Municipio"],
                "uf" => $row["Tomador_Endereco_Uf"],
                "cep" => $row["Tomador_Endereco_Cep"]
            ]
        ],
        "servico" => [
            "codigo" => $row["Servico_Codigo"],
            "codigo_cnae" => $row["Servico_Codigo_Cnae"],
            "codigo_tributacao_municipio" => $row["Servico_Codigo_Tributacao_Municipio"],
            "discriminacao" => $row["Servico_Discriminacao"],
            "codigo_municipio" => $row["Servico_Codigo_Municipio"],
            "codigo_municipio_prestacao" => $row["Servico_Codigo_Municipio_Prestacao"],
            "valor_servicos" => $row["Servico_Valor_Servicos"],
            "valor_deducoes" => $row["Servico_Valor_Deducoes"],
            "valor_pis" => $row["Servico_Valor_Pis"],
            "valor_cofins" => $row["Servico_Valor_Cofins"],
            "valor_inss" => $row["Servico_Valor_Inss"],
            "valor_ir" => $row["Servico_Valor_Ir"],
            "valor_csll" => $row["Servico_Valor_Csll"],
            "valor_outras" => $row["Servico_Valor_Outras"],
            "valor_iss" => $row["Servico_Valor_Iss"],
            "valor_aliquota" => $row["Servico_Valor_Aliquota"],
            "valor_desconto_condicionado" => $row["Servico_Valor_Desconto_Condicionado"],
            "valor_desconto_incondicionado" => $row["Servico_Valor_Desconto_Incondicionado"],
            "exigibilidade_iss" => $row["Servico_Exigibilidade_Iss"],
            "iss_retido" => $row["Servico_Iss_Retido"] == 1 ? "true" : "false"
        ],
        "informacoes_complementares" => $row["Informacoes_Complementares"]
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->cria($payload);

    if ($resp->sucesso) {
        echo formatSuccess($resp);
    } else {
        echo formatMessage($resp);
    }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
    

function formatMessage($message) {
    $html = "<h2>Status da Transmissão</h2>";
    $html .= "<ul>";
    $html .= "<li>Sucesso: " . (isset($message->sucesso) && $message->sucesso ? "Sim" : "Não") . "</li>";
    $html .= "<li>Código: {$message->codigo}</li>";
    $html .= "<li>Mensagem: {$message->mensagem}</li>";

    if (isset($message->chave)) {
        $html .= "<li>Chave: {$message->chave}</li>";
    }

    if (isset($message->erros)) {
        $html .= "<li>Erros: ";
        $html .= "<ul>";
        foreach ($message->erros as $error) {
            $html .= "<li>Campo: {$error->campo}</li>";
            $html .= "<li>Erro: {$error->erro}</li>";
            $html .= "<li>Descrição: {$error->descricao}</li>";
            $html .= "<li>Detalhes: {$error->detalhes}</li>";
        }
        $html .= "</ul>";
        $html .= "</li>";
    }
    $html .= "</ul>";
    return $html;
}

function formatSuccess($message) {
    $html = "<h2>Detalhes da Nota Fiscal</h2>";
    $html .= "<ul>";
    $html .= "<li>Sucesso: " . ($message->sucesso ? "Sim" : "Não") . "</li>";
    $html .= "<li>Código: {$message->codigo}</li>";
    $html .= "<li>Mensagem: {$message->mensagem}</li>";
    $html .= "<li>Status: {$message->status}</li>";
    $html .= "<li>Chave: {$message->chave}</li>";
    $html .= "<li>Data e hora do evento: {$message->data_hora_evento}</li>";
    $html .= "<li>Número: {$message->numero}</li>";
    $html .= "<li>Série do RPS: {$message->rps_serie}</li>";
    $html .= "<li>Número do RPS: {$message->rps_numero}</li>";
    $html .= "<li>Código de verificação: {$message->codigo_verificacao}</li>";
    $html .= "<li>Link do PDF: <a href='{$message->link_pdf}'>Link</a></li>";
    $html .= "</ul>";
    return $html;
}

