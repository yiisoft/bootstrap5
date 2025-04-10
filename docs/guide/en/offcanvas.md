# Offcanvas

The **Offcanvas** widget renders a [offcanvas](https://getbootstrap.com/docs/5.3/components/offcanvas/#examples) component.

You can use it to create hidden sidebars that slide in from the edge of the screen when triggered. Offcanvas components
are perfect for navigation menus, control panels, and other content that doesn't need to be visible at all times.

## Key Features
- Multiple placement options (top, right/end, bottom, left/start).
- Responsive behavior with different display modes based on screen size.
- Backdrop options including static backdrops and body scrolling control.
- Customizable toggler button with various styling options.
- Theme support for light/dark modes.

## Quick Start
To get started, instantiate the **Offcanvas** widget and add content between its `begin()` and `end()` calls.
Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Dropdown;
use Yiisoft\Bootstrap5\DropdownItem;
use Yiisoft\Bootstrap5\Offcanvas;
use Yiisoft\Bootstrap5\OffcanvasPlacement;
?>

<?= Offcanvas::widget()
        ->id('offcanvasExample')
        ->title('Offcanvas')
        ->togglerContent('Button with data-bs-target')
        ->begin()
?>
<?= Div::tag()->content(
        "\n",
        'Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.',
        "\n",
    )
?>
<?= Dropdown::widget()
        ->addClass('mt-3')
        ->items(
            DropdownItem::link('Action', '#'),
            DropdownItem::link('Another action', '#'),
            DropdownItem::link('Something else here', '#'),
        )
?>
<?= Offcanvas::end();
```

This generates an offcanvas panel that appears from the left/start side of the screen with a toggle button.

## Configuration

### Setting Attributes
Customize the offcanvas container with HTML attributes:

```php
Offcanvas::widget()
    ->attributes(['id' => 'my-offcanvas'])
    ->class('custom-offcanvas');
```

Add single attributes:

```php
Offcanvas::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Offcanvas::widget()->addAttributes(['data-id' => '123', 'data-animation' => 'slide']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Offcanvas::widget()->addClass('custom-class', BackgroundColor::PRIMARY);
```

Replace all existing classes:

```php
Offcanvas::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the offcanvas:

```php
Offcanvas::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
Offcanvas::widget()->addCssStyle(['max-height' => '90vh', 'color' => 'darkblue']);
```

### Placement Options
Position the offcanvas at different locations:

```php
// Left side (default)
Offcanvas::widget()->placement(OffcanvasPlacement::START);

// Right side
Offcanvas::widget()->placement(OffcanvasPlacement::END);

// Top
Offcanvas::widget()->placement(OffcanvasPlacement::TOP);

// Bottom
Offcanvas::widget()->placement(OffcanvasPlacement::BOTTOM);
```

### Scrollable Content
Allow body scrolling while the offcanvas is open:

```php
// Enable scrolling with backdrop
Offcanvas::widget()->scrollable();

// Enable scrolling without backdrop
Offcanvas::widget()
    ->scrollable()
    ->backdrop(false);
```

### Backdrop Options
Customize the backdrop behavior:

```php
// Enable backdrop
Offcanvas::widget()->backdrop();

// Static backdrop (prevents closing when clicking outside)
Offcanvas::widget()->backdropStatic();
```

### Initial Visibility
Show the offcanvas when the page loads:

```php
Offcanvas::widget()->show();
```

### Header and Title Configuration
Customize the header and title:

```php
// Set the title
Offcanvas::widget()->title('Menu Options');

// Add attributes to the header
Offcanvas::widget()->headerAttributes(['class' => 'bg-light']);

// Add attributes to the title
Offcanvas::widget()->titleAttributes(['class' => 'fw-bold']);
```

### Body Configuration
Customize the body section:

```php
Offcanvas::widget()->bodyAttributes(['class' => 'p-4']);
```

### Theme Support
Apply light or dark theme to the offcanvas:

```php
// Dark theme
Offcanvas::widget()->theme('dark');

// Light theme
Offcanvas::widget()->theme('light');
```

### Toggler Customization
Customize the button or link that opens the offcanvas:

Add attribute to the toggler:

```php
Offcanvas::widget()->addTogglerAttribute('data-id', '123');
```

Add CSS classes to the toggler:

```php
Offcanvas::widget()->addTogglerClass('btn-lg', 'rounded-pill');
```

Add styles to the toggler:

```php
Offcanvas::widget()->addTogglerCssStyle('text-transform: uppercase;');
```

Set toggler attributes:

```php
Offcanvas::widget()->togglerAttributes(['class' => 'btn btn-danger', 'data-test' => 'toggler']);
```

Set toggler content:
```php
Offcanvas::widget()->togglerContent('Open Panel');
```

Custom stringable object:
```php
use Yiisoft\Html\Tag\Button;

Offcanvas::widget()->toggler(Button::button('Custom Toggle')->addClass('btn btn-success'));
```

### Responsive Behavior
Make the offcanvas responsive based on viewport size:

```php
// Show as full offcanvas below small breakpoint (≥576px)
Offcanvas::widget()->responsive(Responsive::SM);

// Show as full offcanvas below medium breakpoint (≥768px)
Offcanvas::widget()->responsive(Responsive::MD);

// Show as full offcanvas below large breakpoint (≥992px)
Offcanvas::widget()->responsive(Responsive::LG);

// Show as full offcanvas below extra large breakpoint (≥1200px)
Offcanvas::widget()->responsive(Responsive::XL);

// Show as full offcanvas below extra extra large breakpoint (≥1400px)
Offcanvas::widget()->responsive(Responsive::XXL);
```
