<?php
require __DIR__ . '/vendor/autoload.php';

$payload = file_get_contents("php://input");
$expectedHash = hash_hmac('sha256', $payload, "secretKey");

if (empty($_SERVER["HTTP_X_ECONNECT_SIGNATURE"]) || $_SERVER["HTTP_X_ECONNECT_SIGNATURE"] != "sha256=" . $expectedHash) {
    header("HTTP/1.1 403 Forbidden");
    die("Forbidden (Signature invalid)");
}


$webhook = json_decode($payload);

if ($webhook->topic != "InvoiceReceived") {
    header("HTTP/1.1 501 Not Implemented");
    die("Not Implemented (Topic not supported)");
}

$sentDate = new \DateTime($webhook->sentOn);

$minDate = new \DateTime();
$minDate->sub(new \DateInterval('PT300S'));

$maxDate = new \DateTime();
$maxDate->add(new \DateInterval('PT300S'));

if ($sentDate < $minDate) {
    header("HTTP/1.1 400 Bad Request");
    die("Bad Request (Too old ".$sentDate->format('c')." < ".$minDate->format('c').")");
}

if ($sentDate > $maxDate) {
    header("HTTP/1.1 400 Bad Request");
    die("Bad Request (Too new ".$sentDate->format('c')." > ".$maxDate->format('c').")");
}

$httpClient = new GuzzleHttp\Client();

$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$config
    ->setUsername("{username}")
    ->setPassword("{password}")
    ->setClientId("2210f77eed3a4ab2") // For testing only
    ->setClientSecret("ddded83702534a6c9cadde3d1bf3e94a") // For testing only
    ->setHost("https://accp-psb.econnect.eu") // For testing only
    ->setApiKey('Subscription-Key', 'Sandbox.Accp.W2NmWFRINXokdA'); // For testing only

$purchaseInvoiceApi = new EConnect\Psb\Api\PurchaseInvoiceApi(
    $httpClient,
    $config
);

$authn = new \EConnect\Psb\Authentication($config);
$token = $authn->login();

// Download as NLCUIS and print file
$format = "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2::Invoice##urn:cen.eu:en16931:2017#compliant#urn:fdc:nen.nl:nlcius:v1.0::2.1";
header('Content-Type: application/xml; charset=utf-8');
$file = $purchaseInvoiceApi->downloadPurchaseInvoice($webhook->partyId, $webhook->documentId, $format);

while (!$file->eof()) {
    echo $file->fgets();
}

// Invoice response
$invoice_response = new \EConnect\Psb\Model\InvoiceResponse();

// Acknowledgement
$invoice_response->setStatus("AB");

// Reject
// $reasons = new \EConnect\Psb\Model\InvoiceResponseReasons();
// $reasons->setRef("Purchase order number is invalid. The format should be POnnnnnn.");
// $actions = new \EConnect\Psb\Model\InvoiceResponseActions();
// $actions->setNin("Please send a new invoice.");
// $invoice_response
//     ->setStatus("RE")
//     ->setReasons($reasons)
//     ->setActions($actions)
//     ->setNote("Send form php");

$purchaseInvoiceApi->sendInvoiceResponse($webhook->partyId, $webhook->documentId, $invoice_response);
