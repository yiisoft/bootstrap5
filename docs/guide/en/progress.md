# Progress

The **Progress** widget renders a [progress bar](https://getbootstrap.com/docs/5.3/components/progress/#how-it-works) component.

You can use it to display the completion percentage of a task or process. Progress bars support various styles, 
animations visually in your application.

## Key Features
- Multiple visual variants including striped and animated progress bars.
- Customizable min and max values for precise percentage calculations.
- Width sizing utilities for creating progress bars with specific widths.
- Custom content support inside progress bars.

## Quick Start
To get started, instantiate the **Progress** widget and set the percentage value. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Progress;
?>

<?= Progress::widget()->percent(60) ?>
```

This generates a simple progress bar showing 60% completion.

## Configuration

### Setting Attributes
Customize the progress container with HTML attributes:

```php
Progress::widget()
    ->attributes(['id' => 'my-progress'])
    ->class('custom-progress');
```

Add single attributes:

```php
Progress::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Progress::widget()->addAttributes(['data-id' => '123', 'data-action' => 'track']);
```

### Adding CSS Classes
Add one or more CSS classes to the progress container:

```php
Progress::widget()->addClass('custom-class', 'mt-3');
```

Replace all existing classes:

```php
Progress::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the progress container:

```php
Progress::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
Progress::widget()->addCssStyle(['height' => '10px', 'max-width' => '500px']);
```

### Bar Customization
Add attributes to the progress bar:

```php
Progress::widget()->barAttributes(['data-test' => 'bar']);
```

Add CSS classes to the progress bar:

```php
Progress::widget()
    ->percent(75)
    ->addBarClass('custom-bar-class');
```

### Min and Max Values
Customize the minimum and maximum values (default is 0 to 100):

```php
Progress::widget()
    ->min(50)
    ->max(200)
    ->percent(125);
```

### Content Inside Bars
Add text or other content inside the progress bar:

```php
Progress::widget()
    ->percent(25)
    ->content('25%');
```

### Sizing Options
Use width utilities to create progress bars with specific widths:

```php
use Yiisoft\Bootstrap5\Utility\Sizing;

Progress::widget()
    ->percent(75)
    ->sizing(Sizing::WIDTH_75);
```
