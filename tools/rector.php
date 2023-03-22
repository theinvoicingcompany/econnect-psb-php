<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->phpVersion(\Rector\Core\ValueObject\PhpVersion::PHP_81);
    $rectorConfig->paths([
        __DIR__ . '/../lib',
        __DIR__ . '/../test',
    ]);

    // define sets of rules
//    $rectorConfig->sets([
//        \Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_81
//    ]);

    $rectorConfig->rules([
        \Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector::class,
        \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector::class,
        \Rector\CodeQuality\Rector\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector::class,
    ]);


    // Guzzle upgrading
    $rectorConfig->ruleWithConfiguration(
        \Rector\Renaming\Rector\FuncCall\RenameFunctionRector::class,
        [
            'GuzzleHttp\Psr7\build_query' => 'GuzzleHttp\Psr7\Query::build',
            'GuzzleHttp\json_encode'      => 'GuzzleHttp\Utils::jsonEncode',
            'GuzzleHttp\Psr7\try_fopen' => 'GuzzleHttp\Psr7\Utils::tryFopen',
        ]
    );

    // PHP 8.1
    $rectorConfig->ruleWithConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector::class,
        [
            // ArrayAccess
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration('ArrayAccess', 'offsetExists', new \PHPStan\Type\BooleanType()),
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration('ArrayAccess', 'offsetGet', new \PHPStan\Type\MixedType(true)),
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration('ArrayAccess', 'offsetSet', new \PHPStan\Type\VoidType()),
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration('ArrayAccess', 'offsetUnset', new \PHPStan\Type\VoidType()),

            // JsonSerializable
            new \Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration('JsonSerializable', 'jsonSerialize', new \PHPStan\Type\MixedType(true)),
        ]
    );

    $rectorConfig->ruleWithConfiguration(
        \Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector::class,
        [
            // ArrayAccess
            new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('ArrayAccess', 'offsetSet', 0, new \PHPStan\Type\MixedType(true)),
            new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('ArrayAccess', 'offsetSet', 1, new \PHPStan\Type\MixedType(true)),
            new \Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration('ArrayAccess', 'offsetUnset', 0, new \PHPStan\Type\MixedType(true)),
        ]
    );

};
