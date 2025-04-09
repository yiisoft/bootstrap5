# Modal

The **Modal** widget renders a [modal](https://getbootstrap.com/docs/5.3/components/modal/#examples) component.

You can use it to display content in a secondary window that temporarily blocks interactions with the main view.

Modals are perfect for dialogs, forms, notifications, or any content that requires focused user attention.

## Key Features
- Customizable header, body, and footer sections.
- Multiple size options including responsive and fullscreen variants.
- Vertical centering and scrollable content options.
- Static backdrop mode to prevent closing on outside clicks.
- Customizable trigger button for opening the modal.

## Quick Start
To get started, instantiate the **Modal** widget and customize it as needed. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Modal;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\P;
?>

<?= Modal::widget()
    ->body(P::tag()->content('Modal body text goes here.'))
    ->footer(
        Button::tag()
            ->addClass('btn btn-secondary')
            ->attribute('data-bs-dismiss', 'modal')
            ->content('Close'),
        Button::tag()
            ->addClass('btn btn-primary')
            ->content('Save changes'),
    )
    ->id('exampleModal')
    ->title('Modal title')
    ->triggerButton('Launch modal')
?>
```

This generates a standard modal with a header, body text, and two buttons in the footer, along with a trigger button to open it.

## Configuration

### Setting Attributes
Customize the modal container with HTML attributes:

```php
Modal::widget()
    ->attributes(['id' => 'my-modal'])
    ->class('custom-modal');
```

Add single attributes:

```php
Modal::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Modal::widget()->addAttributes(['data-id' => '123', 'data-action' => 'submit']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Modal::widget()->addClass('custom-class', BackgroundColor::PRIMARY);
```

Replace all existing classes:

```php
Modal::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the modal:

```php
Modal::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
Modal::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Customizing Content
Set the body content:

```php
Modal::widget()->body('Modal body content here');

// With complex content using HTML objects
Modal::widget()->body(
    P::tag()->content('First paragraph'),
    P::tag()->content('Second paragraph'),
);
```

Add a title to the modal:

```php
// Default H5 title
Modal::widget()->title('Modal Title');

// Custom tag and attributes
Modal::widget()->title('Modal Title', 'H3', ['class' => 'text-danger']);

// Using a stringable object
Modal::widget()->title(H3::tag()->content('Modal Title')->addClass('text-danger'));
```

Set the footer content:

```php
Modal::widget()->footer(
    Button::tag()
        ->addClass('btn btn-secondary')
        ->attribute('data-bs-dismiss', 'modal')
        ->content('Close'),
    Button::tag()
        ->addClass('btn btn-primary')
        ->content('Save changes'),
);
```

### Section Attributes
Customize specific sections of the modal:

```php
// Body section
Modal::widget()->bodyAttributes(['class' => 'custom-body', 'data-id' => '123']);

// Header section
Modal::widget()->headerAttributes(['class' => 'bg-light']);

// Footer section
Modal::widget()->footerAttributes(['class' => 'border-top-0']);

// Content section
Modal::widget()->contentAttributes(['class' => 'border-0']);

// Dialog section
Modal::widget()->dialogAttributes(['class' => 'border-radius-lg']);
```

### Trigger Button
Configure the button that opens the modal:

```php
// Default button
Modal::widget()->triggerButton();

// Custom label
Modal::widget()->triggerButton('Open Settings');

// With static backdrop (prevents closing when clicking outside)
Modal::widget()->triggerButton('Open Settings', true);

// With custom attributes
Modal::widget()->triggerButton('Open Settings', false, ['class' => 'btn btn-danger']);
```

### Close Button
Customize the close button in the header:

```php
// Set close button label (default is empty)
Modal::widget()->closeButtonLabel('×');

// Add attributes to close button
Modal::widget()->closeButtonAttributes(['class' => 'custom-close', 'aria-label' => 'Exit']);
```

## Modal Sizing

### Responsive Sizing
Change the width of the modal:

```php
use Yiisoft\Bootstrap5\Utility\Responsive;

// Small modal
Modal::widget()->responsive(Responsive::SM);

// Large modal
Modal::widget()->responsive(Responsive::LG);

// Extra large modal
Modal::widget()->responsive(Responsive::XL);
```

### Fullscreen Variants
Make the modal fullscreen:

```php
// Always fullscreen
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN);

// Fullscreen below specific breakpoints
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN_SM_DOWN);
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN_MD_DOWN);
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN_LG_DOWN);
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN_XL_DOWN);
Modal::widget()->fullscreen(ModalDialogFullScreenSize::FULLSCREEN_XXL_DOWN);
```

### Vertical Centering
Center the modal vertically:

```php
Modal::widget()->verticalCentered();
```

### Scrollable Content
Enable scrolling for modals with long content:

```php
Modal::widget()->scrollable();

// Combine with vertical centering
Modal::widget()->scrollable()->verticalCentered();
```
