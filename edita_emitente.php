<?php

include 'vendor/autoload.php';

use CloudDfe\Sdk\Client;
use CloudDfe\Sdk\Emitente;

try {

    //token de emitente
    $token = '';
    $ambiente = Client::AMBIENTE_HOMOLOGACAO;
    $options = [
        'debug' => false
    ];

    $client = new Client([
        'ambiente' => $ambiente,
        'token' => $token,
        'options' => $options
    ]);

    $emitente = new Emitente($client);

    $payload = [
        'nome' => 'FULANO DA SILVA',
        'razao' => 'FULANO DA SILVA LTDA',
        "cnae" => '1234567',
        "crt" => 3,
        'ie' => '9876544321',
        'im' => '1234',
        'csc' => '9KLRH4IEMIQ58TKBOLRPHNDAN0SJEOKFK453',
        'cscid' => '2',
        'tar' => null,
        'login_prefeitura' => null,
        'senha_prefeitura' => null,
        'client_id_prefeitura' => null,
        'client_secret_prefeitura' =>null,
        'aliquota_simples' => null,
        'telefone' => '115555555',
        'email' => 'fulano@fulano.com.br',
        'rua' => 'AL JAPURUS',
        'numero' => '1345',
        'complemento' => 'Sala 111',
        'bairro' => 'BRAS',
        'municipio' => 'São Paulo',
        'cmun' => '3550308',
        'uf' => 'SP',
        'cep' => '02233000',
        'logo' => null

    ];
    $resp = $emitente->atualiza($payload); //os payloads são sempre ARRAYS

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}