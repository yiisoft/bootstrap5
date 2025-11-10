# NavBar

The **NavBar** widget renders a [navbar](https://getbootstrap.com/docs/5.3/components/navbar/#supported-content) component.

You can use it to create a responsive navigation header for your application. The navbar supports branding, navigation
links, dropdowns, toggling for mobile devices, and more advanced features such as container layouts and positioning.

## Key Features
- Responsive collapsible behavior for mobile devices with an automatic hamburger menu.
- Customizable brand section with support for text, images, or combined elements.
- Flexible positioning options (fixed top/bottom, sticky top/bottom).
- Container and inner container layout configuration.
- Responsive expansion breakpoint control (sm, md, lg, xl, xxl).
- Theme support for light/dark modes.

## Quick Start
To get started, instantiate the **NavBar** widget and add content between its `begin()` and `end()` calls.
Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Dropdown;
use Yiisoft\Bootstrap5\DropdownItem;
use Yiisoft\Bootstrap5\Nav;
use Yiisoft\Bootstrap5\NavBar;
use Yiisoft\Bootstrap5\NavLink;
use Yiisoft\Bootstrap5\NavStyle;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;
?>

<?= NavBar::widget()
        ->addClass(BackgroundColor::BODY_TERTIARY)
        ->brandText('NavBar')
        ->brandUrl('#')
        ->id('navbarSupportedContent')
        ->begin()
?>
<?= Nav::widget()
        ->currentPath('/home')
        ->items(
            NavLink::to('Home', '/home'),
            NavLink::to('Link', '/link'),
            Dropdown::widget()
                ->items(
                    DropdownItem::link('Action', '/sub/action'),
                    DropdownItem::link('Another action', '/sub/another-action'),
                    DropdownItem::divider(),
                    DropdownItem::link('Something else here', '/sub/something-else'),
                )
                ->togglerContent('Dropdown'),
            NavLink::to('Disabled', '#', disabled: true),
        )
        ->styles(NavStyle::NAVBAR)
?>
<?= NavBar::end();
```

This generates a responsive navbar with a brand section, navigation links, and a dropdown menu. The navbar will collapse
into a hamburger menu on smaller screens.

## Configuration

### Setting Attributes
Customize the navbar container with HTML attributes:

```php
NavBar::widget()
    ->attributes(['id' => 'my-navbar'])
    ->class('custom-navbar');
```

Add single attributes:

```php
NavBar::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
NavBar::widget()->addAttributes(['data-id' => '123', 'data-test-id' => 'navbar']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
NavBar::widget()->addClass('custom-class', 'bg-dark');
```

Replace all existing classes:

```php
NavBar::widget()->class('custom-class', 'another-class', BackgroundColor::PRIMARY);
```

### Adding CSS Styles
Add CSS styles to the navbar:

```php
NavBar::widget()->addCssStyle('border-bottom: 1px solid #ccc;');
```

Add multiple styles:

```php
NavBar::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Brand Configuration
Configure the navbar brand (logo/title) section:

```php
// Text brand
NavBar::widget()->brandText('My Website');

// Image brand
NavBar::widget()->brandImage('/path/to/logo.svg');

// Image with attributes
NavBar::widget()
    ->brandImage('/path/to/logo.svg')
    ->brandImageAttributes(['width' => 30, 'height' => 24, 'alt' => 'Logo']);

// Combined image and text
NavBar::widget()
    ->brandImage('/path/to/logo.svg')
    ->brandText('My Website')
    ->brandUrl('/');

// Custom brand element
use Yiisoft\Html\Tag\Span;

NavBar::widget()->brand(Span::tag()->content('Custom Brand')->addClass('text-danger'));

// Brand attributes
NavBar::widget()->brandAttributes(['class' => 'fw-bold', 'data-test' => 'brand']);
```

### Container Options
Configure container behavior and attributes:

```php
// Wrap navbar in outer container
NavBar::widget()->container(true);

// Set container attributes
NavBar::widget()
    ->container(true)
    ->containerAttributes(['class' => 'container-md']);

// Inner container configuration
NavBar::widget()
    ->innerContainer(true)
    ->innerContainerAttributes(['class' => 'container-fluid px-4']);
```

### Expansion Breakpoint
Set the breakpoint where the navbar expands from hamburger menu to full navigation:

```php
// Small breakpoint (≥576px)
NavBar::widget()->expand(NavBarExpand::SM);

// Medium breakpoint (≥768px)
NavBar::widget()->expand(NavBarExpand::MD);

// Large breakpoint (≥992px)
NavBar::widget()->expand(NavBarExpand::LG);

// Extra large breakpoint (≥1200px)
NavBar::widget()->expand(NavBarExpand::XL);

// Extra extra large breakpoint (≥1400px)
NavBar::widget()->expand(NavBarExpand::XXL);
```

### Placement Options
Position the navbar at different locations on the page:

```php
// Fixed to top of viewport
NavBar::widget()->placement(NavBarPlacement::FIXED_TOP);

// Fixed to bottom of viewport
NavBar::widget()->placement(NavBarPlacement::FIXED_BOTTOM);

// Sticky top (stays at top when scrolling down)
NavBar::widget()->placement(NavBarPlacement::STICKY_TOP);

// Sticky bottom (stays at bottom when scrolling up)
NavBar::widget()->placement(NavBarPlacement::STICKY_BOTTOM);
```

### Theme Support
Apply light or dark theme to the navbar:

```php
// Dark theme
NavBar::widget()->theme('dark');

// Light theme
NavBar::widget()->theme('light');
```

### Toggler Customization
Customize the hamburger menu toggler button:

Add attribute:

```php
NavBar::widget()->addTogglerAttribute(['data-id' => '123']);
```

Add class:

```php
NavBar::widget()->addTogglerClass('custom-class', null, 'another-class', BackgroundColor::PRIMARY);
```

Add style:

```php
NavBar::widget()->addTogglerCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

Custom content:
```php
NavBar::widget()->toggler('<span>Menu</span>');
```

Custom stringable object:
```php
use Yiisoft\Html\Tag\Button;

NavBar::widget()->toggler(Button::button('Toggle')->addClass('navbar-toggler'));
```

### Using `navId()` for the `<nav>` Element

The `id()` method in `NavBar` controls the identifier used by the **collapse container**
(`<div class="collapse navbar-collapse">`) and the corresponding `data-bs-target` and `aria-controls` attributes of the
toggler button.

If you also need a separate `id` for the outer `<nav>` element for example, to apply custom CSS you can use the 
`navId()` method:

```php
NavBar::widget()
    ->id('navbarCollapse')      // ID used by the collapse container and toggler
    ->navId('mainNav')          // ID applied to the <nav> element
    ->begin();
```
