# Button

The **Button** widget renders a [button](https://getbootstrap.com/docs/5.3/components/buttons/#base-class) component.

You can use it to create interactive elements like standard buttons, link buttons, toggle buttons, and form submission
buttons. Buttons can be styled in different variants, sizes, and states to match your application's design needs.

## Key Features
- Supports multiple button types: standard button, link, reset, submit, and input buttons.
- Various visual variants (primary, secondary, success, danger, etc.).
- Customizable sizes (small, large, default).
- Toggle state functionality.
- Disabled state support.

## Quick Start
To get started, instantiate the **Button** widget and customize it as needed. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Button;
use Yiisoft\Bootstrap5\ButtonSize;
use Yiisoft\Bootstrap5\ButtonVariant;
?>

<?= Button::widget()
        ->label('Primary Button')
        ->size(ButtonSize::LARGE)
        ->variant(ButtonVariant::PRIMARY)
?>
```

This generates a large primary button with the text "Primary Button."

## Configuration

### Setting Attributes
Customize the button container with HTML attributes:

```php
$button = Button::widget()
    ->attributes(['id' => 'my-button'])
    ->class('custom-button');
```

Add single attributes:

```php
$button = Button::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
$button = Button::widget()->addAttributes(['data-id' => '123', 'data-action' => 'submit']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
$button = Button::widget()->addClass('btn-rounded', 'text-uppercase');
```

Replace all existing classes:

```php
$button = Button::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the button:

```php
$button = Button::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
$button = Button::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Button Variants
Set the button's visual variant:

```php
$button = Button::widget()->variant(ButtonVariant::SUCCESS);
$button = Button::widget()->variant(ButtonVariant::OUTLINE_DANGER);
```

### Button Sizes
Change the button size:

```php
$button = Button::widget()->size(ButtonSize::LARGE);
$button = Button::widget()->size(ButtonSize::SMALL);
```

### Button Types
Create different types of buttons:

**Submit Button**:
```php
// Using factory method
$button = Button::submit('Submit Form');

// Using type method
$button = Button::widget()
    ->label('Submit Form')
    ->type(ButtonType::SUBMIT);
```

**Reset Button**:
```php
// Using factory method
$button = Button::reset('Reset Form');

// Using type method
$button = Button::widget()
    ->label('Reset Form')
    ->type(ButtonType::RESET);
```

**Link Button**:
```php
// Using factory method
$button = Button::link('Visit Page', '/path/to/page');

// Using type method
$button = Button::widget()
    ->label('Visit Page')
    ->type(ButtonType::LINK)
    ->url('/path/to/page');
```

**Input Submit Button**:
```php
// Using factory method
$button = Button::submitInput('Submit');

// Using type method
$button = Button::widget()
    ->label('Submit')
    ->type(ButtonType::SUBMIT_INPUT);
```

**Input Reset Button**:
```php
// Using factory method
$button = Button::resetInput('Reset');

// Using type method
$button = Button::widget()
    ->label('Reset')
    ->type(ButtonType::RESET_INPUT);
```

### Button States

**Active State**:
```php
$button = Button::widget()->active()->label('Active Button');
```

**Disabled State**:
```php
$button = Button::widget()->disabled()->label('Disabled Button');
```

### Toggle Functionality
Add toggle behavior to the button:

```php
$button = Button::widget()
    ->label('Toggle Button')
    ->toggle()
    ->variant(ButtonVariant::PRIMARY);

// Specify a toggler type
$button = Button::widget()
    ->label('Modal Toggle')
    ->toggle(TogglerType::MODAL);
```

### Text Formatting

**Prevent Text Wrapping**:
```php
$button = Button::widget()->label('Long Button Text')->disableTextWrapping();
```

**Using HTML in Labels**:
```php
$button = Button::widget()->label('<i>HTML Content</i>', false);
```
