<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use Stringable;
use Yiisoft\Html\{Html, Tag\A,  Tag\Button as ButtonTag, Tag\Input};

use function array_merge;

/**
 * Button renders a bootstrap button.
 *
 * For example,
 *
 * ```php
 * echo Button::widget()->label('Block button')->large()->type(ButtonType::PRIMARY)->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.2/components/buttons/
 */
final class Button extends \Yiisoft\Widget\Widget
{
    private const NAME = 'btn';
    private bool $active = false;
    private array $attributes = [];
    private ButtonType $buttonType = ButtonType::SECONDARY;
    private array $cssClass = [];
    private bool $disabled = false;
    private bool|string $id = true;
    private string|Stringable $label = '';
    private A|ButtonTag|Input|null $tag = null;

    /**
     * Sets the button to be active.
     *
     * @param bool $value Whether the button should be active.
     *
     * @return self A new instance with the button active.
     */
    public function active(bool $value = true): self
    {
        $new = clone $this;
        $new->active = $value;

        return $new;
    }

    /**
     * Adds a CSS class for the button group component.
     *
     * @param string $value The CSS class for the button component (e.g., 'test-class').
     *
     * @return self A new instance with the specified class value added.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function addCssClass(string $value): self
    {
        $new = clone $this;
        $new->cssClass[] = $value;

        return $new;
    }

    /**
     * Adds a style class for the button component.
     *
     * @param array|string $value The style class for the button component. If an array, the values will be separated by
     * a space. If a string, it will be added as is. For example, 'color: red;'. If the value is an array, the values
     * will be separated by a space. e.g., ['color' => 'red', 'font-weight' => 'bold'] will be rendered as
     * 'color: red; font-weight: bold;'.
     * @param bool $overwrite Whether to overwrite existing styles with the same name. If `false`, the new value will be
     * appended to the existing one.
     *
     * @return self A new instance with the specified style class value added.
     */
    public function addCssStyle(array|string $value, bool $overwrite = true): self
    {
        $new = clone $this;
        Html::addCssStyle($new->attributes, $value, $overwrite);

        return $new;
    }

    /**
     * Sets the 'aria-expanded' attribute for the button, indicating whether the element is currently expanded or
     * collapsed.
     *
     * @param bool $value The value to set for the 'aria-expanded' attribute.
     *
     * @return self A new instance with the specified 'aria-expanded' value.
     *
     * @link https://www.w3.org/TR/wai-aria-1.1/#aria-expanded
     */
    public function ariaExpanded(bool $value = true): self
    {
        $new = clone $this;
        $new->attributes['aria-expanded'] = $value === true ? 'true' : 'false';

        return $new;
    }

    /**
     * Sets the HTML attributes for the button component.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = array_merge($new->attributes, $values);

        return $new;
    }

    /**
     * Sets the 'data-bs-toggle' attribute for the button.
     *
     * @param string $value The value to set for the 'data-bs-toggle' attribute.
     *
     * @return self A new instance with the specified 'data-bs-toggle' value.
     */
    public function dataBsToggle(string $value): self
    {
        $new = clone $this;
        $new->attributes['data-bs-toggle'] = $value;

        return $new;
    }

    /**
     * Sets the button to be disabled.
     *
     * @param bool $value Whether the button should be disabled.
     *
     * @return self A new instance with the button disabled.
     */
    public function disabled(bool $value = true): self
    {
        $new = clone $this;
        $new->disabled = $value;

        return $new;
    }

    /**
     * Sets the ID of the button component.
     *
     * @param bool|string $value The ID of the button component. If `true`, an ID will be generated automatically.
     *
     * @return self A new instance with the specified ID.
     */
    public function id(bool|string $value): self
    {
        $new = clone $this;
        $new->id = $value;

        return $new;
    }

    /**
     * The button label.
     *
     * @param string $value The label to display on the button.
     * @param bool $encode Whether the label value should be HTML-encoded. Use this when rendering user-generated
     * content to prevent XSS attacks.
     *
     * @return self A new instance with the specified label value.
     */
    public function label(string|Stringable $value, bool $encode = true): self
    {
        if ($encode) {
            $value = Html::encode($value);
        }

        $new = clone $this;
        $new->label = $value;

        return $new;
    }

