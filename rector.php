<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector;
use RectorLaravel\Set\LaravelLevelSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/lang',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->withPhpSets()
    ->withPhpVersion(80300)
    ->withSets([LaravelLevelSetList::UP_TO_LARAVEL_120])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
    )
    ->withSkip([
        ReadOnlyPropertyRector::class,
        SimplifyUselessVariableRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        AddClosureVoidReturnTypeWhereNoReturnRector::class => [
            __DIR__ . '/tests',
        ],
    ]);
