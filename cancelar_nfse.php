<?php

include 'vendor/autoload.php';

use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjUxNjIsInVzciI6MTI1LCJ0cCI6MiwiaWF0IjoxNjgzNzI2NDI4fQ.McZnjqQluS3XASAY1zKhKxIM1fNQUG_4IAUQWznqMYk',
        'ambiente' => Nfse::AMBIENTE_PRODUCAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    $payload = [
        'chave' => '41210222545265000108550010001010021121093113',
        'justificativa' => 'teste de cancelamento' //minimo de 15 caracteres
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->cancela($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
