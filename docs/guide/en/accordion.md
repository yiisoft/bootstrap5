# Accordion

The **Accordion** widget renders an [accordion](https://getbootstrap.com/docs/5.3/components/accordion/#example) component. 

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
Accordion::widget()
    ->attributes(['id' => 'my-accordion'])
    ->class('custom-accordion');
```

Add single attributes:

```php
Accordion::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Accordion::widget()->addAttributes(['data-id' => '123', 'data-action' => 'submit']);
```

For the toggler, use `togglerAttributes()`:

```php
Accordion::widget()->togglerAttributes(['data-test' => 'toggle']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Accordion::widget()->addClass('btn-rounded', 'text-uppercase');
```

Replace all existing classes:

```php
Accordion::widget()->class('custom-class', 'another-class');
```

### Adding CSS Styles
Add CSS styles to the button:

```php
Accordion::widget()->addCssStyle('color: red;');
```

Add multiple styles:

```php
Accordion::widget()->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Customizing Headers
Set the header tag (defaults to `h2`):

```php
Accordion::widget()->headerTag('h3');
```

Add attributes to headers:

```php
Accordion::widget()->headerAttributes(['class' => 'text-primary']);
```

### Customizing the Toggler
Change the toggler tag (defaults to `button`):

```php
Accordion::widget()->togglerTag('div');
```

Add attribute:

```php
Accordion::widget()->addTogglerAttribute(['data-id' => '123']);
```

Add class:

```php
Accordion::widget()->addTogglerClass('custom-class', null, 'another-class', BackgroundColor::PRIMARY);
```

Add style:

```php
Accordion::widget()->addTogglerCssStyle(['color' => 'red', 'font-weight' => 'bold']);
```

### Always Open Behavior
Allow multiple items to remain open simultaneously:

```php
Accordion::widget()->alwaysOpen();
```

### Flush Styling
Remove borders and rounded corners for a flush appearance:

```php
Accordion::widget()->flush();
```

### Body Attributes
Customize the body section of each item:

```php
Accordion::widget()->bodyAttributes(['class' => 'p-4']);
```

### Collapse Attributes
Customize the collapse section (the wrapper around the body):

```php
Accordion::widget()->collapseAttributes(['data-test' => 'collapse']);
```
