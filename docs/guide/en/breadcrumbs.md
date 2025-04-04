# Breadcrumbs
The **Breadcrumbs** widget renders a [breadcrumb](https://getbootstrap.com/docs/5.3/components/breadcrumb/#example) component.

You can use it to create a navigation trail that helps users understand and navigate the hierarchy of your website or
application. Each breadcrumb item can be a clickable link or an active (non-clickable) label representing the current
page.

## Key Features
- Supports multiple breadcrumb items as links or active text.
- Customizable divider between items (for example, slashes, arrows).
- Configurable active item styling and behavior.

## Quick Start
To get started, instantiate the **Breadcrumbs** widget and add links to it. Here is a basic example:

```php
<?= Breadcrumbs::widget()
        ->links(
            BreadcrumbLink::to('Home', '/'),
            BreadcrumbLink::to('Library', '/library'),
            BreadcrumbLink::to('Data', active: true),
        );
?>
```

This generates a simple breadcrumb navigation with three items: two clickable links and one active item.

## Configuration

### Setting Attributes
Customize the breadcrumb container with HTML attributes:

```php
$breadcrumb = Breadcrumbs::widget()
    ->attributes(['id' => 'my-breadcrumb'])
    ->class('custom-breadcrumb');
```

Add single attributes:

```php
$breadcrumb = Breadcrumbs::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
$breadcrumb = Breadcrumbs::widget()->addAttributes(['data-id' => '123', 'data-action' => 'submit']);
```

For the list of items, use `listAttributes()`:

```php
$breadcrumb = Breadcrumbs::widget()->itemAttributes(['data-test' => 'item']);
```

For links within items, use `linkAttributes()`:

```php
$breadcrumb = Breadcrumbs::widget()->linkAttributes(['class' => 'custom-link']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
$breadcrumb = Breadcrumbs::widget()->addClass('btn-rounded', 'text-uppercase');
```

Replace all existing classes:

```php
$breadcrumb = Breadcrumbs::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the button:

```php
$breadcrumb = Breadcrumbs::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
$breadcrumb = Breadcrumbs::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Customizing the Divider
Change the divider between breadcrumb items (default is a forward slash `/`):

```php
$breadcrumb = Breadcrumbs::widget()->divider('>');
```

### Active Item Styling
Customize the CSS class for the active item (default is `active`):

```php
$breadcrumb = Breadcrumbs::widget()->itemActiveClass('current-page');
```

### ARIA Label
Set an ARIA label for accessibility (default is `breadcrumb`):

```php
$breadcrumb = Breadcrumbs::widget()->ariaLabel('Navigation path');
```

### List Tag
Change the HTML tag used for the list (default is `ol`):

```php
$breadcrumb = Breadcrumbs::widget()->listTagName('ul');
```
