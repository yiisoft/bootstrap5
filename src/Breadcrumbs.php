<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use BackedEnum;
use InvalidArgumentException;
use RuntimeException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Li;
use Yiisoft\Html\Tag\Nav;
use Yiisoft\Widget\Widget;

use function implode;
use function sprintf;

/**
 * Button renders a bootstrap button.
 *
 * For example,
 *
 * ```php
 * echo Breadcrumbs::widget()
 *     ->links(
 *         BreadcrumbLink::to('Home', '#'),
 *         BreadcrumbLink::to('Library', '#'),
 *         BreadcrumbLink::to('Data', active: true),
 *     )
 *     ->listId(false)
 *     ->render();
 * ```
 *
 * @see https://getbootstrap.com/docs/5.3/components/breadcrumb/
 */
final class Breadcrumbs extends Widget
{
    private const LIST_NAME = 'breadcrumb';
    private const ITEM_NAME = 'breadcrumb-item';
    private array $attributes = [];
    private array $cssClasses = [];
    private string $itemActiveClass = 'active';
    private array $itemAttributes = [];
    private array $linkAttributes = [];
    private array $links = [];
    private array $listAttributes = [];
    private bool|string $listId = true;
    private string $listTagName = 'ol';

    /**
     * Adds a set of attributes to the alert component.
     *
     * @param array $values Attribute values indexed by attribute names. e.g. `['id' => 'my-alert']`.
     *
     * @return self A new instance with the specified attributes added.
     */
    public function addAttributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = [...$new->attributes, ...$values];

