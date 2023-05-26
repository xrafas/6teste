<?php include("topo.php");


date_default_timezone_set('America/Sao_Paulo');



?>

<div class="content well span12">
    <div class="row">
        <div class="span12">
            <h2 class="text-center">Nova NFSe</h2>


            <hr>

            <div class="box-form-container">


                <?php

                $sql = "SELECT * FROM empresa WHERE Codigo = " . $_SESSION['codigo'] . " ";
                $result = querySQL($con, $sql);

                $stmt = "SELECT * FROM nfse_tomador WHERE Codigo = " . $_SESSION['codigo'] . " ";
                $tomadores = dataSQL($con, $stmt);


                $sql_numero = "SELECT MAX(Numero) AS MaxNumero FROM nfse WHERE Codigo = '" . $_SESSION['codigo'] . "' ";
                $result_numero = querySQL($con, $sql_numero);
                $prox_num = $result_numero['MaxNumero'] + 1;




                echo '
                
                <form method="post" >

                <ul>

                <ul>
                <li>
                <label for="numero">Número:</label>
                <input type="number" id="numero" name="numero" value="' . $prox_num . '">
            </li>
            <li>
                <label for="data_emissao">Data de Emissão:</label>
                <input type="datetime-local" id="data_emissao" name="data_emissao" value="' . date('Y-m-d\TH:i:s') . '">

            </li>
            <li>
                <label for="data_competencia">Data de Competência:</label>
                <input type="datetime-local" id="data_competencia" name="data_competencia" value="' . date('Y-m-d\TH:i:s') . '">
            </li>
            </ul>
            <br>

                <b>Prestador:</b><br><br>
                <ul>
                <li>
                    <label for="prestador_cnpj">CNPJ:</label>
                    <input type="text" id="prestador_cnpj" name="prestador_cnpj" value="' . $result['Cnpj'] . '">
                </li>
                <li>
                    <label for="prestador_razao_social">Razão Social:</label>
                    <input type="text" id="prestador_razao_social" name="prestador_razao_social" value="' . $result['Razao_Social'] . '">
                </li>
                <li>
                    <label for="prestador_logradouro">Logradouro:</label>
                    <input type="text" id="prestador_logradouro" name="prestador_logradouro" value="' . $result['Endereco_Logradouro'] . '">
                </li>
                <li>
                    <label for="prestador_numero">Número:</label>
                    <input type="text" id="prestador_numero" name="prestador_numero" value="' . $result['Endereco_Numero'] . '">
                </li>
                <li>
                    <label for="prestador_bairro">Bairro:</label>
                    <input type="text" id="prestador_bairro" name="prestador_bairro" value="' . $result['Endereco_Bairro'] . '">
                </li>
                <li>
                    <label for="prestador_codigo_municipio">Código do Município:</label>
                    <input type="text" id="prestador_codigo_municipio" name="prestador_codigo_municipio" value="' . $result['Endereco_Codigo_Municipio'] . '">
                </li>
                <li>
                    <label for="prestador_uf">UF:</label>
                    <input type="text" id="prestador_uf" name="prestador_uf" value="' . $result['Endereco_Uf'] . '">
                </li>
                <li>
                    <label for="prestador_cep">CEP:</label>
                    <input type="text" id="prestador_cep" name="prestador_cep" value="' . $result['Endereco_Cep'] . '">
                </li>
                
                </ul>
            
                <br>
                <b>Tomador:</b><br><br>                
                <ul>
                

                <li>
Selecione um Tomador:<br>
<select id="tomador_select">
<option value=""></option>
';
                foreach ($tomadores as $tomador) { ?>
                    <option value="<?php echo $tomador['Id']; ?>"><?php echo $tomador['Razao_Social']; ?></option>
                <?php } ?>
                </select>
                <button id="btn_carregar">Carregar</button>
                </li>
                <br>
                <?php
                echo '
