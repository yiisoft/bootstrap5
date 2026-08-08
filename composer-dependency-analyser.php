<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

return (new Configuration())
    ->disableComposerAutoloadPathScan()
    ->setFileExtensions(['php'])
    ->addPathToScan(__DIR__ . '/src', isDev: false)
    ->addPathToScan(__DIR__ . '/tests', isDev: true)
    ->ignoreUnknownClasses([
        // Optional dependencies, see "suggest" in composer.json.
        'Yiisoft\Assets\AssetBundle',
        'Yiisoft\Files\PathMatcher\PathMatcher',
    ]);
