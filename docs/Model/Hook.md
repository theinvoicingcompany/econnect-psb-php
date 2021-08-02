# # Hook

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique Id |
**name** | **string** | Display name |
**action** | **string** | Action that must be pushed. Can be mailto: or http: |
**topics** | **string[]** | Event topics where the action must be triggered on | [optional]
**publish_topics** | **string[]** | Event topics that can be used for publishing | [optional]
**init** | **array<string,mixed>** | Additional arguments used to initialize the hook. | [optional]
**is_active** | **bool** |  | [optional]
**created_on** | [**\DateTime**](\DateTime.md) |  | [optional]
**changed_on** | [**\DateTime**](\DateTime.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
