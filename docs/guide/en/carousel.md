# Carousel

The **Carousel** widget renders a [carousel](https://getbootstrap.com/docs/5.3/components/carousel/#basic-examples) component.

You can use it to cycle through a series of content items like images or text, creating interactive slideshows for 
presenting information or visuals. The carousel supports various customization options including control buttons, 
indicators, captions, and animation effects.

## Key Features
- Supports multiple carousel items with custom content, captions, and caption placeholders.
- Configurable autoplaying behavior with customizable intervals.
- Optional controls and indicators for navigation.
- Support for crossfade animation.
- Customizable caption tags and styling.

## Quick Start
To get started, instantiate the **Carousel** widget and add items to it. Here is a basic example:

```php
<?php

declare(strict_types=1);

use Yiisoft\Bootstrap5\Carousel;
use Yiisoft\Bootstrap5\CarouselItem;
use Yiisoft\Html\Tag\Img;
?>

<?= Carousel::widget()
        ->id('carouselExample')
        ->items(
            CarouselItem::to(Img::tag()->alt('First slide')->src('image-1.jpg')),
            CarouselItem::to(Img::tag()->alt('Second slide')->src('image-2.jpg')),
            CarouselItem::to(Img::tag()->alt('Third slide')->src('image-3.jpg')),
        )
?>
```

This generates a simple carousel with three image slides and default navigation controls.

## Configuration

### Setting Attributes
Customize the carousel container with HTML attributes:

```php
Carousel::widget()
    ->attributes(['id' => 'my-carousel'])
    ->class('custom-carousel');
```

Add single attributes:

```php
Carousel::widget()->attribute('data-id', '123');
```

Add multiple attributes:

```php
Carousel::widget()->addAttributes(['data-id' => '123', 'data-animation' => 'slide']);
```

### Adding CSS Classes
Add one or more CSS classes:

```php
Carousel::widget()->addClass('custom-class', 'rounded-edges');
```

Replace all existing classes:

```php
Carousel::widget()->class('custom-class', 'another-class', BackgroundColor::PRIMARY);
```

### Adding CSS Styles
Add CSS styles to the carousel:

```php
Carousel::widget()->addCssStyle('border: 1px solid #ccc;');
```

Add multiple styles:

```php
Carousel::widget()->addCssStyle(['height' => '400px', 'max-width' => '800px']);
```

### Auto-Playing
Configure autoplaying behavior:

```php
// Start cycling immediately 
Carousel::widget()->autoPlaying('carousel');

// Start cycling after first manual interaction
Carousel::widget()->autoPlaying(true);

// Disable auto cycling
Carousel::widget()->autoPlaying(false);
```

### Items with Custom Intervals
Set different intervals for individual slides:

```php
Carousel::widget()
    ->id('carouselExampleInterval')
    ->autoPlaying()
    ->items(
        CarouselItem::to(Img::tag()->alt('First slide')->src('image-1.jpg'), autoPlayingInterval: 10000),
        CarouselItem::to(Img::tag()->alt('Second slide')->src('image-2.jpg'), autoPlayingInterval: 2000),
        CarouselItem::to(Img::tag()->alt('Third slide')->src('image-3.jpg')),
    );
```

### Controls
Configure navigation controls:

```php
// Hide controls
Carousel::widget()->controls(false);

// Customize control labels
Carousel::widget()
    ->controlNextLabel('Next Slide')
    ->controlPreviousLabel('Previous Slide');
```

### Crossfade Animation
Enable crossfade animation instead of the default slide animation:

```php
Carousel::widget()->crossfade();
```

### Indicators
Show slide indicators:

```php
Carousel::widget()->showIndicators();
```

### Touch Swiping
Disable touch swiping functionality:

```php
Carousel::widget()->touchSwiping(false);
```

### Theme
Apply a Bootstrap theme:

```php
Carousel::widget()->theme('dark');
```

### Active Items
Set a specific item as active:

```php
Carousel::widget()
    ->items(
        CarouselItem::to(Img::tag()->alt('First slide')->src('image-1.jpg')),
        CarouselItem::to(Img::tag()->alt('Second slide')->src('image-2.jpg')),
        CarouselItem::to(Img::tag()->alt('Third slide')->src('image-3.jpg'), active: true),
    );
```

## Captions and Content

### Adding Captions
Add captions and caption placeholders to carousel items:

```php
Carousel::widget()
    ->id('carouselExampleCaptions')
    ->items(
        CarouselItem::to(
            Img::tag()->alt('First slide')->src('image-1.jpg'),
            'First slide', // Caption
            'Some representative placeholder content for the first slide.' // Caption placeholder
        ),
        CarouselItem::to(
            Img::tag()->alt('Second slide')->src('image-2.jpg'),
            'Second slide',
            'Some representative placeholder content for the second slide.'
        ),
        CarouselItem::to(
            Img::tag()->alt('Third slide')->src('image-3.jpg'),
            'Third slide',
            'Some representative placeholder content for the third slide.'
        ),
    );
```

### Customizing Caption Tags
Change the HTML tags used for captions and caption placeholders:

```php
Carousel::widget()
    ->captionTagName('h2')
    ->captionPlaceholderTagName('span')
    ->items(
        CarouselItem::to(
            Img::tag()->alt('First slide')->src('image-1.jpg'),
            'First slide',
            'Some representative placeholder content for the first slide.'
        ),
    );
```

### Styling Captions
Add custom attributes to captions and caption placeholders:

```php
CarouselItem::to(
    Img::tag()->alt('First slide')->src('image-1.jpg'),
    'First slide',
    'Some representative placeholder content for the first slide.',
    captionAttributes: ['class' => 'text-primary'],
    captionPlaceholderAttributes: ['class' => 'text-secondary'],
);
```

### Custom Content
Use any content, not just images:

```php
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\H2;
use Yiisoft\Html\Tag\P;

Carousel::widget()
    ->id('carouselExampleContent')
    ->items(
        CarouselItem::to(
            Div::tag()
                ->addClass('bg-primary text-white p-5 text-center')
                ->addContent(
                    H2::tag()->content('Title 1'),
                    P::tag()->content('This is the first slide with text.'),
                ),
        ),
        CarouselItem::to(
            Div::tag()
                ->addClass('bg-success text-white p-5 text-center')
                ->addContent(
                    H2::tag()->content('Title 2'),
                    P::tag()->content('This is the second slide with text.'),
                ),
        ),
    );
```
