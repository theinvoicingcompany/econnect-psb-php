# EConnect\Psb\HookApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getHooks()**](HookApi.md#getHooks) | **GET** /api/v1/{partyId}/hook | Get registered hooks.
[**sendHookPing()**](HookApi.md#sendHookPing) | **GET** /api/v1/{partyId}/hook/ping | Send ping to hook(s).
[**subscribe()**](HookApi.md#subscribe) | **PUT** /api/v1/{partyId}/hook | Add or update hook.
[**unSubscribe()**](HookApi.md#unSubscribe) | **DELETE** /api/v1/{partyId}/hook/{hookId} | Delete hook.


## `getHooks()`

```php
getHooks($party_id): \EConnect\Psb\Model\Hook[]
```

Get registered hooks.

Get web-hooks, mail-hooks and reverse web-hooks in a list.

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


$apiInstance = new EConnect\Psb\Api\HookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The partyId of the registered hooks.

try {
    $result = $apiInstance->getHooks($party_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HookApi->getHooks: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The partyId of the registered hooks. |

### Return type

[**\EConnect\Psb\Model\Hook[]**](../Model/Hook.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sendHookPing()`

```php
sendHookPing($party_id): \EConnect\Psb\Model\Document
```

Send ping to hook(s).

Send test message to the registered hooks.

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


$apiInstance = new EConnect\Psb\Api\HookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The partyId where the ping must be send to.

try {
    $result = $apiInstance->sendHookPing($party_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HookApi->sendHookPing: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The partyId where the ping must be send to. |

### Return type

[**\EConnect\Psb\Model\Document**](../Model/Document.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `subscribe()`

```php
subscribe($party_id, $hook): \EConnect\Psb\Model\Hook
```

Add or update hook.

Subscribe hook on event topics. Use the hookId to identity the hook if you want to update.

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


$apiInstance = new EConnect\Psb\Api\HookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The partyId for the hook.
$hook = new \EConnect\Psb\Model\Hook(); // \EConnect\Psb\Model\Hook | The hook that will define the action and trigger.

try {
    $result = $apiInstance->subscribe($party_id, $hook);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HookApi->subscribe: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The partyId for the hook. |
 **hook** | [**\EConnect\Psb\Model\Hook**](../Model/Hook.md)| The hook that will define the action and trigger. |

### Return type

[**\EConnect\Psb\Model\Hook**](../Model/Hook.md)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unSubscribe()`

```php
unSubscribe($party_id, $hook_id)
```

Delete hook.

Remove hook (unsubscribe).

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


$apiInstance = new EConnect\Psb\Api\HookApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$party_id = 'party_id_example'; // string | The partyId for the hook.
$hook_id = 'hook_id_example'; // string | The hookId that is used as the id in the hook object.

try {
    $apiInstance->unSubscribe($party_id, $hook_id);
} catch (Exception $e) {
    echo 'Exception when calling HookApi->unSubscribe: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **party_id** | **string**| The partyId for the hook. |
 **hook_id** | **string**| The hookId that is used as the id in the hook object. |

### Return type

void (empty response body)

### Authorization

[Bearer](../../README.md#Bearer), [Subscription-Key](../../README.md#Subscription-Key)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
