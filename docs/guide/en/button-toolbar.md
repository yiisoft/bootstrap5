# Button Toolbar

The **ButtonToolbar** widget renders a [button toolbar](https://getbootstrap.com/docs/5.3/components/button-group/#button-toolbar) component.

You can use it to combine sets of button groups into button toolbars for more complex components. Button toolbars help
organize related buttons and provide a clean, consistent interface for user interactions.

## Key Features
- Combines multiple button groups into a cohesive toolbar.
- Supports custom HTML elements within toolbar layout.
- Customizable with spacing utilities for optimal arrangement.

## Quick Start
To get started, instantiate the **ButtonToolbar** widget and add button groups to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Button;
use Yiisoft\Bootstrap5\ButtonGroup;
use Yiisoft\Bootstrap5\ButtonToolbar;
use Yiisoft\Bootstrap5\ButtonVariant;
?>

<?= ButtonToolbar::widget()
        ->ariaLabel('Toolbar with button groups')
        ->buttonGroups(
            ButtonGroup::widget()
                ->addClass('me-2')
                ->ariaLabel('First group')
                ->buttons(
                    Button::widget()->label('1')->variant(ButtonVariant::PRIMARY),
                    Button::widget()->label('2')->variant(ButtonVariant::PRIMARY),
                    Button::widget()->label('3')->variant(ButtonVariant::PRIMARY),
                    Button::widget()->label('4')->variant(ButtonVariant::PRIMARY),
                ),
            ButtonGroup::widget()
                ->addClass('me-2')
                ->ariaLabel('Second group')
                ->buttons(
                    Button::widget()->label('5'),
                    Button::widget()->label('6'),
                    Button::widget()->label('7'),
                ),
            ButtonGroup::widget()
                ->ariaLabel('Third group')
                ->buttons(
                    Button::widget()->label('8')->variant(ButtonVariant::INFO),
                )
        )
?>
```

This generates a toolbar containing three button groups with proper spacing between them.

## Configuration

### Setting Attributes
Customize the button toolbar container with HTML attributes:

```php
ButtonToolbar::widget()
    ->attributes(['id' => 'my-toolbar'])
    ->class('custom-toolbar');
```

Add single attributes:

```php
ButtonToolbar::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
ButtonToolbar::widget()->addAttributes(['data-id' => '123', 'data-action' => 'submit']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
ButtonToolbar::widget()->addClass('custom-class', 'extra-padding');
```

Replace all existing classes:

```php
ButtonToolbar::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the toolbar:

```php
ButtonToolbar::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
ButtonToolbar::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### ARIA Label
Set an ARIA label for accessibility:

```php
ButtonToolbar::widget()->ariaLabel('Toolbar with editing buttons');
```
### Combining With Input Groups
Mix button groups with input groups for more complex toolbars:

```php
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Input;

ButtonToolbar::widget()
    ->ariaLabel('Toolbar with button groups and input')
    ->buttonGroups(
        ButtonGroup::widget()
            ->addClass('me-2')
            ->buttons(
                Button::widget()->label('1')->variant(ButtonVariant::PRIMARY),
                Button::widget()->label('2')->variant(ButtonVariant::PRIMARY),
            ),
        Div::tag()
            ->addClass('input-group')
            ->content(
                Div::tag()
                    ->class('input-group-text')
                    ->content('@')
                    ->id('btnGroupAddon'),
                Input::text()
                    ->attributes(
                        [
                            'aria-label' => 'Input group example',
                            'aria-describedby' => 'btnGroupAddon',
                            'placeholder' => 'Input group example',
                        ]
                    ),
                    ->class('form-control'),
            )
    );
```
