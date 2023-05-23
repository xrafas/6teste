<div class="container-fluid nav-hidden" id="content">
    <div id="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-title">
                            <h3>
                                NFSe
                                <a href="javascript::" onclick="carrega_pagina('nfse', 'index.php');" class="btn btn-primary">VOLTAR</a>
                            </h3>
                        </div>
                        <div class="box-content">
                            <ul class="tabs tabs-inline tabs-top">
                                <li class='active'>
                                    <a href="#tab1" data-toggle='tab'>
                                        Principal
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle='tab'>
                                        Tomador
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle='tab'>
                                        Intermediário
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle='tab'>
                                        Serviço
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab5" data-toggle='tab'>
                                        Impostos
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab6" data-toggle='tab'>
                                        Impostos
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab7" data-toggle='tab'>
                                        Dados Complementares
                                    </a>
                                </li>
                            </ul>
                            <form class="wc_form" action="" method="POST">
                                <div class="tab-content padding tab-content-inline tab-content-bottom">
                                    <div class="tab-pane active" id="tab1">
                                        <div class="row">
                                            <div class="form-group col-lg-3">
                                                <label>Num NFSe (<a href="#" onclick="open_modal_mudar_num_nfe();">mudar</a>)</label>
                                                <input type="text" class="form-control BnNF" name="nfse_numero" readonly="" autocomplete="off"/>
                                                <input type="hidden" name="action" value="create"/>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label>Data Hora</label>
                                                <input type="datetime-local" class="form-control" name="nfse_data_hora" autocomplete="off" value="<?php echo date('Y-m-d H:i:s');?>"/>
                                                <input type="hidden" name="action" value="create"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label>ID Contato</label>
                                                <input type="text" class="form-control autocomplete_id_contato" autocomplete="off" onblur="carrega_contato();"/>
                                            </div>
                                            <div class="form-group col-lg-10">
                                                <label>Contato (Nome / Razão Social, Fantasia e CPF / CNPJ)</label>
                                                <input type="text" class="form-control autocomplete_contato" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label>Razão/Nome</label>
                                                <input type="text" class="form-control nfse_tomador_razao_social" name="nfse_tomador_razao_social" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label>CNPJ/CPF</label>
                                                <input type="text" class="form-control nfse_tomador_cpf_cnpj" name="nfse_tomador_cpf_cnpj" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label>IM</label>
                                                <input type="text" class="form-control nfse_tomador_im" name="nfse_tomador_im" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label>CEP ( <a href="#" onclick="load_cep();">buscar</a>)</label>
                                                <input type="text" class="form-control cep nfse_tomador_endereco_cep" name="nfse_tomador_endereco_cep" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Endereço</label>
                                                <input type="text" class="form-control cep_endereco nfse_tomador_endereco_logradouro" name="nfse_tomador_endereco_logradouro" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Número</label>
                                                <input type="text" class="form-control nfse_tomador_endereco_numero" name="nfse_tomador_endereco_numero" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Complemento</label>
                                                <input type="text" class="form-control cep_complemento nfse_tomador_endereco_complemento" name="nfse_tomador_endereco_complemento" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control cep_bairro nfse_tomador_endereco_bairro" name="nfse_tomador_endereco_bairro" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Cidade</label>
                                                <input type="text" class="form-control cep_cidade ExMun" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Código IBGE</label>
                                                <input type="text" class="form-control cep_cidade_ibge nfse_tomador_endereco_codigo_municipio" name="nfse_tomador_endereco_codigo_municipio" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>UF</label>
                                                <input type="text" class="form-control cep_uf nfse_tomador_endereco_uf" name="nfse_tomador_endereco_uf" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <div class="row">
                                            <p align="center">Caso queira usar, basta preencher</p>
                                            <div class="form-group col-lg-6">
                                                <label>Razão Social</label>
                                                <input type="text" class="form-control" name="nfse_intermediario_razao_social" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label>CPF / CNPJ</label>
                                                <input type="text" class="form-control" name="nfse_intermediario_cpf_cnpj" autocomplete="off"/>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label>IM</label>
                                                <input type="text" class="form-control" name="nfse_intermediario_im" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label>Situação Tributária</label>
                                                <div class="input-group">
                                                    <select name="SCST" class="form-control carrega_cofins" onchange="carrega_cofinsst();"></select>
                                                    <a href="#" onclick="load_cofins_select();" title="Carregar Registros" class="btn input-group-addon username-check-force">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="load_cst_cofins"></div>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label>Situação Tributária</label>
                                                <div class="input-group">
                                                    <select name="NCST" class="form-control carrega_icms" onchange="carrega_icmsst();"></select>
                                                    <a href="#" onclick="load_icms_select();" title="Carregar Registros" class="btn input-group-addon username-check-force">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="load_cst_icms"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12" align="right">
                                        <button class="btn btn-primary">GRAVAR</button>
                                        <a href="javascript::" onclick="carrega_pagina('caixa', 'index.php');" class="btn btn-danger">VOLTAR</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="_modal_new_num_nfe" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Mudar Número NFSe</h4>
            </div>
            <!-- /.modal-header -->
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <label>Número escolhido</label>
                        <input type="number" class="form-control mudar_num_nfe_codigo" autocomplete="off"/>
                    </div>
                </div>
            </div>
            <!-- /.modal-body -->
            <div class="modal-footer">
                <a href="javascript::" onclick="update_modal_mudar_num_nfe();" class="btn btn-success" data-dismiss="modal">MUDAR</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $('.wc_form').submit(function () {
        var Form = $(this);
        var Data = Form.serialize();

        $.ajax({
            url: "_controller/Tributacao.ajax.php",
            data: Data,
            type: 'POST',
            dataType: 'json',
            beforeSend: load_in(),
            success: function (data) {
                if(data.type === 'error'){
                    notify(data.title, data.msg);
                }else{
                    notify(data.title, data.msg);
                    $('.wc_form')[0].reset();
                }
                load_out();
            }
        });
        return false;
    });
    $(function(){
        $( ".autocomplete_contato" ).autocomplete({
            source: "_controller/AutoComplete.ajax.php?action=load_contato",
            minLength: 2,
            focus: function(event, ui) {
                event.preventDefault();
            },
            select: function( event, ui ) {
                $(".autocomplete_id_contato").val(ui.item.value);
                $(".autocomplete_contato").val(ui.item.label);
                
                carrega_contato();
                event.preventDefault();
            }
        });
    });
    function carrega_contato(){
        var ide = $(".autocomplete_id_contato").val();
        var acao = "action=load_id_contato&ide="+ide;
        $.ajax({
            type: 'GET',
            url: "_controller/AutoComplete.ajax.php",
            data: acao,
            beforeSend: load_in(),
            async: false,
            success: function (data) {
                var data_return = jQuery.parseJSON(data);
                if(data_return.type === 'error'){
                    $(".autocomplete_id_contato").val('');
                    $(".autocomplete_contato").val('');
                    var unique_id = $.gritter.add({
                        title: 'Erro',
                        text: 'Registro nÃ£o encontrado',
                        sticky: false,
                        image: null,
                        time: '2000'
                    });
                    return false;
                }else{
                    $(".autocomplete_id_contato").val(data_return.value);
                    $(".autocomplete_contato").val(data_return.label);

                    $(".nfse_tomador_razao_social").val(data_return.label_complete.contato_nome_razao);
                    $(".nfse_tomador_cpf_cnpj").val(data_return.label_complete.contato_cpf_cnpj);
                    $(".nfse_tomador_endereco_cep").val(data_return.label_complete.contato_cep);
                    $(".nfse_tomador_endereco_logradouro").val(data_return.label_complete.contato_endereco);
                    $(".nfse_tomador_endereco_numero").val(data_return.label_complete.contato_numero);
                    $(".nfse_tomador_endereco_complemento").val(data_return.label_complete.contato_complemento);
                    $(".nfse_tomador_endereco_bairro").val(data_return.label_complete.contato_bairro);
                    $(".ExMun").val(data_return.label_complete.contato_cidade);
                    $(".nfse_tomador_endereco_codigo_municipio").val(data_return.label_complete.contato_cidade_ibge);
                    $(".nfse_tomador_endereco_uf").val(data_return.label_complete.contato_estado);
                    $(".nfse_tomador_im").val(data_return.label_complete.contato_im);
                }
                load_out();
            }
        });
        load_out();
    }
    function open_modal_mudar_num_nfe(){
        $("#_modal_new_num_nfe").modal('show');
    }
    function update_modal_mudar_num_nfe(){
        var num_escolhido = $(".mudar_num_nfe_codigo").val();
        $(".BnNF").val(num_escolhido);
    }
</script>