<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use InvalidArgumentException;
use RuntimeException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Nav;

use function implode;
use function strtr;

/**
 * Button renders a bootstrap button.
 *
 * For example,
 *
 * ```php
 * ```
 */
final class Breadcrumbs extends \Yiisoft\Widget\Widget
{
    private const NAME = 'breadcrumb';
    private array $attributes = [];
    private string $activeItemTemplate = "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n";
    private bool|string $id = true;
    private string $itemTemplate = "<li class=\"breadcrumb-item\">{link}</li>\n";
    private array $links = [];
    private string $tagName = 'ol';

    /**
     * The template used to render each active item in the breadcrumbs. The token `{link}` will be replaced with the
     * actual HTML link for each active item.
     *
     * @param string $value The template to be used to render the active item.
     *
     * @return self A new instance with the specified active template.
     */
    public function activeItemTemplate(string $value): self
    {
        $new = clone $this;
        $new->activeItemTemplate = $value;

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
     * Sets the ID of the breadcrumb component.
     *
     * @param bool|string $value The ID of the breadcrumb component. If `true`, an ID will be generated automatically.
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
     * List of links to appear in the breadcrumbs. If this property is empty, the widget will not render anything. Each
     * array element represents a single link in the breadcrumbs with the following structure:
     *
     * @param array $value The links to appear in the breadcrumbs.
     *
     * @return self A new instance with the specified links.
     *
     * @psalm-param BreadcrumbLink[] $value The links to appear in the breadcrumbs.
     */
    public function links(BreadcrumbLink ...$value): self
    {
        $new = clone $this;
        $new->links = $value;

        return $new;
    }

    public function render(): string
    {
        $attributes = $this->attributes;

        $id = match ($this->id) {
            true => $attributes['id'] ?? Html::generateId(self::NAME . '-'),
            '', false => null,
            default => $this->id,
        };

        unset($attributes['id']);

        if ($this->links === []) {
            return '';
        }

        Html::addCssClass($attributes, [self::NAME]);

        $links = [];

        foreach ($this->links as $link) {
            $links[] = $this->renderItem($link);
        }

        $links = implode('', $links);

        if ($links === '') {
            return '';
        }

        if ($this->tagName === '') {
            throw new InvalidArgumentException('Tag cannot be empty string.');
        }

        $menuLinks = "\n" . Html::tag($this->tagName, "\n" . $links, $attributes)->encode(false) . "\n";

        return Nav::tag()->addAttributes($attributes)->content($menuLinks)->id($id)->encode(false)->render();
    }


    private function renderItem(BreadcrumbLink $breadcrumbLink): string
    {
        if ($breadcrumbLink->label === '') {
            throw new RuntimeException('The "label" element is required for each link.');
        }

        $attributes = $breadcrumbLink->attributes;
        $label = Html::encode($breadcrumbLink->label);
        $link = $label;
        $template = $this->activeItemTemplate;

        if ($breadcrumbLink->url !== null) {
            $template = $this->itemTemplate;
            $link = A::tag()->addAttributes($attributes)->content($label)->url($breadcrumbLink->url)->encode(false);
        }

        return strtr($template, ['{link}' => $link]);
    }
}
