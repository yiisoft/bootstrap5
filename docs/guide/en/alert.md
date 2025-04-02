# Alert

The **Alert** widget renders an [alert](https://getbootstrap.com/docs/5.3/components/alerts/) component.

You can use it to provide contextual feedback messages for typical user actions with a handful of available and flexible
alert messages.

## Key Features
- Multiple variants (primary, secondary, success, danger, etc.).
- Optional dismissible functionality with customizable close button.
- Support for headers and body content.
- Fade animation support.
- Template customization.

## Quick Start
To get started, instantiate the `Alert` widget and customize it as needed. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Alert;
use Yiisoft\Bootstrap5\AlertVariant;
?>

<?= Alert::widget()
        ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.', false)
        ->dismissable(true)
        ->fade(true)
        ->id(false)
        ->variant(AlertVariant::DANGER)
?>
```

This generates a simple alert with a dismissed button, a fade animation, and a danger variant.

## Configuration

### Setting Attributes
Customize the alert container with HTML attributes:

```php
$alert = Alert::widget()
    ->attributes(['id' => 'my-alert'])
    ->class('custom-alert');
```

For the dismissible button, use `closeButtonAttributes()`:

```php
$alert = Alert::widget()->closeButtonAttributes(['data-test' => 'dismiss-button']);
```

### Customizing Body
Set the body content with optional HTML encoding:

```php
$alert = Alert::widget()->body('Simple text message'); 

// With HTML content (disable encoding)
$alert = Alert::widget()->body('<strong>Important:</strong> Read this carefully.', false);
```

### Adding Headers
Add an optional header to your alert:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->header('Title for the message')
    ->variant(AlertVariant::INFO);
``` 

Customize the header tag (default to h4):

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->header('Title for the message')
    ->headerTag('h5');
```

Add attributes to the header:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->header('Title for the message')
    ->headerAttributes(['class' => 'custom-header'])
    ->headerTag('h5');
```

### Customizing Close Button
Customize the close button label (default is empty):

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->closeButtonLabel('Close')
    ->dismissable(true);
```

Change the close button tag:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->closeButtonTag('span')
    ->dismissable(true);
```

Add attribute:

```php
$alert = Alert::widget()
    ->addCloseButtonAttributes(['class' => 'btn-close'])
    ->dismissable(true);
```

Add class:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->addCloseButtonClass('btn-close')
    ->dismissable(true);
```

Add style:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->addCloseButtonStyle('color: red;')
    ->dismissable(true);
```

### Template Customization
Customize the template used for rendering the alert:

```php
$alert = Alert::widget()
    ->body('Simple text message')
    ->header('Title for the message')
    ->templateContent("\n{body}\n{header}\n{toggler}\n");
```
