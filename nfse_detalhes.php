<?php
include("topo.php");

date_default_timezone_set('America/Sao_Paulo');

?>

<div class="content well span12">
    <div class="row">
        <div class="span12">
            <h2 class="text-center">Detalhes NFSe</h2>

            <hr>

            <div class="box-form-container">

                <?php

                $id_nota_fiscal = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

                $sql = "SELECT * FROM nfse WHERE Id = " . $id_nota_fiscal . " AND Codigo = " . $_SESSION['codigo'] . " ";
                $result = querySQL($con, $sql);

                // Verificar se há resultados
                if (!$result) {
                    echo "<h1 class='text-center'>O número da nota fiscal não foi encontrado.</h1>";
                } else {

                    $link_pdf = $result['Link_Pdf'];

                    if ($result['Status'] == '0') :
                        $result['Status'] = 'Em digitação';
                    elseif ($result['Status'] == '1') :
                        $result['Status'] = 'Assinada';
                    elseif ($result['Status'] == '2') :
                        $result['Status'] = 'Validada';
                    elseif ($result['Status'] == '3') :
                        $result['Status'] = 'Autorizada';
                    elseif ($result['Status'] == '4') :
                        $result['Status'] = 'Cancelada';
                    elseif ($result['Status'] == '5') :
                        $result['Status'] = 'Autorizada(CCe)';
                    endif;


                    if (($result['Status'] == 'Autorizada') || ($result['Status'] == 'Autorizada(CCe)')) {
                        
                        $botões = '<button id="notaCancelarButton"  class="button-spacing"  style="margin-right: 10px;" type="button">Cancelar Nota</button>
<button id="consultarButton"  class="button-spacing" type="button" style="margin-right: 10px;">Consultar</button>

<li>
            <a href="' . $link_pdf . '">
                <label><i>PDF</i></label>
            </a>
        </li>

';
                    } elseif ($result['Status'] == 'Cancelada') {
                        $botões = '<button id="consultarButton"  class="button-spacing" type="button"  style="margin-right: 10px;">Consultar</button>
                        <li>
            <a href="' . $link_pdf . '">
                <label><i>PDF</i></label>
            </a>
        </li>';
                    } else {
                        $botões = '<button id="editButton"  class="button-spacing" type="button" style="margin-right: 10px;">Editar</button>

<button id="transmitirButton"  class="button-spacing" type="button" style="margin-right: 10px;">Transmitir</button>

<button id="cancelarEdiButton" type="button"  class="button-spacing" style="display:none;  margin-right: 10px;">Cancelar Edição</button>

<input type="submit"  class="button-spacing" value="Salvar" id="saveButton" style="display:none;  margin-right: 10px;"> 

<button id="consultarButton"  class="button-spacing" type="button">Consultar</button>

    ';
                    }






                    echo '

                    <div id="resultados">
                    <div id="transmitir1"></div>
                    <div id="transmitir2"></div>
                    </div>

<form method="post">

<input type="hidden" id="id_nota_fiscal" name="id_nota_fiscal" value="' . $id_nota_fiscal . '" readonly="true">

<input type="hidden" id="Chave" name="Chave" value="' . $result['Chave'] . '" readonly="true">

' . $botões . '

<br><br>


<ul>

<li>
            <label for="Status">Status:</label>
            <b>' . $result['Status'] . '</b>
        </li>
        <br>


  

        <li>
            <label for="numero">Número:</label>
            <input type="number" id="numero" name="numero" value="' . $result['Numero'] . '" readonly="true">
        </li>
        <li>
            <label for="data_emissao">Data de Emissão:</label>
            <input type="datetime-local" id="data_emissao" name="data_emissao" value="' . $result['Data_Emissao'] . '" readonly="true">
        </li>
        <li>
            <label for="data_competencia">Data de Competência:</label>
            <input type="datetime-local" id="data_competencia" name="data_competencia" value="' . $result['Data_Competencia'] . '" readonly="true">
        </li>
    </ul>
    <br>

    <b>Prestador:</b><br><br>
    <ul>
        <li>
            <label for="prestador_cnpj">CNPJ:</label>
            <input type="text" id="prestador_cnpj" name="prestador_cnpj" value="' . $result['Prestador_Cnpj'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_razao_social">Razão Social:</label>
            <input type="text" id="prestador_razao_social" name="prestador_razao_social" value="' . $result['Prestador_Razao_Social'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_logradouro">Logradouro:</label>
            <input type="text" id="prestador_logradouro" name="prestador_logradouro" value="' . $result['Prestador_Endereco_Logradouro'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_numero">Número:</label>
            <input type="text" id="prestador_numero" name="prestador_numero" value="' . $result['Prestador_Endereco_Numero'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_bairro">Bairro:</label>
            <input type="text" id="prestador_bairro" name="prestador_bairro" value="' . $result['Prestador_Endereco_Bairro'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_codigo_municipio">Código do Município:</label>
            <input type="text" id="prestador_codigo_municipio" name="prestador_codigo_municipio" value="' . $result['Prestador_Endereco_Codigo_Municipio'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_uf">UF:</label>
            <input type="text" id="prestador_uf" name="prestador_uf" value="' . $result['Prestador_Endereco_Uf'] . '" readonly="true">
        </li>
        <li>
            <label for="prestador_cep">CEP:</label>
            <input type="text" id="prestador_cep" name="prestador_cep" value="' . $result['Prestador_Endereco_Cep'] . '" readonly="true">
        </li>

    </ul>

    <br>
    <b>Tomador:</b><br><br>
    <ul>
        <li>
            <label for="tomador_cpf">CPF:</label>
            <input type="text" id="tomador_cpf" name="tomador_cpf" value="' . $result['Tomador_Cpf'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_cnpj">CNPJ:</label>
            <input type="text" id="tomador_cnpj" name="tomador_cnpj" value="' . $result['Tomador_Cnpj'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_razao_social">Razão Social:</label>
            <input type="text" id="tomador_razao_social" name="tomador_razao_social" value="' . $result['Tomador_Razao_Social'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_logradouro">Logradouro:</label>
            <input type="text" id="tomador_logradouro" name="tomador_logradouro" value="' . $result['Tomador_Endereco_Logradouro'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_numero">Número:</label>
            <input type="text" id="tomador_numero" name="tomador_numero" value="' . $result['Tomador_Endereco_Numero'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_bairro">Bairro:</label>
            <input type="text" id="tomador_bairro" name="tomador_bairro" value="' . $result['Tomador_Endereco_Bairro'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_codigo_municipio">Código do Município:</label>
            <input type="text" id="tomador_codigo_municipio" name="tomador_codigo_municipio" value="' . $result['Tomador_Endereco_Codigo_Municipio'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_uf">UF:</label>
            <input type="text" id="tomador_uf" name="tomador_uf" value="' . $result['Tomador_Endereco_Uf'] . '" readonly="true">
        </li>
        <li>
            <label for="tomador_cep">CEP:</label>
            <input type="text" id="tomador_cep" name="tomador_cep" value="' . $result['Tomador_Endereco_Cep'] . '" readonly="true">
        </li>

    </ul>

    <b>Serviço:</b><br><br>
    <ul>
        <li>
            <label for="servico_codigo">Código:</label>
            <input type="text" id="servico_codigo" name="servico_codigo" value="' . $result['Servico_Codigo'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_codigo_cnae">Código CNAE:</label>
            <input type="text" id="servico_codigo_cnae" name="servico_codigo_cnae" value="' . $result['Servico_Codigo_Cnae'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_codigo_tributacao_municipio">Código de Tributação do Município:</label>
            <input type="text" id="servico_codigo_tributacao_municipio" name="servico_codigo_tributacao_municipio" value="' . $result['Servico_Codigo_Tributacao_Municipio'] . '" readonly="true">
        </li>
        <br>
        <li>
            <label for="servico_discriminacao">Discriminação:</label>
            <textarea id="servico_discriminacao" name="servico_discriminacao" rows="4" cols="30" readonly="true">' . $result['Servico_Discriminacao'] . '</textarea>
        </li>
        <br>
        <li>
            <label for="servico_codigo_municipio">Código do Município:</label>
            <input type="text" id="servico_codigo_municipio" name="servico_codigo_municipio" value="' . $result['Servico_Codigo_Municipio'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_codigo_municipio_prestacao">Código do Município de Prestação:</label>
            <input type="text" id="servico_codigo_municipio_prestacao" name="servico_codigo_municipio_prestacao" value="' . $result['Servico_Codigo_Municipio'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_servicos">Valor dos Serviços:</label>
            <input type="text" id="servico_valor_servicos" name="servico_valor_servicos" value="' . $result['Servico_Valor_Servicos'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_deducoes">Valor das Deduções:</label>
            <input type="text" id="servico_valor_deducoes" name="servico_valor_deducoes" value="' . $result['Servico_Valor_Deducoes'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_pis">Valor PIS:</label>
            <input type="text" id="servico_valor_pis" name="servico_valor_pis" value="' . $result['Servico_Valor_Pis'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_cofins">Valor COFINS:</label>
            <input type="text" id="servico_valor_cofins" name="servico_valor_cofins" value="' . $result['Servico_Valor_Cofins'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_inss">Valor INSS:</label>
            <input type="text" id="servico_valor_inss" name="servico_valor_inss" value="' . $result['Servico_Valor_Inss'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_ir">Valor IR:</label>
            <input type="text" id="servico_valor_ir" name="servico_valor_ir" value="' . $result['Servico_Valor_Ir'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_csll">Valor CSLL:</label>
            <input type="text" id="servico_valor_csll" name="servico_valor_csll" value="' . $result['Servico_Valor_Csll'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_outras">Valor Outras:</label>
            <input type="text" id="servico_valor_outras" name="servico_valor_outras" value="' . $result['Servico_Valor_Outras'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_iss">Valor ISS:</label>
            <input type="text" id="servico_valor_iss" name="servico_valor_iss" value="' . $result['Servico_Valor_Iss'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_aliquota">Valor Alíquota:</label>
            <input type="text" id="servico_valor_aliquota" name="servico_valor_aliquota" value="' . $result['Servico_Valor_Aliquota'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_desconto_condicionado">Valor do Desconto Condicionado:</label>
            <input type="text" id="servico_valor_desconto_condicionado" name="servico_valor_desconto_condicionado" value="' . $result['Servico_Valor_Desconto_Condicionado'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_valor_desconto_incondicionado">Valor do Desconto Incondicionado:</label>
            <input type="text" id="servico_valor_desconto_incondicionado" name="servico_valor_desconto_incondicionado" value="' . $result['Servico_Valor_Desconto_Incondicionado'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_exigibilidade_iss">Exigibilidade ISS:</label>
            <input type="text" id="servico_exigibilidade_iss" name="servico_exigibilidade_iss" value="' . $result['Servico_Exigibilidade_Iss'] . '" readonly="true">
        </li>
        <li>
            <label for="servico_iss_retido">ISS Retido:</label>
            <input type="text" id="servico_iss_retido" name="servico_iss_retido" value="' . $result['Servico_Iss_Retido'] . '" readonly="true">
        </li>

    </ul>

    <br>
    Informações Complementares (Opcional):<br><br>

    <li>
        <textarea id="informacoes_complementares" name="informacoes_complementares" rows="3" cols="30" readonly="true">' . $result['Informacoes_Complementares'] . '</textarea>
    </li>

    </ul>

    
   

</form>
';

                ?>

            </div><!--CONTAINER-->

        </div><!--Span-->

    </div><!--Row-->

</div><!--Content-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editButton').click(function() {
            $('form input').removeAttr('readonly');
            $('form textarea').removeAttr('readonly');
            $('#editButton').hide();
            $('#transmitirButton').hide();
            $('#notaCancelarButton').hide();
            $('#consultarButton').hide();
            $('#saveButton').show();
            $('#cancelarEdiButton').show();
        });

        //$('#saveButton').click(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            var confirmacao = confirm("Todos os dados da Nota Fiscal de Serviço Eletronica estão corretos?");

            if (confirmacao == true) {
                var formData = $(this).serialize();

                $.ajax({
                    url: 'nfse_edit_uptd_ajax.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {

                        //console.log('sql_string: ' + data.sql_string);
                        //console.log('id_nota_fiscal: ' + data.id_nota_fiscal);

                        if (data.error) {
                            console.log('Erro no PHP: ' + data.error);
                        }

                        if (data.exists) {
                            alert("O número de nota fiscal já existe.");
                        } else if (data.saved) {
                            //if (data.saved) {
                            alert("Nota Fiscal salva com sucesso.");
                            $('form input').attr('readonly', 'readonly');
                            $('form textarea').attr('readonly', 'readonly');
                            $('#saveButton').hide();
                            $('#cancelarEdiButton').hide();
                            $('#editButton').show();
                            $('#transmitirButton').show();
                            $('#notaCancelarButton').show();
                            $('#consultarButton').show();
                            console.log(data);


                        } else {
                            alert("Houve um erro ao salvar a Nota Fiscal. Tente novamente.");
                            console.log(data);

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText); // Mostrar a saída do script PHP
                        console.log(textStatus, errorThrown);
                        alert("Erro ao salvar a nota fiscal. Verifique com o suporte para mais detalhes.");
                    }

                });
            } else {
                // Se o usuário clicar em 'cancelar' na caixa de confirmação, não faça nada
            }
        });

        $('#cancelarEdiButton').click(function() {
            //document.querySelector('#btnCancelar').addEventListener('click', function() {
            window.location.reload();
        });



        $('#notaCancelarButton').click(function(e) {
            e.preventDefault();
            var Id = $("#id_nota_fiscal").val();

            // Solicita a justificativa para o cancelamento
            var Justificativa = prompt("Por favor, forneça uma justificativa para o cancelamento (mínimo de 15 caracteres).");
            if (Justificativa == null || Justificativa == "") {
                alert("Cancelamento abortado. Nenhuma justificativa foi fornecida.");
                return; // Cancela a operação se o usuário não fornecer uma justificativa
            } else if (Justificativa.length < 15) {
                alert("Cancelamento abortado. A justificativa fornecida é muito curta.");
                return; // Cancela a operação se a justificativa for muito curta
            }

            $.ajax({
                url: 'nfse/cancelar_nota_nfse.php',
                type: 'POST',
                data: {
                    Id: Id,
                    Justificativa: Justificativa // Envia a justificativa para o servidor
                },
                success: function(data) {
                    $('#resultados').append("<p>" + data + "</p>"); // Adiciona o resultado à div
                    alert('Nota cancelada com sucesso!');

                    var response = JSON.parse(data); // parse the response into JSON
                    // Check if the response was successful and the status is 3
                    if (response.sucesso == '1') {
                        $('#saveButton').hide();
                        $('#cancelarEdiButton').hide();
                        $('#editButton').hide();
                        $('#transmitirButton').hide();
                        $('#notaCancelarButton').hide();
                        $('#consultarButton').show();

                       
                        $('#status').text('Cancelada');                        

                    }


                },
                error: function(xhr, status, error) {
                    // Código para executar se a solicitação falhar
                    alert('Falha ao cancelar a nota. Por favor, tente novamente.');
                }
            });
        });





        $('#transmitirButton').click(function(e) {
            e.preventDefault();
            var Id = $("#id_nota_fiscal").val();

            $.ajax({
                type: 'POST',
                url: 'nfse/transmitir_nfse.php',
                data: {
                    Id: Id
                },
                success: function(data2) {
                    $('#resultados').append("<p>" + data2 + "</p>"); // Adiciona o resultado à div
                    //alert(data2);
                    alert('Dados enviados com sucesso!');

                    var response = JSON.parse(data2); // parse the response into JSON
                    // Check if the response was successful and the status is 3
                    if (response.sucesso == '1') {
                        $('#saveButton').hide();
                        $('#cancelarEdiButton').hide();
                        $('#editButton').hide();
                        $('#transmitirButton').hide();
                        $('#notaCancelarButton').show();
                        $('#consultarButton').show();


                        $('#status').text('Autorizada');

                        // Atualizando o campo chave
                        $('#Chave').val(response.chave);

                        $('li#pdf-link').html(
                            '<a href="' + response.link_pdf + '">' +
                            '<label><i>PDF</i></label><i class="fas fa-info-circle"></i>' +
                            '</a>'
                        );

                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });


    }); //final do ready function.
</script>

<?php }
                include("base.php"); ?>
