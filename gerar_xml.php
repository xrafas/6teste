<?php
//var_dump($_POST);
if (!extension_loaded('soap')) {
    die('A extensão SOAP é necessária para utilizar este script.');
}

if (empty($_POST['nfseCabecMsg']) || empty($_POST['nfseDadosMsg'])) {
    echo "Valores de nfseCabecMsg e nfseDadosMsg não foram recebidos corretamente.";
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = "https://nfse-hom.procempa.com.br/tbw/ConsultaCadastroServlet?wsdl";
$content = @file_get_contents($url);
if ($content === false) {
    echo "Não foi possível carregar o WSDL: $url";
} else {
    echo "WSDL carregado com sucesso: $url";
}

// Substitua com os valores corretos para a sua NFSe
$dados_nfse = [
    'ambiente' => $_POST['ambiente'],
    'numero' => $_POST['numero'],
    'serie' => $_POST['serie'],
    'nfseCabecMsg' => $_POST['nfseCabecMsg'],
    'nfseDadosMsg' => $_POST['nfseDadosMsg'],
    // ... adicione outros campos conforme necessário
];

// Configurações
$certificado_path = "/home2/emultecc/sysweb.emultec.com.br/inside/files/certificados/MAGNUMP2023senha123456.pfx";
$senha_certificado = "123456";

// Função para gerar o XML da NFSe
function gerarXmlNFSe($dados_nfse)
{
    // Substitua este trecho de código com a lógica correta para gerar o XML da NFSe
    $xml = new SimpleXMLElement('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.bhiss.pbh.gov.br"><soapenv:Header/><soapenv:Body><ws:GerarNfseRequest/></soapenv:Body></soapenv:Envelope>');
    $input = $xml->children('soapenv', true)->Body->children('ws', true)->GerarNfseRequest->addChild('input');
    $input->addChild('ambiente', $dados_nfse['ambiente']);
    $input->addChild('numero', $dados_nfse['numero']);
    $input->addChild('serie', $dados_nfse['serie']);

    $input->addChild('nfseCabecMsg', $dados_nfse['nfseCabecMsg']);
    $input->addChild('nfseDadosMsg', $dados_nfse['nfseDadosMsg']);

    return $xml->asXML();
}

// Gere o XML da NFSe
$xml_string = gerarXmlNFSe($dados_nfse);

// Configurar o objeto SoapClient
$client = new SoapClient("https://nfse-hom.procempa.com.br/tbw/ConsultaCadastroServlet?wsdl", [
    'local_cert' => $certificado_path,
    'passphrase' => $senha_certificado,
    'trace' => 1
]);


// Enviar a requisição e obter a resposta
try {
    $response = $client->__soapCall('GerarNfse', [
        new SoapVar($xml_string, XSD_ANYXML)
    ]);

    // Salve o arquivo XML no servidor
    file_put_contents('/home2/emultecc/sysweb.emultec.com.br/inside/files/xml/arquivo.xml', $xml_string);

    // Processa a resposta XML e exibe as informações da NFS-e
    echo $response;
} catch (Exception $e) {
    echo "<br><br><br>";
    echo "Erro: " . $e->getMessage();
}
