<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

/**
 * `NavBar` renders a navbar HTML component.
 *
 * Any content enclosed between the {@see begin()} and {@see end()} calls of NavBar is treated as the content of the
 * navbar. You may use widgets such as {@see Nav} or {@see \Yiisoft\Widget\Menu} to build up such content. For example,
 *
 * ```php
 * echo NavBar::widget()
 *     ->addClass(BackgroundColor::BODY_TERTIARY)
 *     ->brandText('NavBar')
 *     ->brandUrl('#')
 *     ->id('navbarSupportedContent')
 *     ->begin();
 *     echo Nav::widget()
 *         ->items(
 *             NavLink::item('Home', '#', active: true),
 *             NavLink::item(label: 'Link', url: '#'),
 *             Dropdown::widget()
 *                  ->items(
 *                      DropdownItem::link('Action', '#'),
 *                      DropdownItem::link('Another action', '#'),
 *                      DropdownItem::divider(),
 *                      DropdownItem::link('Something else here', '#'),
 *                  ),
 *             NavLink::item('Disabled', '#', disabled: true),
 *         )
 *         ->styles(NavStyle::NAVBAR)
 *        ->render();
 * echo NavBar::end();
 * ```
 */
final class NavBar extends Widget
{
    private const NAME = 'navbar';
    private const NAVBAR_BRAND = 'navbar-brand mb-0 h1';
    private const NAVBAR_BRAND_LINK = 'navbar-brand';
    private const NAV_CONTAINER = 'collapse navbar-collapse';
    private const NAV_INNER_CONTAINER = 'container-fluid';
    private const NAV_TOGGLE = 'navbar-toggler';
    private const NAV_TOGGLE_ICON = 'navbar-toggler-icon';
    private array $attributes = [];
    private string|Stringable $brand = '';
    private array $brandAttributes = [];
    private string|Stringable $brandText = '';
    private string|Stringable $brandImage = '';
    private array $brandImageAttributes = [];
    private string $brandUrl = '';
    private array $cssClass = [];
    private bool $container = false;
    private array $containerAttributes = [];
    private NavBarExpand $expand = NavBarExpand::LG;
    private bool $innerContainer = true;
    private array $innerContainerAttributes = [];
    private string $innerContainerTag = 'div';
    private bool|string $id = true;
    private string $tag = 'nav';
    private string|Stringable $toggler = '';
    private array $togglerAttributes = [];

    /**
     * Adds a set of attributes.
     *
     * @param array $attributes Attribute values indexed by attribute names. for example, `['id' => 'my-id']`.
     *
     * @return self A new instance with the specified attributes added.
     *
     * Usage example:
     * ```php
     * $navBar->addAttributes(['data-id' => '123']);
     * ```
     */
    public function addAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->attributes = [...$this->attributes, ...$attributes];

