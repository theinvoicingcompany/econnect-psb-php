# EConnect\Psb\SalesInvoiceApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getSalesInvoiceStatuses()**](SalesInvoiceApi.md#getSalesInvoiceStatuses) | **GET** /api/v1/{partyId}/salesInvoice/{documentId}/status | Get sales invoice statuses.
[**queryRecipientPartyForSalesInvoice()**](SalesInvoiceApi.md#queryRecipientPartyForSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/queryRecipientParty | Lookup the recipient party in Peppol.
[**recognizeSalesInvoice()**](SalesInvoiceApi.md#recognizeSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/recognize | Recognize sales invoice.
[**sendSalesInvoice()**](SalesInvoiceApi.md#sendSalesInvoice) | **POST** /api/v1/{partyId}/salesInvoice/send | Send an invoice.


## `getSalesInvoiceStatuses()`

```php
getSalesInvoiceStatuses($party_id, $document_id): \EConnect\Psb\Model\DocumentStatus[]
```

Get sales invoice statuses.

Get list of statuses of the sales invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId.
$document_id = 'document_id_example'; // string | The service bus documentId.

try {
    $result = $apiInstance->getSalesInvoiceStatuses($party_id, $document_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->getSalesInvoiceStatuses: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId. |
 **document_id** | **string**| The service bus documentId. |

### Return type

[**\EConnect\Psb\Model\DocumentStatus[]**](../Model/DocumentStatus.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `queryRecipientPartyForSalesInvoice()`

```php
queryRecipientPartyForSalesInvoice($party_id, $request_body, $preferred_document_type_id): \EConnect\Psb\Model\Party
```

Lookup the recipient party in Peppol.

The returned recipient partyId should be used as endpointId in the sales invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId.
$request_body = array('request_body_example'); // string[] | All possible partyIds of the recipient party
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.

try {
    $result = $apiInstance->queryRecipientPartyForSalesInvoice($party_id, $request_body, $preferred_document_type_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->queryRecipientPartyForSalesInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId. |
 **request_body** | [**string[]**](../Model/string.md)| All possible partyIds of the recipient party |
 **preferred_document_type_id** | **string**| The source or preferred documentTypeId to match with and to determine the partyId format. | [optional]

### Return type

[**\EConnect\Psb\Model\Party**](../Model/Party.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recognizeSalesInvoice()`

```php
recognizeSalesInvoice($party_id, $file): \EConnect\Psb\Model\Document
```

Recognize sales invoice.

Add file to sales invoices queue for recognizing. The returned id is the documentId/traceId that will be used in status updates.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId
$file = "/path/to/file.txt"; // \SplFileObject

try {
    $result = $apiInstance->recognizeSalesInvoice($party_id, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->recognizeSalesInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId |
 **file** | **\SplFileObject****\SplFileObject**|  |

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendSalesInvoice()`

```php
sendSalesInvoice($party_id, $file, $receiver_id): \EConnect\Psb\Model\Document
```

Send an invoice.

Add file to sales invoices queue for sending. The returned id is the documentId/traceId that will be used as in status updates.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: Bearer
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure API key authorization: Subscription-Key
$config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKey('Subscription-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = EConnect\Psb\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Subscription-Key', 'Bearer');


$apiInstance = new EConnect\Psb\Api\SalesInvoiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The sender partyId.
$file = "/path/to/file.txt"; // \SplFileObject
$receiver_id = 'receiver_id_example'; // string | An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document.

try {
    $result = $apiInstance->sendSalesInvoice($party_id, $file, $receiver_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SalesInvoiceApi->sendSalesInvoice: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The sender partyId. |
 **file** | **\SplFileObject****\SplFileObject**|  |
 **receiver_id** | **string**| An optional receiver partyId to enforce delivery to a specific endpoint. The receiverId will be injected into the document. | [optional]

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
