<?php
  include_once('session.php');
  include_once('../db_functions.php');
  $con = dbConnect();

  $tomadorId = $_POST['tomadorId'];

  $sql = "SELECT * FROM nfse_tomador WHERE Id = " . $tomadorId;

  $tomador = querySQL($con, $sql);

  if ($tomador) {
    echo json_encode($tomador);
  } else {
    echo json_encode(array("error" => "Nenhum tomador encontrado com esse ID"));
  }
?>