        return $new;
    }

    /**
     * Adds one or more CSS classes to the existing classes.
     *
     * Multiple classes can be added by passing them as separate arguments. `null` values are filtered out
     * automatically.
     *
     * @param BackedEnum|string|null ...$class One or more CSS class names to add. Pass `null` to skip adding a class.
     *
     * @return self A new instance with the specified CSS classes added to existing ones.
     *
     * @link https://html.spec.whatwg.org/#classes
     *
     * Example usage:
     * ```php
     * $navBar->addClass('custom-class', null, 'another-class', BackGroundColor::PRIMARY);
     * ```
     */
    public function addClass(BackedEnum|string|null ...$class): self
    {
        $new = clone $this;
        $new->cssClass = [...$this->cssClass, ...$class];

        return $new;
    }

    /**
     * Adds a CSS style.
     *
     * @param array|string $style The CSS style. If the value is an array, a space will separate the values.
     * For example, `['color' => 'red', 'font-weight' => 'bold']` will be rendered as `color: red; font-weight: bold;`.
     * If it is a string, it will be added as is, for example, `color: red`.
     * @param bool $overwrite Whether to overwrite existing styles with the same name. If `false`, the new value will be
     * appended to the existing one.
     *
     * @return self A new instance with the specified CSS style value added.
     *
     * Example usage:
     * ```php
     * $navBar->addCssStyle('color: red');
     *
     * // or
     * $navBar->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
     * ```
     */
    public function addCssStyle(array|string $style, bool $overwrite = true): self
    {
        $new = clone $this;
        Html::addCssStyle($new->attributes, $style, $overwrite);

        return $new;
    }

    /**
     * Adds toggler attribute value.
     *
     * @param string $name The attribute name.
     * @param mixed $value The attribute value.
     *
     * @return self A new instance with the specified attribute added.
     *
     * Example usage:
     * ```php
     * $navbar->addTogglerAttribute('data-id', '123');
     * ```
     */
    public function addTogglerAttribute(string $name, mixed $value): self
    {
        $new = clone $this;
        $new->togglerAttributes[$name] = $value;

        return $new;
    }

    /**
     * Adds one or more CSS classes to the existing toggler classes.
     *
     * Multiple classes can be added by passing them as separate arguments. `null` values are filtered out
     * automatically.
     *
     * @param BackedEnum|string|null ...$class One or more CSS class names to add. Pass `null` to skip adding a class.
     *
     * @return self A new instance with the specified CSS classes added to existing ones.
     *
     * @link https://html.spec.whatwg.org/#classes
     *
     * Example usage:
     * ```php
     * $navbar->addTogglerClass('custom-class', null, 'another-class', BackGroundColor::PRIMARY);
     * ```
     */
    public function addTogglerClass(BackedEnum|string|null ...$class): self
    {
        $new = clone $this;

        foreach ($class as $item) {
            Html::addCssClass($new->togglerAttributes, $item);
        }

        return $new;
    }

    /**
     * Adds a toggler CSS style.
     *
     * @param array|string $style The CSS style. If the value is an array, a space will separate the values.
     * for example, `['color' => 'red', 'font-weight' => 'bold']` will be rendered as `color: red; font-weight: bold;`.
     * If it is a string, it will be added as is, for example, `color: red`.
     * @param bool $overwrite Whether to overwrite existing styles with the same name. If `false`, the new value will be
     * appended to the existing one.
     *
     * @return self A new instance with the specified CSS style value added.
     *
     * Example usage:
     * ```php
     * $navbar->addTogglerCssStyle('color: red');
     *
     * // or
     * $navbar->addTogglerCssStyle(['color' => 'red', 'font-weight' => 'bold']);
     * ```
     */
    public function addTogglerCssStyle(array|string $style, bool $overwrite = true): self
    {
        $new = clone $this;
        Html::addCssStyle($new->togglerAttributes, $style, $overwrite);

        return $new;
    }

    /**
     * Sets attribute value.
     *
     * @param string $name The attribute name.
     * @param mixed $value The attribute value.
     *
     * @return self A new instance with the specified attribute added.
     *
     * Example usage:
     * ```php
     * $navBar->attribute('data-id', '123');
     * ```
     */
    public function attribute(string $name, mixed $value): self
    {
        $new = clone $this;
        $new->attributes[$name] = $value;

        return $new;
    }

    /**
     * Sets the HTML attributes.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->attributes(['data-id' => '123']);
     * ```
     */
    public function attributes(array $attributes): self
    {
        $new = clone $this;
        $new->attributes = $attributes;

        return $new;
    }

    /**
     * Sets the brand.
     *
     * @param string|Stringable $brand The brand to use.
     *
     * @return self A new instance with the specified brand.
     *
     * Example usage:
     * ```php
     * $navBar->brand('My Brand');
     * ```
     */
    public function brand(string|Stringable $brand): self
    {
        $new = clone $this;
        $new->brand = $brand;

        return $new;
    }

    /**
     * Sets the HTML attributes for the brand tag of the navbar component.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->brandAttributes(['class' => 'brand']);
     * ```
     */
    public function brandAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->brandAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the brand image.
     *
     * @param string|Stringable $image The brand image to use. If `null`, the brand image will not be displayed.
     *
     * @return self A new instance with the specified brand image.
     *
     * Example usage:
     * ```php
     * $navBar->brandImage('path/to/image.png');
     *
     * // or
     * $navBar->brandImage(Img::tag()->src('path/to/image.png'));
     * ```
     */
    public function brandImage(string|Stringable $image): self
    {
        $new = clone $this;
        $new->brandImage = $image;

        return $new;
    }

    /**
     * Sets the HTML attributes for the brand image of the navbar component.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->brandImageAttributes(['class' => 'brand-image']);
     * ```
     */
    public function brandImageAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->brandImageAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the brand text for the navbar component.
     *
     * @param string|Stringable $text The brand text for the navbar component. If `null`, the brand text will not
     * be displayed.
     *
     * @return self A new instance with the specified brand text.
     *
     * Example usage:
     * ```php
     * $navBar->brandText('My Brand');
     * ```
     */
    public function brandText(string|Stringable $text): self
    {
        $new = clone $this;
        $new->brandText = $text;

        return $new;
    }

    /**
     * Sets the brand URL for the navbar component.
     *
     * @param string $url The brand URL for the navbar component. If `null`, the brand URL will not be
     * displayed.
     *
     * @return self A new instance with the specified brand URL.
     *
     * Example usage:
     * ```php
     * $navBar->brandUrl('https://example.com');
     * ```
     */
    public function brandUrl(string $url): self
    {
        $new = clone $this;
        $new->brandUrl = $url;

        return $new;
    }

    /**
     * Replaces all existing CSS classes with the specified one(s).
     *
     * Multiple classes can be added by passing them as separate arguments. `null` values are filtered out
     * automatically.
     *
     * @param BackedEnum|string|null ...$class One or more CSS class names to set. Pass `null` to skip setting a class.
     *
     * @return self A new instance with the specified CSS classes set.
     *
     * ```php
     * $navBar->class('custom-class', null, 'another-class');
     * ```
     */
    public function class(BackedEnum|string|null ...$class): self
    {
        $new = clone $this;
        $new->cssClass = $class;

        return $new;
    }

    /**
     * Sets whether the navbar contains navigation content in a container.
     *
     * @param bool $enabled Whether to use container for navigation content.
     * If `true` navigation content will be wrapped in a container.
     * If `false` navigation content spans full width.
     *
     * @return self A new instance with the specified container setting.
     *
     * Example usage:
     * ```php
     * $navBar->container(true);
     * ```
     */
    public function container(bool $enabled): self
    {
        $new = clone $this;
        $new->container = $enabled;

        return $new;
    }

    /**
     * Sets the HTML attributes for the container of the navbar component.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->containerAttributes(['class' => 'container']);
     * ```
     */
    public function containerAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->containerAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the expansion breakpoint class for the navigation bar.
     *
     * @param NavBarExpand $class The breakpoint class at which the navbar will expand.
     *
     * @return self A new instance with the specified expansion breakpoint.
     *
     * Example usage:
     * ```php
     * $navBar->expand(NavBarExpand::MD);
     * ```
     */
    public function expand(NavBarExpand $class): self
    {
        $new = clone $this;
        $new->expand = $class;

        return $new;
    }

    /**
     * Sets the ID.
     *
     * @param bool|string $id The ID of the component. If `true`, an ID will be generated automatically.
     *
     * @throws InvalidArgumentException if the ID is an empty string or `false`.
     *
     * @return self A new instance with the specified ID.
     *
     * Example usage:
     * ```php
     * $navBar->id('navbarId');
     * ```
     */
    public function id(bool|string $id): self
    {
        $new = clone $this;
        $new->id = $id;

        return $new;
    }

    /**
     * Whether to use an inner container for the navbar component.
     *
     * @param bool $enabled 'true' to use an inner container for the navbar component, 'false' otherwise.
     *
     * @return self A new instance with the specified inner container setting.
     *
     * Example usage:
     * ```php
     * $navBar->innerContainer(true);
     * ```
     */
    public function innerContainer(bool $enabled): self
    {
        $new = clone $this;
        $new->innerContainer = $enabled;

        return $new;
    }

    /**
     * Sets the HTML attributes for the inner container of the navbar component.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->innerContainerAttributes(['class' => 'inner-container']);
     * ```
     */
    public function innerContainerAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->innerContainerAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the placement.
     *
     * @param NavBarPlacement $value The placement.
     *
     * @return self A new instance with the specified placement.
     *
     * @see https://getbootstrap.com/docs/5.3/components/navbar/#placement
     *
     * Example usage:
     * ```php
     * $navBar->placement(NavBarPlacement::FIXED_TOP);
     * ```
     */
    public function placement(NavBarPlacement $value): self
    {
        return $this->addClass($value);
    }

    /**
     * Sets the tag name for the navbar component.
     *
     * @param string $tag The tag name for the navbar component.
     *
     * @return self A new instance with the specified tag name.
     *
     * Example usage:
     * ```php
     * $navBar->tag('div');
     * ```
     */
    public function tag(string $tag): self
    {
        $new = clone $this;
        $new->tag = $tag;

        return $new;
    }

    /**
     * Sets the toggle button.
     *
     * @param string|Stringable $toggle The toggle button.
     *
     * @return self A new instance with the specified toggle button.
     *
     * Example usage:
     * ```php
     * $navBar->toggler('Toggle');
     *
     * // or
     * $navBar->toggler(Button::button('Toggle'));
     * ```
     */
    public function toggler(string|Stringable $toggle): self
    {
        $new = clone $this;
        $new->toggler = $toggle;

        return $new;
    }

    /**
     * Sets the HTML attributes for the toggler.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes for the toggler.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $navBar->toggleAttributes(['class' => 'my-class']);
     * ```
     */
    public function togglerAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->togglerAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the theme for the navbar component.
     *
     * @param string $theme The theme for the navbar component.
     *
     * @return self A new instance with the specified theme.
     *
     * Example usage:
     * ```php
     * $navBar->theme('dark');
     * ```
     */
    public function theme(string $theme): self
    {
        return $this->addAttributes(['data-bs-theme' => $theme === '' ? null : $theme]);
    }

    /**
     * Begins the rendering of the navbar.
     *
     * @throws InvalidArgumentException if the tag is an empty string.
     *
     * @return string The opening HTML tags for the navbar.
     */
    public function begin(): string
    {
        parent::begin();

        $attributes = $this->attributes;
        $classes = $attributes['class'] ?? null;
        $htmlBegin = '';
        $innerContainerAttributes = $this->innerContainerAttributes;
        $innerContainerClasses = $innerContainerAttributes['class'] ?? null;

        $id = match ($this->id) {
            true => $attributes['id'] ?? Html::generateId(self::NAME . '-'),
            '', false => throw new InvalidArgumentException('The "id" property must be specified.'),
            default => $this->id,
        };

        unset($attributes['class'], $attributes['id'], $innerContainerAttributes['class']);

        if ($this->tag === '') {
            throw new InvalidArgumentException('Tag cannot be empty string.');
        }

        Html::addCssClass($attributes, [self::NAME, $this->expand, $classes, ...$this->cssClass]);

        if ($this->container) {
            $htmlBegin = Html::openTag('div', $this->containerAttributes) . "\n";
        }

        $htmlBegin .= Html::openTag($this->tag, $attributes) . "\n";

        if ($this->innerContainer) {
            Html::addCssClass($innerContainerAttributes, [$innerContainerClasses ?? self::NAV_INNER_CONTAINER]);

            $htmlBegin .= Html::openTag($this->innerContainerTag, $innerContainerAttributes) . "\n";
        }

        $renderBrand = $this->renderBrand();

        if ($renderBrand !== '') {
            $htmlBegin .= $renderBrand . "\n";
        }

        $htmlBegin .= $this->renderToggler($id) . "\n";

        $htmlBegin .= Html::openTag('div', ['class' => self::NAV_CONTAINER, 'id' => $id]);

        return $htmlBegin . "\n";
    }

    /**
     * Run the navbar widget.
     *
     * @return string The HTML representation of the element.
     */
    public function render(): string
    {
        $htmlRender = '';

        if ($this->innerContainer) {
            $htmlRender .= "\n" . Html::closeTag($this->innerContainerTag) . "\n";
        }

        $htmlRender .= Html::closeTag('div') . "\n";
        $htmlRender .= Html::closeTag($this->tag);

        if ($this->container) {
            $htmlRender .= "\n" . Html::closeTag('div');
        }

        return $htmlRender;
    }

    /**
     * Renders the brand section of the navbar.
     *
     * @return string The rendered brand HTML.
     */
    private function renderBrand(): string
    {
        if ($this->brand !== '') {
            return (string) $this->brand;
        }

        if ($this->brandImage === '' && $this->brandText === '') {
            return '';
        }

        $content = '';

        if ($this->brandImage instanceof Stringable) {
            $content = "\n" . $this->brandImage . "\n";
        } elseif ($this->brandImage !== '') {
            $content = "\n" . Html::img($this->brandImage)->addAttributes($this->brandImageAttributes) . "\n";
        }

        if ($this->brandText !== '') {
            $content .= $this->brandText;
        }

        if ($this->brandUrl !== '' && $this->brandImage !== '' && $this->brandText !== '') {
            $content .= "\n";
        }

        $brandAttributes = $this->brandAttributes;
        $classesBrand = $brandAttributes['class'] ?? null;

        unset($brandAttributes['class']);

        $brand = match ($this->brandUrl) {
            '' => Html::span($content, $brandAttributes)
                ->addClass(self::NAVBAR_BRAND, $classesBrand)
                ->encode(false),
            default => Html::a($content, $this->brandUrl, $brandAttributes)
                ->addClass(self::NAVBAR_BRAND_LINK, $classesBrand)
                ->encode(false),
        };

        return $brand->render();
    }

    /**
     * Renders the toggler button for the navbar.
     *
     * @param string $id The ID of the collapsible element.
     *
     * @return string The rendered toggle button HTML.
     */
    private function renderToggler(string $id): string
    {
        if ($this->toggler !== '') {
            return (string) $this->toggler;
        }

        $togglerAttributes = $this->togglerAttributes;
        $togglerClasses = $togglerAttributes['class'] ?? null;

        unset($togglerAttributes['class']);

        $togglerTag = Button::button('')
            ->addAttributes($togglerAttributes)
            ->addClass(self::NAV_TOGGLE, $togglerClasses)
            ->addContent("\n", Span::tag()->addClass(self::NAV_TOGGLE_ICON), "\n")
            ->encode(false);

        if (array_key_exists('data-bs-toggle', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('data-bs-toggle', 'collapse');
        }

        if (array_key_exists('data-bs-target', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('data-bs-target', '#' . $id);
        }

        if (array_key_exists('aria-controls', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('aria-controls', $id);
        }

        if (array_key_exists('aria-expanded', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('aria-expanded', 'false');
        }

        if (array_key_exists('aria-label', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('aria-label', 'Toggle navigation');
        }

        return $togglerTag->render();
    }
}
