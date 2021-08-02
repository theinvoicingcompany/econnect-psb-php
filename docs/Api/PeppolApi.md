# EConnect\Psb\PeppolApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getDeliveryOptions()**](PeppolApi.md#getDeliveryOptions) | **GET** /api/v1/peppol/deliveryOption | Advanced recipient party lookup in Peppol.


## `getDeliveryOptions()`

```php
getDeliveryOptions($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit): \EConnect\Psb\Model\DeliveryOption[]
```

Advanced recipient party lookup in Peppol.

The queryRecipientParty should be efficient enough for most users. But if you are a advanced user, you could use this endpoint.

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


$apiInstance = new EConnect\Psb\Api\PeppolApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_ids = array('party_ids_example'); // string[] | All possible partyIds of the recipient party
$preferred_document_type_id = 'preferred_document_type_id_example'; // string | The source or preferred documentTypeId to match with and to determine the partyId format.
$document_type_ids = array('document_type_ids_example'); // string[] | Filter on document formats
$document_family = new \EConnect\Psb\Model\\EConnect\Psb\Model\DocumentFamily(); // \EConnect\Psb\Model\DocumentFamily | Document family
$is_credit = True; // bool | Example: Set it to true, to search only for CreditNotes or to false if you don't want to include CreditNotes in our result set.

try {
    $result = $apiInstance->getDeliveryOptions($party_ids, $preferred_document_type_id, $document_type_ids, $document_family, $is_credit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PeppolApi->getDeliveryOptions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_ids** | [**string[]**](../Model/string.md)| All possible partyIds of the recipient party |
 **preferred_document_type_id** | **string**| The source or preferred documentTypeId to match with and to determine the partyId format. | [optional]
 **document_type_ids** | [**string[]**](../Model/string.md)| Filter on document formats | [optional]
 **document_family** | [**\EConnect\Psb\Model\DocumentFamily**](../Model/.md)| Document family | [optional]
 **is_credit** | **bool**| Example: Set it to true, to search only for CreditNotes or to false if you don&#39;t want to include CreditNotes in our result set. | [optional]

### Return type

[**\EConnect\Psb\Model\DeliveryOption[]**](../Model/DeliveryOption.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
