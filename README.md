# PHP Client

A reference implementation meant as an example how to use the PSB api using the PHP.

## Requirements

- PHP 7.2 or greater

## Install

- Install library using [`composer`][0].

```sh
composer require everbinding/econnect-psb-php
```

Then include composer autoloader.

```php
require __DIR__ . '/vendor/autoload.php';
```

## Configure

```php
$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$config
    ->setUsername("username")
    ->setPassword("password");
    ->setClientId("clientId")
    ->setClientSecret("secret")
    ->setHost("https://psb.econnect.eu")
    ->setApiKey('Subscription-Key', 'subscription key');;

```

## Login

Login using the default configuration.

```php
$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$authN = new \EConnect\Psb\Authentication($config);
$authN->login();
```

## Use api

Use the api using the default configuration after a successful login.
In this example we are calling the send sales invoice api. The user must have send permission on the provide sender partyId. Also make sure the UBL is valid, otherwise it will be block for sending. The receiver partyId is optional, the PSB will use the best possible route we no receiver partyId is provided.

```php
$config = \EConnect\Psb\Configuration::getDefaultConfiguration();

$salesInvoiceApi = new EConnect\Psb\Api\SalesInvoiceApi(
    new GuzzleHttp\Client();
    $config
);

$senderPartyId = "senderPartyId";
$filePath = "./Ubl.xml";
$receiverPartyId = null;

$salesInvoiceApi->sendSalesInvoice($senderPartyId, $filePath, $receiverPartyId);
```

## Example client

There is a [`simple example php client`][1] that you can run on a php webserver.

## Build you own source

Instead of using this code, you could also generate the php code yourself using the [`openapi-generator-cli`][2].

```sh
openapi-generator-cli generate -g php -i https://psb.econnect.eu/v1/swagger.json?subscriptionKey={your-subscription} -o C:\temp --additional-properties=invokerPackage=EConnect\Psb
```

And use [`Jumbojett\OpenIDConnectClient`][3] to get the access token.
You can also copy the code from: [`Authentication.php`][4]

```php
use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient('https://identity.econnect.eu',
                                'ClientIDHere',
                                'ClientSecretHere');

$oidc->addScope('ap');

//Add username and password
$oidc->addAuthParam(array('username'=>'<Username>'));
$oidc->addAuthParam(array('password'=>'<Password>'));

//Perform the auth and return the token (to validate check if the access_token property is there and a valid JWT) :
$token = $oidc->requestResourceOwnerToken(TRUE)->access_token;
```

## Read more

If you want to know more about Peppol e-procurement or other procurement network the go to the [`Procurement Service Bus introduction page`][5].

[0]: https://getcomposer.org/
[1]: ./Example.php
[2]: https://github.com/OpenAPITools/openapi-generator-cli
[3]: https://github.com/jumbojett/OpenID-Connect-PHP#example-5-request-resource-owners-token-with-client-auth
[4]: ./lib/Authentication.php
[5]: https://psb.econnect.eu/introduction/overview.html