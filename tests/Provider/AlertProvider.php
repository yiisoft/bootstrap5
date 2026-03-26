<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests\Provider;

use Yiisoft\Bootstrap5\AlertVariant;

final class AlertProvider
{
    public static function variant(): array
    {
        return [
            [
                AlertVariant::PRIMARY,
                <<<HTML
                <div role="alert" class="alert alert-primary">
                A simple alert-primary check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::SECONDARY,
                <<<HTML
                <div role="alert" class="alert alert-secondary">
                A simple alert-secondary check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::SUCCESS,
                <<<HTML
                <div role="alert" class="alert alert-success">
                A simple alert-success check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::DANGER,
                <<<HTML
                <div role="alert" class="alert alert-danger">
                A simple alert-danger check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::WARNING,
                <<<HTML
                <div role="alert" class="alert alert-warning">
                A simple alert-warning check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::INFO,
                <<<HTML
                <div role="alert" class="alert alert-info">
                A simple alert-info check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::LIGHT,
                <<<HTML
                <div role="alert" class="alert alert-light">
                A simple alert-light check it out!
                </div>
                HTML,
            ],
            [
                AlertVariant::DARK,
                <<<HTML
                <div role="alert" class="alert alert-dark">
                A simple alert-dark check it out!
                </div>
                HTML,
            ],
        ];
    }
}
