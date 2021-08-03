<?php
require __DIR__ . '/vendor/autoload.php';

$payload = file_get_contents("php://input");
$expectedHash = hash_hmac('sha256', $payload, "secretKey");

if (empty($_SERVER["HTTP_X_ECONNECT_SIGNATURE"]) || $_SERVER["HTTP_X_ECONNECT_SIGNATURE"] != "sha256=" . $expectedHash) {
    header("HTTP/1.1 403 Forbidden");
    die("Forbidden");
}


$webhook = json_decode($payload);

// The topic could also be an InvoiceSent, in case the invoice is successfully sent. 
// This example only focusses on receiving invoices.
if ($webhook->topic != "InvoiceReceived") {
    header("HTTP/1.1 501 Not Implemented");
    die("Not Implemented");
}

$sentDate = DateTime::createFromFormat(\DateTime::ATOM, strtotime($webhook->sentOn));
$sentDate->add(new \DateInterval('PT300S'));

if ($sentDate < new \DateTime()) {
    header("HTTP/1.1 400 Bad Request");
    die("Bad Request");
}

$httpClient = new GuzzleHttp\Client();

$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$config
    ->setUsername("eConnectUser")
    ->setPassword("eConnect#!12")
    ->setClientId("2210f77eed3a4ab2")
    ->setClientSecret("ddded83702534a6c9cadde3d1bf3e94a")
    ->setHost("https://accp-psb.econnect.eu")
    ->setApiKey('Subscription-Key', 'eConnectInternalApaasSubscription');;

$purchaseInvoiceApi = new EConnect\Psb\Api\PurchaseInvoiceApi(
    $httpClient,
    $config
);

$authn = new \EConnect\Psb\Authentication($config);
$token = $authn->login();

header('Content-Type: application/xml; charset=utf-8');
$file = $purchaseInvoiceApi->downloadPurchaseInvoice($webhook->partyId, $webhook->documentId, null);

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
