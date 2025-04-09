# Nav

The **Nav** widget renders a [navigation](https://getbootstrap.com/docs/5.3/components/navs-tabs/#base-nav) component.

You can use it to create various navigation elements including horizontal nav menus, tabs, pills, and vertical navigation. 

## Key Features
- Multiple navigation styles including standard navigation, tabs, pills, and vertical layout.
- Built-in tab content management with fade effect support.
- Automatic active state handling based on current URL path.
- Integration with dropdowns for complex navigation menus.

## Quick Start
To get started, instantiate the **Nav** widget and add items to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Nav;
use Yiisoft\Bootstrap5\NavLink;
?>

<?= Nav::widget()
        ->items(
            NavLink::to('Active', '#', active: true),
            NavLink::to('Link', url: '#'),
            NavLink::to('Link', url: '#'),
            NavLink::to('Disabled', '#', disabled: true),
        );
?>
```

This generates a simple navigation menu with four links, including an active link and a disabled link.

## Configuration

### Setting Attributes
Customize the nav container with HTML attributes:

```php
Nav::widget()
    ->attributes(['id' => 'my-nav'])
    ->class('custom-nav');
```

Add single attributes:

```php
Nav::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Nav::widget()->addAttributes(['data-id' => '123', 'data-action' => 'navigate']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Nav::widget()->addClass('custom-class', BackgroundColor::PRIMARY);
```

Replace all existing classes:

```php
Nav::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the nav:

```php
Nav::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
Nav::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Working with Tabs
Create tabbed content with the `NavLink::tab()` method:

```php
Nav::widget()
    ->id('my-tabs')
    ->items(
        NavLink::tab('Home', 'Home content goes here', active: true),
        NavLink::tab('Profile', 'Profile content goes here'),
        NavLink::tab('Contact', 'Contact information goes here'),
        NavLink::tab('Disabled', 'This content is not accessible', disabled: true)
    )
    ->styles(NavStyle::TABS)
    ->fade(true);
```

Customize tab panes with IDs and attributes:

```php
Nav::widget()
    ->items(
        NavLink::tab('Tab 1', 'Content for tab 1', paneId: 'custom-id-1', paneAttributes: ['class' => 'p-4']),
        NavLink::tab('Tab 2', 'Content for tab 2', paneId: 'custom-id-2')
    )
    ->styles(NavStyle::TABS);
```

### Active Item Detection
Set active items based on current URL:

```php
Nav::widget()
    ->currentPath('/current-page')
    ->items(
        NavLink::to('Home', '/home'),
        NavLink::to('Current Page', '/current-page'), // Will be active
        NavLink::to('Other Page', '/other-page')
    );
```

Disable automatic active item detection:

```php
Nav::widget()->activateItems(false);
```

## Examples

### Basic Pills Example
Create a pills navigation:

```php
Nav::widget()
    ->items(
        NavLink::to('Active', '#', active: true),
        NavLink::to('Link', '#'),
        NavLink::to('Link', '#'),
        NavLink::to('Disabled', '#', disabled: true)
    )
    ->styles(NavStyle::PILLS)
    ->render();
```

### Dropdown
Create with dropdown integration:

```php
Nav::widget()
    ->items(
        NavLink::to('Active', '#', active: true),
        Dropdown::widget()
            ->items(
                DropdownItem::link('Action', '#'),
                DropdownItem::link('Another action', '#'),
                DropdownItem::link('Something else here', '#'),
                DropdownItem::divider(),
                DropdownItem::link('Separated link', '#')
            )
            ->togglerContent('Dropdown'),
        NavLink::to('Link', '#'),
        NavLink::to('Disabled', '#', disabled: true)
    )
    ->styles(NavStyle::TABS)
    ->render();
```

### Fill and Justify
Create navigation that fills available space:

```php
Nav::widget()
    ->items(
        NavLink::to('Active', '#', active: true),
        NavLink::to('Much longer nav link', '#'),
        NavLink::to('Link', '#'),
        NavLink::to('Disabled', '#', disabled: true)
    )
    ->styles(NavStyle::PILLS, NavLayout::FILL)
    ->render();
```

### Vertical Navigation
Create vertical navigation with flex utilities:

```php
Nav::widget()
    ->addClass('flex-sm-row')
    ->items(
        NavLink::to('Active', '#', active: true),
        NavLink::to('Longer nav link', '#', active: true),
        NavLink::to('Link', url: '#'),
        NavLink::to('Disabled', '#', disabled: true),
    )
    ->styles(NavStyle::PILLS, NavLayout::VERTICAL)
    ->tag('nav')
    ->render();
```
