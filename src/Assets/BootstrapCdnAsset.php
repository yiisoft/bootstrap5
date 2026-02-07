<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Assets;

use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Bootstrap files served via CDN.
 *
 * @psalm-import-type CssFile from AssetManager
 * @psalm-import-type JsFile from AssetManager
 */
final class BootstrapCdnAsset extends AssetBundle
{
    public bool $cdn = true;

    /**
     * @psalm-var array<array-key, string|CssFile>
     */
    public array $css = [
        [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css',
            'integrity' => 'sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB',
            'crossorigin' => 'anonymous',
        ],
    ];

    /**
     * @psalm-var array<array-key, string|JsFile>
     */
    public array $js = [
        [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
            'integrity' => 'sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI',
            'crossorigin' => 'anonymous',
        ],
    ];
}
