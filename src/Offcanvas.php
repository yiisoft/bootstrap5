<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5;

use BackedEnum;
use InvalidArgumentException;
use Stringable;
use Yiisoft\Bootstrap5\Utility\Responsive;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Widget\Widget;

/**
 * Offcanvas renders a Bootstrap offcanvas component.
 *
 * For example,
 * ```php
 * echo Offcanvas::widget()
 *     ->placement(OffcanvasPlacement::END)
 *     ->title('Offcanvas Title')
 *     ->togglerContent('Toggle Offcanvas')
 *     ->begin();
 *
 * // content of the offcanvas
 * echo 'Offcanvas content here';
 * echo Offcanvas::end();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/offcanvas/#how-it-works
 */
final class Offcanvas extends Widget
{
    private const NAME = 'offcanvas';
    private const BODY_CLASS = 'offcanvas-body';
    private const CLOSE_CLASS = 'btn-close';
    private const HEADER_CLASS = 'offcanvas-header';
    private const SHOW_CLASS = 'show';
    private const TITLE_CLASS = 'offcanvas-title';
    private const TOGGLER_CLASS = 'btn btn-primary';

    private array $attributes = [];
    private bool $backdrop = false;
    private bool $backdropStatic = false;
    private array $bodyAttributes = [];
    private array $cssClasses = [];
    private array $headerAttributes = [];
    private bool|string $id = true;
    private OffcanvasPlacement|string $placement = OffcanvasPlacement::START;
    private string $responsive = '';
    private bool $scrollable = false;
    private bool $show = false;
    private string|Stringable $title = '';
    private array $titleAttributes = [];
    private string|Stringable $toggler = '';
    private array $togglerAttributes = [];
    private string|Stringable $togglerContent = '';