    /**
     * Sets the button size to be large.
     *
     * @return self A new instance with the button as a large button.
     */
    public function large(): self
    {
        $new = clone $this;
        $new->cssClass['size'] = 'btn-lg';

        return $new;
    }

    /**
     * Whether the button should be a link.
     *
     * @param string|null $url The URL of the link.
     *
     * @return self A new instance with the button as a link.
     */
    public function link(string|null $url = null): self
    {
        $new = clone $this;
        $new->tag = A::tag()->url($url);

        return $new;
    }

    /**
     * Whether the button should be a reset button.
     *
     * @param string|null $value The content of the button. For default, it is 'Reset'.
     *
     * @return self A new instance with the button as a reset button.
     */
    public function reset(string|null $value = 'Reset'): self
    {
        $new = clone $this;
        $new->tag = Input::resetButton($value);

        return $new;
    }

    /**
     * Sets the button size to be small.
     *
     * @return self A new instance with the button as a small button.
     */
    public function small(): self
    {
        $new = clone $this;
        $new->cssClass['size'] = 'btn-sm';

        return $new;
    }

    /**
     * Whether the button should be a submit button.
     *
     * @param string|null $value The content of the button. For default, it is 'Submit'.
     *
     * @return self A new instance with the button as a submit button.
     */
    public function submit(string|null $value = 'Submit'): self
    {
        $new = clone $this;
        $new->tag = Input::submitButton($value);

        return $new;
    }

    /**
     * Set the button type. The following options are allowed:
     *
     * - `Type::PRIMARY`: Primary button.
     * - `Type::SECONDARY`: Secondary button.
     * - `Type::SUCCESS`: Success button.
     * - `Type::DANGER`: Danger button.
     * - `Type::WARNING`: Warning button.
     * - `Type::INFO`: Info button.
     * - `Type::LIGHT`: Light button.
     * - `Type::DARK`: Dark button.
     *
     * @param ButtonType $value The type of the button.
     *
     * @return self A new instance with the specified button type.
     */
    public function type(ButtonType $value): self
    {
        $new = clone $this;
        $new->buttonType = $value;

        return $new;
    }

    /**
     * Run the button widget.
     *
     * @return string The HTML representation of the element.
     */
    public function render(): string
    {
        $attributes = $this->attributes;
        $classes = $attributes['class'] ?? null;
        $tag = $this->tag ?? ButtonTag::tag()->button('');

        $id = match ($this->id) {
            true => $attributes['id'] ?? Html::generateId(self::NAME . '-'),
            '', false => null,
            default => $this->id,
        };

        unset($attributes['class'], $attributes['id']);

        Html::addCssClass($attributes, [self::NAME, $this->buttonType->value, $classes, ...$this->cssClass]);

        $attributes = $this->setAttributes($attributes);

        if ($tag instanceof Input) {
            if ($this->label !== '') {
                $tag = $tag->value($this->label);
            }

            return $tag->addAttributes($attributes)->id($id)->render();
        }

        return $tag->addAttributes($attributes)->addContent($this->label)->id($id)->encode(false)->render();
    }

    /**
     * Sets the attributes for the button.
     *
     * @param array $attributes The attributes to set.
     *
     * @return array The updated attributes.
     */
    private function setAttributes(array $attributes): array
    {
        if ($this->active) {
            $attributes['aria-pressed'] = 'true';
            $attributes['data-bs-toggle'] = 'button';

            Html::addCssClass($attributes, 'active');
        }

        if ($this->disabled) {
            $attributes['disabled'] = true;

            if ($this->tag instanceof A) {
                $attributes['aria-disabled'] = 'true';

                unset($attributes['disabled']);
                Html::addCssClass($attributes, 'disabled');
            }
        }

        if ($this->tag instanceof A) {
            $attributes['role'] ??= 'button';
        }

        return $attributes;
    }
}
