# Collapse

The **Collapse** widget renders a [collapse](https://getbootstrap.com/docs/5.3/components/collapse/#example) component.

You can use it to toggle content visibility on your pages. Collapse allows you to hide and show large content sections
with a simple click, saving space and creating a cleaner, more organized interface.

## Key Features
- Toggle content visibility with button or link triggers.
- Horizontal collapse option for width animation.
- Support for multiple togglers targeting the same collapsible content.
- Customizable toggler container and styling options.
- Option to keep content containers visible while collapsed.

## Quick Start
To get started, instantiate the **Collapse** widget and add toggler items to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Collapse;
use Yiisoft\Bootstrap5\Toggler;
?>

<?= Collapse::widget()
        ->items(
            Toggler::for(
                'This is the collapsible content. It can be any element or component you like.',
                'collapseExample'
            )
        )
?>
```

This generates a simple button that toggles the visibility of content when clicked.

## Configuration

### Setting Attributes
Customize the collapse container with HTML attributes:

```php
Collapse::widget()
    ->attributes(['id' => 'my-collapse'])
    ->class('custom-collapse');
```

Add single attributes:

```php
Collapse::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Collapse::widget()->addAttributes(['data-id' => '123', 'data-animation' => 'slide']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Collapse::widget()->addClass('custom-class', 'bg-light');
```

Replace all existing classes:

```php
Collapse::widget()->class('custom-class', 'another-class', BackgroundColor::PRIMARY);
```

### Adding CSS Styles
Add CSS styles to the collapse:

```php
Collapse::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
Collapse::widget()->addCssStyle(['max-height' => '300px', 'overflow' => 'auto']);
```

### Customizing Card Body
Set attributes for the card body that wraps the collapsible content:

```php
Collapse::widget()
    ->cardBodyAttributes(['class' => 'p-4 bg-light'])
    ->items(Toggler::for('Collapsible content', 'collapseExample'));
```

### Container Options
Set whether the collapse should be wrapped in a container:

```php
// Disable the container wrapping
Collapse::widget()->container(false);
```

Set container attributes:

```php
Collapse::widget()
    ->containerAttributes(['style' => 'min-height: 150px;'])
    ->items(Toggler::for('Collapsible content', 'collapseExample'));
```

### Toggler Container
Customize the container that holds the toggle buttons:

```php
// Change the toggler container tag (default is 'p')
Collapse::widget()
    ->items(Toggler::for('Collapsible content', 'collapseExample'))
    ->togglerContainerTag('div');

// Add attributes to the toggler container
Collapse::widget()
    ->items(Toggler::for('Collapsible content', 'collapseExample'))
    ->togglerContainerAttributes(['class' => 'd-inline-flex gap-1']);
```

## Using Togglers

The **Toggler** class offers several ways to create toggle controls for your collapsible content.

### Basic Toggler
Create a simple button that toggles content:

```php
Collapse::widget()->items(Toggler::for('My content', 'uniqueId'));
```

### Toggler as Link
Create a link instead of a button to toggle content:

```php
Collapse::widget()
    ->items(
        Toggler::for('My content', 'uniqueId')
            ->togglerAsLink()
            ->togglerContent('Toggle content')
    );
```

### Customizing Toggler
Modify the toggler appearance and behavior:

```php
Collapse::widget()
    ->items(
        Toggler::for('My content', 'uniqueId')
            ->togglerAttributes(['class' => 'custom-toggler'])
            ->togglerContent('Show/Hide Content')
    );
```

## Examples

### Horizontal Collapse
Create a collapse that animates width instead of height:

```php
Collapse::widget()
    ->addClass('collapse-horizontal')
    ->cardBodyAttributes(['style' => 'width: 300px;'])
    ->containerAttributes(['style' => 'min-height: 120px;'])
    ->items(
        Toggler::for(
            'This is some placeholder content for a horizontal collapse. ' .
            "It's hidden by default and shown when triggered.",
            'collapseExample',
            togglerContent: 'Toggle width collapse',
        ),
    );
```

### Multiple Togglers and Targets
Create multiple collapse elements with different togglers:

```php
Collapse::widget()
    ->containerAttributes(['class' => 'row'])
    ->items(
        Toggler::for(
            'Some placeholder content for the first collapse component of this multi-collapse example. ' .
            'This panel is hidden by default but revealed when the user activates the relevant trigger.',
            'multiCollapseExample1',
            togglerContent: 'Toggle first element',
            togglerAsLink: true,
        ),
        Toggler::for(
            'Some placeholder content for the second collapse component of this multi-collapse example. ' .
            'This panel is hidden by default but revealed when the user activates the relevant trigger.',
            'multiCollapseExample2',
            togglerContent: 'Toggle second element',
        ),
        Toggler::for(
            togglerContent: 'Toggle both elements',
            togglerMultiple: true,
            ariaControls: 'multiCollapseExample1 multiCollapseExample2',
        ),
    );
```
