# Progress Stack

The **ProgressStack** widget renders a [progress stack](https://getbootstrap.com/docs/5.3/components/progress/#multiple-bars) component.

You can use it to stack multiple progress bars on top of each other, allowing you to display multiple values or metrics
simultaneously in a single progress container.

## Key Features
- Support for multiple progress bars in a single container.
- Each bar can have individual styles, colors, and percentages.

## Quick Start
To get started, instantiate the **ProgressStack** widget and add progress bars to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Progress;
use Yiisoft\Bootstrap5\ProgressStack;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;
?>

<?= ProgressStack::widget()
        ->bars(
            Progress::widget()
                ->ariaLabel('Segment one')
                ->id('segment-one')
                ->percent(15),
            Progress::widget()
                ->ariaLabel('Segment two')
                ->backgroundColor(BackgroundColor::SUCCESS)
                ->id('segment-two')
                ->percent(30),
            Progress::widget()
                ->ariaLabel('Segment three')
                ->backgroundColor(BackgroundColor::INFO)
                ->id('segment-three')
                ->percent(20),
        )
?>
```

This generates a progress container with three stacked progress bars, each with different percentages and colors.

## Configuration

### Setting Attributes
Customize the progress stack container with HTML attributes:

```php
ProgressStack::widget()
    ->attributes(['id' => 'my-progress-stack'])
    ->class('custom-progress-stack');
```

Add single attributes:

```php
ProgressStack::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
ProgressStack::widget()->addAttributes(['data-id' => '123', 'data-action' => 'track']);
```

### Adding CSS Classes
Add one or more CSS classes to the progress stack container:

```php
ProgressStack::widget()->addClass('custom-class', 'mt-3');
```

Replace all existing classes:

```php
ProgressStack::widget()->class('custom-class', 'another-class', BackgroundColor::PRIMARY);
```

### Adding CSS Styles
Add CSS styles to the progress stack container:

```php
ProgressStack::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
ProgressStack::widget()->addCssStyle(['height' => '10px', 'max-width' => '500px']);
```
