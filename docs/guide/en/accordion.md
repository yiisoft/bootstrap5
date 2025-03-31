# Accordion

The Accordion widget renders a Bootstrap 5 accordion component.

You can use it to create collapsible content sections where clicking a header toggles the visibility of its associated
body. 

## Key Features
- Supports multiple collapsible items with headers and bodies.
- Configurable to allow multiple items to remain open simultaneously (`alwaysOpen`).
- Customizable header and toggler tags, attributes, and styles.
- Optional flush styling to remove borders and rounded corners.
- Flexible HTML attribute and CSS class management for container, header, body, and toggler elements.

## Quick Start
To get started, instantiate the `Accordion` widget and add items to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Accordion;
use Yiisoft\Bootstrap5\AccordionItem;
?>

// @link https://getbootstrap.com/docs/5.3/components/accordion/#example
<?= Accordion::widget()
        ->items(
            AccordionItem::to(
                'Accordion Item #1',
                "<strong>This is the first item's accordion body.</strong>" .
                ' It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                ' You can modify any of this with custom CSS or overriding our default variables. ' .
                " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                'accordion-1',
                encodeBody: false,
                active: true
            ),
            AccordionItem::to(
                'Accordion Item #2',
                "<strong>This is the second item's accordion body.</strong>" .
                ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                ' You can modify any of this with custom CSS or overriding our default variables. ' .
                " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                'accordion-2',
                encodeBody: false
            ),
            AccordionItem::to(
                'Accordion Item #3',
                "<strong>This is the third item's accordion body.</strong>" .
                ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                ' You can modify any of this with custom CSS or overriding our default variables. ' .
                " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                'accordion-3',
                encodeBody: false
            ),
        )
        ->id('accordion')
?>
```

This generates a simple accordion with three collapsible items, each with a clickable header and a body that
expands/collapses.

## Configuration

### Setting Attributes
Customize the accordion container with HTML attributes:

```php
$accordion = Accordion::widget()
    ->attributes(['id' => 'my-accordion'])
    ->class('custom-accordion');
```

For the toggler, use `togglerAttributes()`:

```php
$accordion = Accordion::widget()->togglerAttributes(['data-test' => 'toggle']);
```

### Customizing Headers
Set the header tag (defaults to `h2`):

```php
$accordion = Accordion::widget()->headerTag('h3');
```

Add attributes to headers:

```php
$accordion = Accordion::widget()->headerAttributes(['class' => 'text-primary']);
```

### Customizing the Toggler
Change the toggler tag (defaults to `button`):

```php
$accordion = Accordion::widget()->togglerTag('div');
```

Add custom attributes or classes to the toggler:

```php
$accordion = Accordion::widget()
    ->togglerAttributes(['data-action' => 'toggle'])
    ->addClass('bg-light');
```

### Always Open Behavior
Allow multiple items to remain open simultaneously:

```php
$accordion = Accordion::widget()->alwaysOpen();
```

### Flush Styling
Remove borders and rounded corners for a flush appearance:

```php
$accordion = Accordion::widget()->flush();
```

### Body Attributes
Customize the body section of each item:

```php
$accordion = Accordion::widget()->bodyAttributes(['class' => 'p-4']);
```

### Collapse Attributes
Customize the collapse section (the wrapper around the body):

```php
$accordion = Accordion::widget()->collapseAttributes(['data-test' => 'collapse']);
```

## Item Configuration
The `AccordionItem` class allows customization of individual items:

**Basic Item:**

```php
AccordionItem::to('Header', 'Body content')
```

**Active Item (expanded by default):**

```php
AccordionItem::to('Header', 'Body content', active: true)
```

**Custom ID:**

```php
AccordionItem::to('Header', 'Body content', id: 'custom-id')
```

**Raw HTML Content (disable encoding):**

```php
AccordionItem::to('<strong>Header</strong>', '<p>Body content</p>', encodeHeader: false, encodeBody: false)
```
