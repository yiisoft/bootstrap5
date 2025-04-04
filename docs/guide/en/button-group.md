# Button Group

The **ButtonGroup** widget renders a [button group](https://getbootstrap.com/docs/5.3/components/button-group/) component.

You can use it to create a series of buttons grouped together on a single line. This is useful for creating toolbars,
segmented controls, or placing similar buttons adjacent to each other.

## Key Features
- Supports multiple buttons, checkboxes, and radio inputs in a single group.
- Vertical orientation option for stacked button layouts.
- Customizable sizing (small, large, default).
- Consistent styling for multiple related buttons.

## Quick Start
To get started, instantiate the **ButtonGroup** widget and add buttons to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Button;
use Yiisoft\Bootstrap5\ButtonGroup;
use Yiisoft\Bootstrap5\ButtonVariant;
?>

<?= ButtonGroup::widget()
        ->ariaLabel('Basic example')
        ->buttons(
            Button::widget()->id(false)->label('Left')->variant(ButtonVariant::PRIMARY),
            Button::widget()->id(false)->label('Middle')->variant(ButtonVariant::PRIMARY),
            Button::widget()->id(false)->label('Right')->variant(ButtonVariant::PRIMARY),
        )
?>
```

This generates a simple horizontal button group with three primary buttons.

## Configuration

### Setting Attributes
Customize the button group container with HTML attributes:

```php
$buttonGroup = ButtonGroup::widget()
    ->attributes(['id' => 'my-button-group'])
    ->class('custom-button-group');
```

Add single attributes:

```php
$buttonGroup = ButtonGroup::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
$buttonGroup = ButtonGroup::widget()->addAttributes(['data-id' => '123', 'data-action' => 'toggle']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
$buttonGroup = ButtonGroup::widget()->addClass('custom-class', 'bg-primary');
```

Replace all existing classes:

```php
$buttonGroup = ButtonGroup::widget()->class('custom-class', 'another-class', 'bg-primary');
```

### Adding CSS Styles
Add CSS styles to the button group:

```php
$buttonGroup = ButtonGroup::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
$buttonGroup = ButtonGroup::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### ARIA Label
Set an ARIA label for accessibility:

```php
$buttonGroup = ButtonGroup::widget()->ariaLabel('Button group for actions');
```

### Group Size
Change the button group size:

```php
use Yiisoft\Bootstrap5\ButtonSize;

$buttonGroup = ButtonGroup::widget()->size(ButtonSize::LARGE);
$buttonGroup = ButtonGroup::widget()->size(ButtonSize::SMALL);
```

### Orientation
Create a vertical button group:

```php
$buttonGroup = ButtonGroup::widget()->vertical();
```

### Mixed Styles Example
Create a button group with different button variants:

```php
$buttonGroup = ButtonGroup::widget()
    ->buttons(
        Button::widget()->id(false)->label('Left')->variant(ButtonVariant::DANGER),
        Button::widget()->id(false)->label('Middle')->variant(ButtonVariant::WARNING),
        Button::widget()->id(false)->label('Right')->variant(ButtonVariant::SUCCESS),
    );
```

### Outlined Styles Example
Create a button group with outlined button variants:

```php
$buttonGroup = ButtonGroup::widget()
    ->buttons(
        Button::widget()->id(false)->label('Left')->variant(ButtonVariant::OUTLINE_PRIMARY),
        Button::widget()->id(false)->label('Middle')->variant(ButtonVariant::OUTLINE_SECONDARY),
        Button::widget()->id(false)->label('Right')->variant(ButtonVariant::OUTLINE_SUCCESS),
    );
```

### Checkbox Button Groups
Create a button group with checkbox inputs:

```php
use Yiisoft\Html\Tag\Input\Checkbox;

$buttonGroup = ButtonGroup::widget()
    ->ariaLabel('Basic checkbox toggle button group')
    ->buttons(
        Checkbox::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-check1')
            ->sideLabel('Checkbox 1', ['class' => 'btn btn-outline-primary']),
        Checkbox::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-check2')
            ->sideLabel('Checkbox 2', ['class' => 'btn btn-outline-primary']),
        Checkbox::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-check3')
            ->sideLabel('Checkbox 3', ['class' => 'btn btn-outline-primary']),
    );
```

### Radio Button Groups
Create a button group with radio inputs:

```php
use Yiisoft\Html\Tag\Input\Radio;

$buttonGroup = ButtonGroup::widget()
    ->ariaLabel('Basic radio toggle button group')
    ->buttons(
        Radio::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-radio1')
            ->sideLabel('Radio 1', ['class' => 'btn btn-outline-primary']),
        Radio::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-radio2')
            ->sideLabel('Radio 2', ['class' => 'btn btn-outline-primary']),
        Radio::tag()
            ->attributes(['autocomplete' => 'off'])
            ->class('btn-check')
            ->id('btn-radio3')
            ->sideLabel('Radio 3', ['class' => 'btn btn-outline-primary']),
    );
```
