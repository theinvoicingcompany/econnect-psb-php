<?php
require __DIR__ . '/vendor/autoload.php';

use EConnect\Psb;

$httpClient = new GuzzleHttp\Client();

$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$config
    ->setClientId("2210f77eed3a4ab2")
    ->setClientSecret("ddded83702534a6c9cadde3d1bf3e94a")
    ->setHost("https://accp-psb.econnect.eu")
    ->setApiKey('Subscription-Key', 'Sandbox.Accp.W2NmWFRINXokdA');;

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
        <?php } else {
            $config
                ->setUsername(urldecode($_GET["username"]))
                ->setPassword(urldecode($_GET["password"]));

            $token = $authn->login();
            $userResponse = $meApi->getUser();
        ?>

            Hello <?php echo $userResponse["name"]; ?> your access token is
            <pre><?php echo $token; ?></pre>

            <h1>Send example</h1>
            <form method="POST" enctype="multipart/form-data">
                <p>
                    <label>sender partyId:</label>
                    <input type="text" name="senderPartyId" value="NL:KVK:econnectts" />
                </p>
                <p>
                    <label>Receiver partyId:</label>
                    <input type="text" name="receiverPartyId" value="NL:KVK:econnectts" />
                </p>
                <button value="preflight" name="submit">Preflight</button>

                <p>
                    <label>Business document (e.g. Ubl):</label>
                    <input type="file" name="file" id="file" />
                </p>
                <button value="send" name="submit">Send</button>
            </form>

            <pre>
            <?php
            $submit = isset($_POST['submit']) ? $_POST['submit'] : '';
            switch ($submit) {
                case "preflight":
                    echo $salesInvoiceApi->queryRecipientPartyForSalesInvoice($_POST['senderPartyId'], array($_POST['receiverPartyId']), null);
                    break;
                case "send":
                    echo $salesInvoiceApi->sendSalesInvoice($_POST['senderPartyId'], $_FILES['file']['tmp_name'], $_POST['receiverPartyId']);
                    break;
            } ?>
            </pre>
        <?php } ?>
    </div>
</body>

</html>