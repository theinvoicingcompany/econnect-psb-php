## PHP Tools
Install and run Rector (from tools folder):
```shell
composer --working-dir ./ require --dev rector/rector
```

Dry-run rector:
```shell
vendor/bin/rector --dry-run process
```

Run rector and make changes:
```shell
vendor/bin/rector process
```