        return $new;
    }

    /**
     * Adds one or more CSS classes to the existing classes of the breadcrumb component.
     *
     * Multiple classes can be added by passing them as separate arguments. `null` values are filtered out
     * automatically.
     *
     * @param BackedEnum|string|null ...$values One or more CSS class names to add. Pass `null` to skip adding a class.
     * For example:
     *
     * ```php
     * $breadcrumb->addClass('custom-class', null, 'another-class', BackgroundColor::PRIMARY);
     * ```
     *
     * @return self A new instance with the specified CSS classes added to existing ones.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function addClass(BackedEnum|string|null ...$values): self
    {
        $new = clone $this;
        $new->cssClasses = [...$this->cssClasses, ...$values];

        return $new;
    }

    /**
     * Adds a CSS style for the breadcrumb component.
     *
     * @param array|string $value The CSS style for the breadcrumb component. If an array, the values will be separated
     * by a space. If a string, it will be added as is. For example, 'color: red;'. If the value is an array, the values
     * will be separated by a space. e.g., ['color' => 'red', 'font-weight' => 'bold'] will be rendered as
     * 'color: red; font-weight: bold;'.
     * @param bool $overwrite Whether to overwrite existing styles with the same name. If `false`, the new value will be
     * appended to the existing one.
     *
     * @return self A new instance with the specified CSS style value added.
     */
    public function addCssStyle(array|string $value, bool $overwrite = true): self
    {
        $new = clone $this;
        Html::addCssStyle($new->attributes, $value, $overwrite);

        return $new;
    }

    /**
     * Sets the ARIA label for the breacrump component.
     *
     * @param string $value The ARIA label for the breacrumb component.
     *
     * @return self A new instance with the specified ARIA label.
     *
     * @link https://www.w3.org/TR/wai-aria-1.1/#aria-label
     */
    public function ariaLabel(string $value): self
    {
        $new = clone $this;
        $new->attributes['aria-label'] = $value;

        return $new;
    }

    /**
     * Sets the HTML attributes for the breadcrumb component.
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
        $new->attributes = $values;

        return $new;
    }

    /**
     * Replaces all existing CSS classes of the breadcrumb component with the provided ones.
     *
     * Multiple classes can be added by passing them as separate arguments. `null` values are filtered out
     * automatically.
     *
     * @param BackedEnum|string|null ...$values One or more CSS class names to set. Pass `null` to skip setting a class.
     * For example:
     *
     * ```php
     * $breadcrumb->class('custom-class', null, 'another-class', BackgroundColor::PRIMARY);
     * ```
     *
     * @return self A new instance with the specified CSS classes set.
     */
    public function class(BackedEnum|string|null ...$values): self
    {
        $new = clone $this;
        $new->cssClasses = $values;

        return $new;
    }

    /**
     * Set the divider for the breadcrumb component.
     *
     * @param string $value The divider for the breadcrumb component.
     *
     * @return self A new instance with the specified divider.
     */
    public function divider(string $value): self
    {
        if ($value === '') {
            throw new InvalidArgumentException('The "divider" cannot be empty.');
        }

        $new = clone $this;
        $new->attributes['style'] = ['--bs-breadcrumb-divider' => sprintf("'%s'", $value)];

        return $new;
    }

    /**
     * Sets the active class for the items in the breadcrumbs.
     *
     * @param string $value The active class for the items in the breadcrumbs.
     *
     * @return self A new instance with the specified active class for the items in the breadcrumbs.
     */
    public function itemActiveClass(string $value): self
    {
        $new = clone $this;
        $new->itemActiveClass = $value;

        return $new;
    }

    /**
     * Sets the HTML attributes for the items in the breadcrumbs.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes for the items in the breadcrumbs.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function itemAttributes(array $values): self
    {
        $new = clone $this;
        $new->itemAttributes = $values;

        return $new;
    }

    /**
     * Sets the HTML attributes for the link of the items in the breadcrumbs.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes for the link of the items in the breadcrumbs.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function linkAttributes(array $values): self
    {
        $new = clone $this;
        $new->linkAttributes = $values;

        return $new;
    }

    /**
     * List of links to appear in the breadcrumbs. If this property is empty, the widget will not render anything.
     *
     * @param BreadcrumnLink ...$value The links to appear in the breadcrumbs.
     *
     * @return self A new instance with the specified links to appear in the breadcrumbs.
     *
     * @psalm-param BreadcrumbLink[] $value The links to appear in the breadcrumbs.
     */
    public function links(BreadcrumbLink ...$value): self
    {
        $new = clone $this;
        $new->links = $value;

        return $new;
    }

    /**
     * Sets the HTML attributes for the list of items in the breadcrumbs.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes for the list of items in the breadcrumbs.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function listAttributes(array $values): self
    {
        $new = clone $this;
        $new->listAttributes = $values;

        return $new;
    }

    /**
     * Sets the ID of the list of items in the breadcrumbs.
     *
     * @param bool|string $value The ID of the breadcrumb component. If `true`, an ID will be generated automatically.
     *
     * @return self A new instance with the specified ID for the list of items in the breadcrumbs.
     */
    public function listId(bool|string $value): self
    {
        $new = clone $this;
        $new->listId = $value;

        return $new;
    }

    /**
     * Sets the HTML tag to be used for the list of items in the breadcrumbs.
     *
     * @param string $value The HTML tag name for the list of items in the breadcrumbs.
     *
     * @return self A new instance class with the specified list tag name.
     */
    public function listTagName(string $value): self
    {
        $new = clone $this;
        $new->listTagName = $value;

        return $new;
    }

    /**
     * Run the breadcrumb widget.
     *
     * @return string The HTML representation of the element.
     */
    public function render(): string
    {
        $attributes = $this->attributes;
        $attributes['aria-label'] ??= 'breadcrumb';

        if ($this->links === []) {
            return '';
        }

        $list = $this->renderList();

        if ($list === '') {
            return '';
        }

        return Nav::tag()
            ->addAttributes($attributes)
            ->addClass(...$this->cssClasses)
            ->content("\n", $list, "\n")
            ->encode(false)
            ->render();
    }

    /**
     * Renders the list of items in the breadcrumbs.
     *
     * @return string The rendering result.
     */
    private function renderList(): string
    {
        $listAttributes = $this->listAttributes;
        $classes = $listAttributes['class'] ?? null;

        /** @psalm-var non-empty-string|null $listId */
        $listId = match ($this->listId) {
            true => $listAttributes['id'] ?? Html::generateId(self::LIST_NAME . '-'),
            '', false => null,
            default => $this->listId,
        };

        unset($listAttributes['class'], $listAttributes['id']);

        $items = [];
        $active = 0;

        foreach ($this->links as $link) {
            $active += (int) $link->isActive();
            $items[] = $this->renderItem($link);

            if ($active > 1) {
                throw new RuntimeException('Only one "link" can be active.');
            }
        }

        $items = implode("\n", $items);

        if ($items === '') {
            return '';
        }

        Html::addCssClass($listAttributes, [self::LIST_NAME, $classes]);

        if ($this->listTagName === '') {
            throw new InvalidArgumentException('List tag cannot be empty.');
        }

        return Html::tag($this->listTagName)
            ->attributes($listAttributes)
            ->content("\n", $items, "\n")
            ->id($listId)
            ->encode(false)
            ->render();
    }

    /**
     * Renders a single breadcrumb item.
     *
     * @param BreadcrumbLink $breadcrumbLink The breadcrumb item to render.
     *
     * @return string The rendering result.
     */
    private function renderItem(BreadcrumbLink $breadcrumbLink): string
    {
        $itemsAttributes = $this->itemAttributes;
        $classes = $itemsAttributes['class'] ?? null;

        unset($itemsAttributes['class']);

        $linkTag = $this->renderLink($breadcrumbLink);
        Html::addCssClass($itemsAttributes, [self::ITEM_NAME, $classes]);

        if ($breadcrumbLink->isActive()) {
            $itemsAttributes['aria-current'] = 'page';

            Html::addCssClass($itemsAttributes, $this->itemActiveClass);
        }

        return Li::tag()->attributes($itemsAttributes)->content($linkTag)->encode(false)->render();
    }

    /**
     * Renders a single breadcrumb link.
     *
     * @param BreadcrumbLink $breadcrumbLink The breadcrumb link to render.
     *
     * @return string The rendering result.
     */
    private function renderLink(BreadcrumbLink $breadcrumbLink): string
    {
        $label = $breadcrumbLink->getLabel();
        $url = $breadcrumbLink->getUrl();

        return match ($url) {
            null => $label,
            default => A::tag()
                ->attributes($this->linkAttributes)
                ->addAttributes($breadcrumbLink->getAttributes())
                ->content($label)
                ->url($url)
                ->encode(false)
                ->render(),
        };
    }
}