<li>
                    <label for="tomador_cpf">CPF:</label>
                    <input type="text" id="tomador_cpf" name="tomador_cpf" value="">
                </li>
                <li>
                    <label for="tomador_cnpj">CNPJ:</label>
                    <input type="text" id="tomador_cnpj" name="tomador_cnpj" value="">
                </li>
                <li>
                    <label for="tomador_razao_social">Razão Social:</label>
                    <input type="text" id="tomador_razao_social" name="tomador_razao_social" value="">
                </li>
                <li>
                    <label for="tomador_logradouro">Logradouro:</label>
                    <input type="text" id="tomador_logradouro" name="tomador_logradouro" value="">
                </li>
                <li>
                    <label for="tomador_numero">Número:</label>
                    <input type="text" id="tomador_numero" name="tomador_numero" value="">
                </li>
                <li>
                    <label for="tomador_bairro">Bairro:</label>
                    <input type="text" id="tomador_bairro" name="tomador_bairro" value="">
                </li>
                <li>
                    <label for="tomador_codigo_municipio">Código do Município:</label>
                    <input type="text" id="tomador_codigo_municipio" name="tomador_codigo_municipio" value="">
                </li>
                <li>
                    <label for="tomador_uf">UF:</label>
                    <input type="text" id="tomador_uf" name="tomador_uf" value="">
                </li>
                <li>
                    <label for="tomador_cep">CEP:</label>
                    <input type="text" id="tomador_cep" name="tomador_cep" value="">
                </li>
               
                </ul>
            
                  <b>Serviço:</b><br><br>
    <ul>
    <li>
        <label for="servico_codigo">Código:</label>
        <input type="text" id="servico_codigo" name="servico_codigo" 
        value="' . $result['Servico_Codigo'] . '">
    </li>
    <li>
        <label for="servico_codigo_cnae">Código CNAE:</label>
        <input type="text" id="servico_codigo_cnae" name="servico_codigo_cnae" 
        value="' . $result['Servico_Codigo_Cnae'] . '">
    </li>
    <li>
        <label for="servico_codigo_tributacao_municipio">Código de Tributação do Município:</label>
        <input type="text" id="servico_codigo_tributacao_municipio" name="servico_codigo_tributacao_municipio" 
        value="' . $result['Servico_Codigo_Tributacao_Municipio'] . '">
    </li>
    <br>
    <li>
        <label for="servico_discriminacao">Discriminação:</label>
        
        <textarea  id="servico_discriminacao" name="servico_discriminacao" rows="4" cols="30"></textarea>
    </li>
    <br>
    <li>
        <label for="servico_codigo_municipio">Código do Município:</label>
        <input type="text" id="servico_codigo_municipio" name="servico_codigo_municipio" 
        value="' . $result['Servico_Codigo_Municipio'] . '">
    </li>
    <li>
        <label for="servico_codigo_municipio_prestacao">Código do Município de Prestação:</label>
        <input type="text" id="servico_codigo_municipio_prestacao" name="servico_codigo_municipio_prestacao" 
        value="' . $result['Servico_Codigo_Municipio'] . '">
    </li>
    <li>
        <label for="servico_valor_servicos">Valor dos Serviços:</label>
        <input type="text" id="servico_valor_servicos" name="servico_valor_servicos" value="0">
    </li>
    <li>
        <label for="servico_valor_deducoes">Valor das Deduções:</label>
        <input type="text" id="servico_valor_deducoes" name="servico_valor_deducoes" value="0">
    </li>
    <li>
        <label for="servico_valor_pis">Valor PIS:</label>
        <input type="text" id="servico_valor_pis" name="servico_valor_pis" value="0">
    </li>
    <li>
        <label for="servico_valor_cofins">Valor COFINS:</label>
        <input type="text" id="servico_valor_cofins" name="servico_valor_cofins" value="0">
    </li>
    <li>
        <label for="servico_valor_inss">Valor INSS:</label>
        <input type="text" id="servico_valor_inss" name="servico_valor_inss" value="0">
    </li>
    <li>
        <label for="servico_valor_ir">Valor IR:</label>
        <input type="text" id="servico_valor_ir" name="servico_valor_ir" value="0">
    </li>
    <li>
        <label for="servico_valor_csll">Valor CSLL:</label>
        <input type="text" id="servico_valor_csll" name="servico_valor_csll" value="0">
    </li>
    <li>
        <label for="servico_valor_outras">Valor Outras:</label>
        <input type="text" id="servico_valor_outras" name="servico_valor_outras" value="0">
    </li>
    <li>
        <label for="servico_valor_iss">Valor ISS:</label>
        <input type="text" id="servico_valor_iss" name="servico_valor_iss" value="0">
    </li>
    <li>
        <label for="servico_valor_aliquota">Valor Alíquota:</label>
        <input type="text" id="servico_valor_aliquota" name="servico_valor_aliquota" value="0">
    </li>
    <li>
        <label for="servico_valor_desconto_condicionado">Valor do Desconto Condicionado:</label>
        <input type="text" id="servico_valor_desconto_condicionado" name="servico_valor_desconto_condicionado" value="0">
    </li>
    <li>
        <label for="servico_valor_desconto_incondicionado">Valor do Desconto Incondicionado:</label>
        <input type="text" id="servico_valor_desconto_incondicionado" name="servico_valor_desconto_incondicionado" value="0">
    </li>
    <li>
        <label for="servico_exigibilidade_iss">Exigibilidade ISS:</label>
        <input type="text" id="servico_exigibilidade_iss" name="servico_exigibilidade_iss" 
        value="' . $result['Servico_Exigibilidade_Iss'] . '">
    </li>
    <li>
        <label for="servico_iss_retido">ISS Retido:</label>
        <input type="text" id="servico_iss_retido" name="servico_iss_retido" 
        value="' . $result['Servico_Iss_Retido'] . '">
    </li>
    
    <br>
    Informações Complementares(Opcional):</b><br><br>
    
    <li>
        <textarea id="informacoes_complementares" name="informacoes_complementares" rows="3" cols="30"></textarea>
    </li>
    </ul>
    </ul>

    <input type="submit" value="Salvar">
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
        $('#btn_carregar').click(function(event) {
            // Prevent default form submission
            event.preventDefault();

            var tomadorId = $('#tomador_select').val();
            //alert(tomadorId);


            $.ajax({
                url: 'nfse_tomador_ajax.php',
                type: 'POST',
                data: {
                    tomadorId: tomadorId
                },
                success: function(data) {
                    //console.log(data); // novo código aqui
                    // alert('teste1');
                    if (typeof data === 'object') {
                        var tomador = data;
                    } else {
                        var tomador = JSON.parse(data);
                    }
                    //alert('teste2');

                    $('#tomador_cnpj').val(tomador.Cnpj);
                    $('#tomador_razao_social').val(tomador.Razao_Social);
                    $('#tomador_logradouro').val(tomador.Logradouro);
                    $('#tomador_numero').val(tomador.Numero);
                    $('#tomador_bairro').val(tomador.Bairro);
                    $('#tomador_codigo_municipio').val(tomador.Codigo_Municipio);
                    $('#tomador_uf').val(tomador.Uf);
                    $('#tomador_cep').val(tomador.Cep);
                    // alert('teste3');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });

        });


        $('form').on('submit', function(e) {
            e.preventDefault();
            var confirmacao = confirm("Todos os dados da Nota Fiscal de Serviço Eletronica estão corretos?");

            if (confirmacao == true) {
                var formData = $(this).serialize();

                $.ajax({
                    url: 'nfse_nova_save_ajax.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        if (data.exists) {
                            alert("O número de nota fiscal já existe na base de dados.");
                        } else if (data.saved) {
                            alert("Nota Fiscal salva com sucesso.");
                            location.href = "nfse.php"; // Redirecionar para a página desejada
                        } else {
                            alert("Houve um erro ao salvar a Nota Fiscal. Tente novamente.");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        alert("Erro ao salvar a nota fiscal. Verifique o console para mais detalhes.");
                    }
                });
            } else {
                // Se o usuário clicar em 'cancelar' na caixa de confirmação, não faça nada
            }
        });




    }); //final do ready function.
</script>



<?php include("base.php"); ?>