    /**
     * Adds a set of attributes.
     *
     * @param array $attributes Attribute values indexed by attribute names. for example, `['id' => 'my-offcanvas']`.
     *
     * @return self A new instance with the specified attributes added.
     *
     * Example usage:
     * ```php
     * $offcanvas->addAttributes(['data-id' => '123']);
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
     * $offcanvas->addClass('custom-class', null, 'another-class', BackGroundColor::PRIMARY);
     * ```
     */
    public function addClass(BackedEnum|string|null ...$class): self
    {
        $new = clone $this;
        $new->cssClasses = [...$this->cssClasses, ...$class];

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
     * $offcanvas->addCssStyle('color: red');
     *
     * // or
     * $offcanvas->addCssStyle(['color' => 'red', 'font-weight' => 'bold']);
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
     * $offcanvas->addTogglerAttribute('data-id', '123');
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
     * $offcanvas->addTogglerClass('custom-class', null, 'another-class', BackGroundColor::PRIMARY);
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
     * $offcanvas->addTogglerCssStyle('color: red');
     *
     * // or
     * $offcanvas->addTogglerCssStyle(['color' => 'red', 'font-weight' => 'bold']);
     * ```
     */
    public function addTogglerCssStyle(array|string $style, bool $overwrite = true): self
    {
        $new = clone $this;
        Html::addCssStyle($new->togglerAttributes, $style, $overwrite);

        return $new;
    }

    /**
     * Adds a sets attribute value.
     *
     * @param string $name The attribute name.
     * @param mixed $value The attribute value.
     *
     * @return self A new instance with the specified attribute added.
     *
     * Example usage:
     * ```php
     * $offcanvas->attribute('data-id', '123');
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
     * $offcanvas->attributes(['data-id' => '123']);
     * ```
     */
    public function attributes(array $attributes): self
    {
        $new = clone $this;
        $new->attributes = $attributes;

        return $new;
    }

    /**
     * Sets whether to use a backdrop.
     *
     * @return self A new instance with the specified backdrop setting.
     *
     * @link https://getbootstrap.com/docs/5.3/components/offcanvas/#body-scrolling-and-backdrop
     *
     * Example usage:
     * ```php
     * $offcanvas->backdrop();
     * ```
     */
    public function backdrop(): self
    {
        $new = clone $this;
        $new->backdrop = true;

        return $new;
    }

    /**
     * Sets whether to use a static backdrop.
     *
     * @return self A new instance with the specified static backdrop setting.
     *
     * @link https://getbootstrap.com/docs/5.3/components/offcanvas/#dark-offcanvas
     *
     * Example usage:
     * ```php
     * $offcanvas->backdropStatic();
     * ```
     */
    public function backdropStatic(): self
    {
        $new = clone $this;
        $new->backdropStatic = true;

        return $new;
    }

    /**
     * Sets the HTML attributes for the body.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified body attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $offcanvas->bodyAttributes(['class' => 'custom-body-class']);
     * ```
     */
    public function bodyAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->bodyAttributes = $attributes;

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
     * Example usage:
     * ```php
     * $offcanvas->class('custom-class', null, 'another-class', BackGroundColor::PRIMARY);
     * ```
     */
    public function class(BackedEnum|string|null ...$class): self
    {
        $new = clone $this;
        $new->cssClasses = $class;

        return $new;
    }

    /**
     * Sets the HTML attributes for the header.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified header attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $offcanvas->headerAttributes(['class' => 'custom-header-class']);
     * ```
     */
    public function headerAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->headerAttributes = $attributes;

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
     * $offcanvas->id('my-offcanvas');
     * ```
     */
    public function id(bool|string $id): self
    {
        $new = clone $this;
        $new->id = $id;

        return $new;
    }

    /**
     * Sets the placement.
     *
     * @param OffcanvasPlacement $placement The placement.
     *
     * @return self A new instance with the specified placement setting.
     *
     * Example usage:
     * ```php
     * $offcanvas->placement(OffcanvasPlacement::END);
     * ```
     */
    public function placement(OffcanvasPlacement $placement): self
    {
        $new = clone $this;
        $new->placement = $placement;

        return $new;
    }

    /**
     * Sets the responsive size.
     *
     * @param Responsive $size The responsive size.
     *
     * @return self A new instance with the specified responsive size setting.
     *
     * Example usage:
     * ```php
     * $offcanvas->responsive(Responsive::SM);
     * ```
     */
    public function responsive(Responsive $size): self
    {
        $new = clone $this;
        $new->responsive = $size->value;

        return $new;
    }

    /**
     * Sets whether it is scrollable.
     *
     * @return self A new instance with the specified scrollable setting.
     *
     * @link https://getbootstrap.com/docs/5.3/components/offcanvas/#body-scrolling
     *
     * Example usage:
     * ```php
     * $offcanvas->scrollable();
     * ```
     */
    public function scrollable(): self
    {
        $new = clone $this;
        $new->scrollable = true;

        return $new;
    }

    /**
     * Sets whether it is visible.
     *
     * @return self A new instance with the specified visibility setting.
     *
     * Example usage:
     * ```php
     * $offcanvas->show();
     * ```
     */
    public function show(): self
    {
        $new = clone $this;
        $new->show = true;

        return $new;
    }

    /**
     * Sets the theme.
     *
     * @param string $theme The theme. If an empty string, the theme will be removed.
     * Valid values are `dark` and `light`.
     *
     * @return self A new instance with the specified theme.
     *
     * @link https://getbootstrap.com/docs/5.3/components/offcanvas/#dark-offcanvas
     *
     * Example usage:
     * ```php
     * $offcanvas->theme('dark');
     * ```
     */
    public function theme(string $theme): self
    {
        return $this->addAttributes(['data-bs-theme' => $theme === '' ? null : $theme]);
    }

    /**
     * Sets the title.
     *
     * @param string|Stringable $title The title.
     *
     * @return self A new instance with the specified title.
     *
     * Example usage:
     * ```php
     * $offcanvas->title('My Offcanvas Title');
     * ```
     */
    public function title(string|Stringable $title): self
    {
        $new = clone $this;
        $new->title = $title;

        return $new;
    }

    /**
     * Sets the HTML attributes for the title.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified title attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $offcanvas->titleAttributes(['class' => 'custom-title-class']);
     * ```
     */
    public function titleAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->titleAttributes = $attributes;

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
     * $offcanvas->toggler('Toggle');
     *
     * // or
     * $offcanvas->toggler(Button::button('Toggle'));
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
     * @return self A new instance with the specified toggler attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * Example usage:
     * ```php
     * $offcanvas->togglerAttributes(['class' => 'custom-toggler-class']);
     * ```
     */
    public function togglerAttributes(array $attributes): self
    {
        $new = clone $this;
        $new->togglerAttributes = $attributes;

        return $new;
    }

    /**
     * Sets the content of the toggler.
     *
     * @param string|Stringable $content The content of the toggler.
     *
     * @return self A new instance with the specified toggler content.
     *
     * Example usage:
     * ```php
     * $offcanvas->togglerContent('Toggle Offcanvas');
     * ```
     */
    public function togglerContent(string|Stringable $content): self
    {
        $new = clone $this;
        $new->togglerContent = $content;

        return $new;
    }

    /**
     * Begins the rendering.
     *
     * @throws InvalidArgumentException if the tag is an empty string.
     *
     * @return string The opening HTML tags for the offcanvas.
     */
    public function begin(): string
    {
        parent::begin();

        $id = $this->getId();
        $html = '';

        if ($this->toggler !== '' && $this->show === false) {
            $html .= (string) $this->toggler . "\n";
        }

        if ($this->togglerContent !== '' && $this->show === false) {
            $html .= $this->renderToggler($id) . "\n";
        }

        $html .= $this->renderOffcanvas($id);

        return $html;
    }

    /**
     * Run the widget.
     *
     * @return string The HTML representation of the element.
     */
    public function render(): string
    {
        $html = Html::closeTag('div') . "\n";
        $html .= Html::closeTag('div');

        return $html;
    }

    /**
     * Generates the ID.
     *
     * @throws InvalidArgumentException if the ID is an empty string or `false`.
     *
     * @return string The generated ID.
     */
    private function getId(): string
    {
        return match ($this->id) {
            true => $this->attributes['id'] ?? Html::generateId(self::NAME . '-'),
            '', false => throw new InvalidArgumentException('The "id" must be specified.'),
            default => $this->id,
        };
    }

    /**
     * Renders the body.
     *
     * @return string The rendering result.
     */
    private function renderBody(): string
    {
        $bodyAttributes = $this->bodyAttributes;

        Html::addCssClass($bodyAttributes, [self::BODY_CLASS]);

        return Html::openTag('div', $bodyAttributes) . "\n";
    }

    /**
     * Renders the header.
     *
     * @param string $id The ID.
     *
     * @return string The rendering result.
     */
    private function renderHeader(string $id): string
    {
        $headerAttributes = $this->headerAttributes;

        Html::addCssClass($headerAttributes, [self::HEADER_CLASS]);

        $titleAttributes = $this->titleAttributes;
        $titleAttributes['id'] = $id . '-label';

        Html::addCssClass($titleAttributes, [self::TITLE_CLASS]);

        return Div::tag()
            ->attributes($headerAttributes)
            ->content(
                "\n",
                Html::tag('h5', $this->title, $titleAttributes),
                "\n",
                Button::tag()
                    ->attributes(
                        [
                            'aria-label' => 'Close',
                            'class' => self::CLOSE_CLASS,
                            'data-bs-dismiss' => 'offcanvas',
                            'type' => 'button',
                        ],
                    ),
                "\n",
            )
            ->render();
    }

    /**
     * Renders the offcanvas component.
     *
     * @param string $id The ID.
     *
     * @return string The rendering result.
     */
    private function renderOffcanvas(string $id): string
    {
        $attributes = $this->attributes;
        $classes = $attributes['class'] ?? null;

        unset($attributes['class']);

        $class = $this->responsive !== '' ? 'offcanvas-' . $this->responsive : self::NAME;

        Html::addCssClass($attributes, [$class, $this->placement, ...$this->cssClasses, $classes]);

        if ($this->scrollable) {
            $attributes['data-bs-scroll'] = 'true';

            if ($this->backdrop === false) {
                $attributes['data-bs-backdrop'] = 'false';
            }
        }

        if ($this->backdropStatic) {
            $attributes['data-bs-backdrop'] = 'static';
        }

        $attributes['aria-labelledby'] = $id . '-label';
        $attributes['id'] = $id;
        $attributes['tabindex'] = '-1';

        if ($this->show) {
            Html::addCssClass($attributes, self::SHOW_CLASS);
        }

        $html = Html::openTag('div', $attributes) . "\n";
        $html .= $this->renderHeader($id) . "\n";
        $html .= $this->renderBody();

        return $html;
    }

    /**
     * Renders the toggler.
     *
     * @param string $id The ID.
     *
     * @return string The rendering result.
     */
    private function renderToggler(string $id): string
    {
        $togglerAttributes = $this->togglerAttributes;
        $togglerClasses = $togglerAttributes['class'] ?? null;

        unset($togglerAttributes['class']);

        $togglerTag = Button::button($this->togglerContent)
            ->addAttributes($togglerAttributes)
            ->addClass(self::TOGGLER_CLASS, $togglerClasses);

        if (array_key_exists('aria-controls', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('aria-controls', $id);
        }

        if (array_key_exists('data-bs-toggle', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('data-bs-toggle', 'offcanvas');
        }

        if (array_key_exists('data-bs-target', $togglerAttributes) === false) {
            $togglerTag = $togglerTag->attribute('data-bs-target', '#' . $id);
        }

        return $togglerTag->render();
    }
}
