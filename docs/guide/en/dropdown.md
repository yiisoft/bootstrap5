# Dropdown

The **Dropdown** widget renders a [dropdown](https://getbootstrap.com/docs/5.3/components/dropdowns/#single-button) component.

You can use it to create interactive dropdown menus with various item types such as links, buttons, headers, dividers,
or plain text. This component is highly customizable, supporting directions, alignments, themes, and toggle variations.

## Key Features
- Supports multiple item types: links, buttons, headers, dividers, and text.
- Customizable toggle button or link with variants, sizes, and split options.
- Configurable menu alignment and direction using Bootstrap 5 classes.
- Auto close behavior control (for example, close on inside/outside clicks).
- Flexible HTML attribute and CSS class management.

## Quick Start
To get started, instantiate the **Dropdown** widget and add items to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\ButtonVariant;
use Yiisoft\Bootstrap5\Dropdown;
use Yiisoft\Bootstrap5\DropdownItem;
?>

<?= 
    Dropdown::widget()
        ->items(
            DropdownItem::link('Action', '#'),
            DropdownItem::link('Another action', '#'),
            DropdownItem::link('Something else here', '#'),
        )
        ->togglerAsLink()
        ->togglerContent('Dropdown link')
        ->togglerVariant(ButtonVariant::OUTLINE_DANGER)
?>
```

This generates a simple dropdown menu with a toggle button and three clickable items separated by a divider.

## Configuration

### Setting Attributes
Customize the dropdown container with HTML attributes:

```php
$dropdown = Dropdown::widget()
    ->attributes(['id' => 'my-dropdown'])
    ->class('custom-dropdown');
```

For the toggle button, use `togglerAttributes()` and `togglerClass()`:

```php
$dropdown = Dropdown::widget()
    ->togglerAttributes(['data-test' => 'toggle'])
    ->togglerClass('btn-lg');
```

### Customizing the Toggle Button
Change the toggle content, variant, or size:

```php
use Yiisoft\Bootstrap5\ButtonVariant;
use Yiisoft\Bootstrap5\ButtonSize;

$dropdown = Dropdown::widget()
    ->togglerContent('Menu')
    ->togglerVariant(ButtonVariant::PRIMARY)
    ->togglerSize(ButtonSize::SMALL());
```

To use a link instead of a button:

```php
$dropdown = Dropdown::widget()
    ->togglerAsLink()
    ->togglerUrl('/menu');
```

For a split button:

```php
$dropdown = Dropdown::widget()
    ->togglerSplit()
    ->togglerSplitContent('Action')
    ->togglerContent('Options');
```

Add custom attributes to the toggler:

```php
$dropdown = Dropdown::widget()->togglerAttributes(['data-action' => 'toggle']);
```

Add attribute to the toggler:

```php
$dropdown = Dropdown::widget()->addTogglerAttribute(['data-id' => '123']);
```

Add class to the toggler:

```php
$dropdown = Dropdown::widget()->addTogglerClass('custom-class', null, 'another-class', BackgroundColor::PRIMARY);
```

Add style to the toggler:

```php
$dropdown = Dropdown::widget()->addTogglerCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Direction and Alignment
Set the dropdown direction with `direction()`:

```php
use Yiisoft\Bootstrap5\DropdownDirection;

$dropdown = Dropdown::widget()->direction(DropdownDirection::DROPUP);
```

Align the menu with `alignment()`:

```php
use Yiisoft\Bootstrap5\DropdownAlignment;

$dropdown = Dropdown::widget()->alignment(DropdownAlignment::END);
```

### Auto close Behavior
Control when the dropdown closes using `autoClose()`:

```php
use Yiisoft\Bootstrap5\DropdownAutoClose;

$dropdown = Dropdown::widget()->autoClose(DropdownAutoClose::OUTSIDE);
```

### Themes
Apply a Bootstrap theme (for example, dark mode):

```php
$dropdown = Dropdown::widget()->theme('dark');
```

## Item Types
The **DropdownItem** class supports various item types:

- **Link Item**:
  ```php
  DropdownItem::link('Settings', '/settings', active: true)
  ```
- **Button Item**:
  ```php
  DropdownItem::button('Submit', ['data-action' => 'submit'])
  ```
- **Header Item**:
  ```php
  DropdownItem::header('User Menu', 'h5')
  ```
- **Divider Item**:
  ```php
  DropdownItem::divider()
  ```
- **Text Item**:
  ```php
  DropdownItem::text('Status: Online')
  ```
- **Custom Content Item**:
  ```php
  DropdownItem::listContent('<strong>Custom HTML</strong>')
  ```
