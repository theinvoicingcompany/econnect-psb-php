<?php
require __DIR__ . '/vendor/autoload.php';

use EConnect\Psb;

$httpClient = new GuzzleHttp\Client();

$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$config
    ->setClientId("2210f77eed3a4ab2")
    ->setClientSecret("ddded83702534a6c9cadde3d1bf3e94a")
    ->setHost("https://accp-psb.econnect.eu")
    ->setApiKey('Subscription-Key', 'Sandbox.Accp.W2NmWFRINXokdA');

$meApi = new EConnect\Psb\Api\MeApi(
    $httpClient,
    $config
);

$hookApi = new EConnect\Psb\Api\HookApi(
    $httpClient,
    $config
);

$authn = new \EConnect\Psb\Authentication($config);

$salesInvoiceApi = new EConnect\Psb\Api\SalesInvoiceApi(
    $httpClient,
    $config
);

?>

<html>

<head>
    <title>Example EConnect PSB</title>
    <style>
        label {
            font-weight: bold;
            display: block;
        }
    </style>
</head>

<body>
    <div>
        <?php
        if (!isset($_GET['username'])) { ?>
            <form method="GET">
                <p>
                    <label>Username: </label>
                    <input type="text" name="username" value="" />
                </p>
                <p>
                    <label>Password: </label>
                    <input type="password" name="password" value="" />
                </p>
                <button>Login</button>
            </form>
			<a href="https://psb.econnect.eu/introduction/gettingStarted.html#step-1-get-access">Getting started</a>
        <?php } else {
            $config
                ->setUsername(urldecode($_GET["username"]))
                ->setPassword(urldecode($_GET["password"]));

            $token = $authn->login();
            $userResponse = $meApi->getUser();

            $senderPartyId = isset($_POST['senderPartyId']) ? $_POST['senderPartyId'] : "";
            $receiverPartyId = isset($_POST['receiverPartyId']) ? $_POST['receiverPartyId'] : "";
        ?>

            Hello <?php echo $userResponse["name"]; ?> your access token is
            <pre><?php echo $token; ?></pre>

            <h1>Send invoice example</h1>
            <h2>Query recipient</h2>
            <p>Use the <a href="https://psb.econnect.eu/endpoints/v1/salesInvoice.html#query-recipient">"Query recipient"</a> to make sure the partyId can receive your invoice.</p>
            <form method="POST" enctype="multipart/form-data">
                <p>
                    <label>Your partyId:</label>
                    <input type="text" name="senderPartyId" value="<?php echo $senderPartyId; ?>" />
                </p>
                <p>
                    <label>Receiver partyId:</label>
                    <input type="text" name="receiverPartyId" value="<?php echo $receiverPartyId; ?>" />
                </p>
                <button value="queryRecipient" name="queryRecipient">Query recipient</button>
            </form>

            <h3>Query recipient response</h3>
            <p>Use this partyId as the receiverId in the next send call or in your UBL as AccountingCustomerParty/EndpointID.</p>

            <?php
            if (isset($_POST['queryRecipient'])) {
                echo "<pre>" . $salesInvoiceApi->queryRecipientPartyForSalesInvoice($_POST['senderPartyId'], array($_POST['receiverPartyId']), null) . "</pre>";
            } ?>

            <h2>Send</h2>
            <p>Use the <a href="https://psb.econnect.eu/endpoints/v1/salesInvoice.html#send">"Send"</a> api to upload your invoice.</p>
            <form method="POST" enctype="multipart/form-data">
                <p>
                    <label>Your partyId:</label>
                    <input type="text" name="senderPartyId" value="<?php echo $senderPartyId; ?>" />
                </p>
                <p>
                    <label>Optional receiver partyId:</label>
                    <input type="text" name="receiverPartyId" value="<?php echo $receiverPartyId; ?>" />
                </p>
                <p>
                    <label>Business document (e.g. Ubl):</label>
                    <input type="file" name="file" id="file" />
                </p>
                <button value="send" name="send">Send</button>
            </form>
            <h3>Send response</h3>
            <p>An Id will be returned When you request is accepted, please store this Id, since it is your trace and trace id.</p>

            <?php
            if (isset($_POST['send'])) {
                echo "<pre>" . $salesInvoiceApi->sendSalesInvoice($_POST['senderPartyId'], $_FILES['file']['tmp_name'], $_POST['receiverPartyId']) . "</pre>";
            } ?>

            <h3>Receive status update</h3>
            <p>You need to <a href="https://psb.econnect.eu/endpoints/v1/hook.html#configure-your-webhook">register webhooks</a> using the topic "InvoiceSent" in order to known if your send was successful.
                There is an example webhook receiver attached to this project, please inspect the contents of: WebhookReceiver.php.
            </p>
        <?php } ?>
    </div>
</body>

</html>