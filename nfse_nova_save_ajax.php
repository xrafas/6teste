<?php
include_once('session.php');
include_once('../db_functions.php');
$con = dbConnect();

// decodificar os dados do formulário
parse_str(file_get_contents("php://input"), $formData);

$numero = $formData['numero'];

$sql = "SELECT * FROM empresa WHERE Codigo = " . $_SESSION['codigo'] . " ";
$result = querySQL($con, $sql);

// verificar se o número da nota fiscal já existe
$sql_nfse = "SELECT * FROM nfse WHERE Numero = " . $numero . " AND Codigo = " . $_SESSION['codigo'] . " ";
$notaExistente = querySQL($con, $sql_nfse);

if ($notaExistente) {
  echo json_encode(['exists' => true]);
} else {
  $sql = "INSERT INTO nfse SET ";
  $sql .= "Codigo = '" . $_SESSION["codigo"] . "', ";
  $sql .= "Empresa = '" . $result["Empresa"] . "', ";
  $sql .= "Numero = '" . $_POST["numero"] . "', ";
  $sql .= "Serie = '1', ";
  $sql .= "Tipo = '1', ";
  $sql .= "Status = '1', ";
  $sql .= "Data_Emissao = '" . $_POST["data_emissao"] . "', ";
  $sql .= "Data_Competencia = '" . $_POST["data_competencia"] . "', ";

  $sql .= "Prestador_Cnpj = '" . $_POST["prestador_cnpj"] . "', ";
  $sql .= "Prestador_Razao_Social = '" . $_POST["prestador_razao_social"] . "', ";
  $sql .= "Prestador_Endereco_Logradouro = '" . $_POST["prestador_logradouro"] . "', ";
  $sql .= "Prestador_Endereco_Numero = '" . $_POST["prestador_numero"] . "', ";
  $sql .= "Prestador_Endereco_Bairro = '" . $_POST["prestador_bairro"] . "', ";
  $sql .= "Prestador_Endereco_Codigo_Municipio = '" . $_POST["prestador_codigo_municipio"] . "', ";
  $sql .= "Prestador_Endereco_Uf = '" . $_POST["prestador_uf"] . "', ";
  $sql .= "Prestador_Endereco_Cep = '" . $_POST["prestador_cep"] . "', ";
  $sql .= "Servico_Codigo_Tributacao_Municipio = '" . $_POST["servico_codigo_tributacao_municipio"] . "', ";
  $sql .= "Servico_Discriminacao = '" . $_POST["servico_discriminacao"] . "', ";
  $sql .= "Servico_Codigo_Municipio = '" . $_POST["servico_codigo_municipio"] . "', ";
  $sql .= "Servico_Valor_Servicos = '" . $_POST["servico_valor_servicos"] . "', ";
  $sql .= "Servico_Valor_Aliquota = '" . $_POST["servico_valor_aliquota"] . "', ";
  
  $sql .= "Tomador_Cpf = '" . $_POST["tomador_cpf"] . "', ";
  $sql .= "Tomador_Cnpj = '" . $_POST["tomador_cnpj"] . "', ";
  $sql .= "Tomador_Razao_Social = '" . $_POST["tomador_razao_social"] . "', ";
  $sql .= "Tomador_Endereco_Logradouro = '" . $_POST["tomador_logradouro"] . "', ";
  $sql .= "Tomador_Endereco_Numero = '" . $_POST["tomado_numero"] . "', ";
  $sql .= "Tomador_Endereco_Bairro = '" . $_POST["tomador_bairro"] . "', ";
  $sql .= "Tomador_Endereco_Codigo_Municipio = '" . $_POST["tomador_codigo_municipio"] . "', ";
  $sql .= "Tomador_Endereco_Uf = '" . $_POST["tomador_uf"] . "', ";
  $sql .= "Tomador_Endereco_Cep = '" . $_POST["tomador_cep"] . "', ";
  $sql .= "Servico_Codigo = '" . $_POST["servico_codigo"] . "', ";
  $sql .= "Servico_Codigo_Cnae = '" . $_POST["servico_codigo_cnae"] . "', ";
  $sql .= "Servico_Codigo_Municipio_Prestacao = '" . $_POST["servico_codigo_municipio_prestacao"] . "', ";
  $sql .= "Servico_Valor_Deducoes = '" . $_POST["servico_valor_deducoes"] . "', ";
  $sql .= "Servico_Valor_Pis = '" . $_POST["servico_valor_pis"] . "', ";
  $sql .= "Servico_Valor_Cofins = '" . $_POST["servico_valor_cofins"] . "', ";
  $sql .= "Servico_Valor_Inss = '" . $_POST["servico_valor_inss"] . "', ";
  $sql .= "Servico_Valor_Ir = '" . $_POST["servico_valor_ir"] . "', ";
  $sql .= "Servico_Valor_Csll = '" . $_POST["servico_valor_csll"] . "', ";
  $sql .= "Servico_Valor_Outras = '" . $_POST["servico_valor_outras"] . "', ";
  $sql .= "Servico_Valor_Iss = '" . $_POST["servico_valor_iss"] . "', ";
  $sql .= "Servico_Valor_Desconto_Condicionado = '" . $_POST["servico_valor_desconto_condicionado"] . "', ";
  $sql .= "Servico_Valor_Desconto_Incondicionado = '" . $_POST["servico_valor_desconto_incondicionado"] . "', ";
  $sql .= "Servico_Exigibilidade_Iss = '" . $_POST["servico_exigibilidade_iss"] . "', ";
  $sql .= "Servico_Iss_Retido = '" . $_POST["servico_iss_retido"] . "', ";
  $sql .= "Informacoes_Complementares = '" . $_POST["informacoes_complementares"] . "', ";
  //$sql .= "Obra_Codigo = '" . $_POST["Obra_Codigo"] . "', ";
  //$sql .= "Obra_Art = '" . $_POST["Obra_Art"] . "', ";
  //$sql .= "Chave = '" . $_POST["Chave"] . "', ";
  $sql .= "Certificado_PEM = '" . $result["Certificado_PEM"] . "' ";
  //$sql .= "Caminho_XML = '" . $_POST["Caminho_XML"] . "'";


  if (execSQL($con, $sql)) {
    echo json_encode(['saved' => true]);
  } else {
    echo json_encode(['saved' => false]);
  }
}
