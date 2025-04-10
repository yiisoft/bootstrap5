# Toast

The **Toast** widget renders a [toast](https://getbootstrap.com/docs/5.3/components/toasts/#examples) component.

You can use it to create lightweight notifications similar to push notifications used in mobile and desktop operating
systems. Toasts are built with flexbox and are easy to align and position.

## Key Features
- Customizable header with support for images, titles, and timestamps.
- Simple body content or custom complex content.
- Optional dismissable functionality with customizable close button.
- Trigger button integration for displaying toast notifications on demand.
- Flexible positioning through container utilities.

## Important Note
Toasts are opt-in for performance reasons, so **you must initialize them with JavaScript** after rendering:

```javascript
// Initialize all toasts on the page
const toastElList = document.querySelectorAll('.toast');
const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));

// Or initialize a specific toast
const toastElement = document.getElementById('myToast');
const toast = new bootstrap.Toast(toastElement);

// Show the toast
toast.show();
```

## Quick Start
To get started, instantiate the **Toast** widget and customize it as needed. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Toast;
?>

<?= Toast::widget()
        ->body('Hello, world! This is a toast message.')
        ->image('path/to/image.jpg', 'Bootstrap logo', ['class' => 'rounded me-2'])
        ->time('11 mins ago', [], 'text-body-secondary')
        ->title('Bootstrap')
?>
```

This generates a simple toast notification with a header containing an image, title, timestamp, and a close button,
along with some body content.

## Configuration

### Setting Attributes
Customize the toast container with HTML attributes:

```php
Toast::widget()
    ->attributes(['id' => 'my-toast'])
    ->class('custom-toast');
```

Add single attributes:

```php
Toast::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Toast::widget()->addAttributes(['data-id' => '123', 'data-bs-autohide' => 'false']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Toast::widget()->addClass('text-dark', 'border-0');
```

Replace all existing classes:

```php
Toast::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the toast:

```php
Toast::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
Toast::widget()->addCssStyle(['max-width' => '300px', 'opacity' => '0.95']);
```

### Customizing Content
Set the body content:

```php
// Simple text content
Toast::widget()->body('Hello, world! This is a toast message.');

// With HTML content
Toast::widget()->body('<strong>Bold text</strong> and <em>italic text</em>.', [], 'custom-body-class');

// With attributes
Toast::widget()->body('Message content', ['data-id' => 'body123'], 'p-3');
```

For complete custom content, use the `content()` method:

```php
Toast::widget()->content(
    '<div class="toast-header">',
    '  <img src="logo.png" class="rounded me-2" alt="logo">',
    '  <strong class="me-auto">Custom title</strong>',
    '  <small>Just now</small>',
    '  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>',
    '</div>',
    '<div class="toast-body">',
    '  Custom body with any HTML content.',
    '</div>'
);
```

### Header Components
Add a title to the toast header:

```php
// Basic title
Toast::widget()->title('Notification');

// With custom classes
Toast::widget()->title('Notification', [], 'fw-bold', 'text-primary');

// With attributes
Toast::widget()->title('Notification', ['data-id' => 'title123']);
```

Add an image to the header:

```php
// Simple image
Toast::widget()->image('path/to/image.jpg', 'Logo');

// With custom classes and attributes
Toast::widget()->image('path/to/image.jpg', 'Logo', ['class' => 'rounded me-2', 'width' => '20']);
```

Add a timestamp:

```php
// Basic timestamp
Toast::widget()->time('5 mins ago');

// With custom classes
Toast::widget()->time('5 mins ago', [], 'text-body-secondary', 'small');
```

Customize the header attributes:

```php
Toast::widget()->headerAttributes(['class' => 'bg-light', 'data-test' => 'header']);
```

### Close Button
Customize the close button:

```php
// Custom close button text (default is empty)
Toast::widget()->closeButton('×');

// Using a custom HTML string or component
Toast::widget()->closeButton('<button class="custom-close">Close</button>');
```

### Container and Positioning
Enable a positioning container:

```php
Toast::widget()->container(true);
```

By default, the container uses the class `toast-container position-fixed bottom-0 end-0 p-3`, which positions toasts at
the bottom-right corner of the screen.

### Trigger Button
Add a button to trigger the toast:

```php
// Default button with default text
Toast::widget()->triggerButton();

// Custom button text
Toast::widget()->triggerButton('Show notification');

// With custom attributes
Toast::widget()->triggerButton('Show notification', ['class' => 'btn btn-success']);
```
