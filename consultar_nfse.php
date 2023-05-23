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
        'chave' => '35230522337493000192904020000000061679381170'
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->consulta($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
