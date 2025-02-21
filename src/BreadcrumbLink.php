<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use Yiisoft\Html\Html;

/**
 * BreadcrumbLink represents a single breadcrumb navigation link.
 *
 * Each link can be either active or inactive, and can be rendered as a plain text (when active) or as a hyperlink
 * (when inactive).
 *
 * Example:
 * ```php
 * // Create a standard link
 * BreadcrumbLink::to('Home', '/');
 *
 * // Create an active link (current page)
 * BreadcrumbLink::to('Current Page', null, true);
 *
 * // Create a link with custom attributes
 * BreadcrumbLink::to('Link', '/path', false, ['class' => 'custom-link']);
 * ```
 */
final class BreadcrumbLink
{
    /**
     * Use {@see BreadcrumbLink::to()} to create an instance.
     */
    private function __construct(
        private string $label,
        private string|null $url,
        private bool $active,
        private bool $encodeLabel,
        private array $attributes,
    ) {
    }

    /**
     * Creates a new {@see BreadcrumbLink} instance.
     *
     * @param string $label The label text to display.
     * @param string|null $url The URL for the link.
     * @param bool $active Whether this link represents the current page.
     * @param array $attributes Additional HTML attributes for the link.
     * @param bool $encodeLabel Whether to HTML encode the label.
     *
     * @return self A new instance with the specified configuration.
     */
    public static function to(
        string $label,
        string|null $url = null,
        bool $active = false,
        array $attributes = [],
        bool $encodeLabel = true
    ): self {
        return new self($label, $url, $active, $encodeLabel, $attributes);
    }

    /**
     * Sets the active state.
     *
     * @param bool $enabled Whether the breadcrumb link is active.
     *
     * @return self A new instance with the specified active state.
     */
    public function active(bool $enabled): self
    {
        $new = clone $this;
        $new->active = $enabled;

        return $new;
    }

    /**
     * Sets the HTML attributes for the link.
     *
     * @param array $attributes Attribute values indexed by attribute names.
     *
     * @return self A new instance with the specified attributes.
     *
     * @see {\Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function attributes(array $attributes): self
    {
        $new = clone $this;
        $new->attributes = $attributes;

        return $new;
    }

    /**
     * Sets whether to HTML encode the label.
     *
     * @param bool $enabled Whether to HTML encode the label.
     *
     * @return self A new instance with the specified encoding behavior.
     */
    public function encodeLabel(bool $enabled): self
    {
        $new = clone $this;
        $new->encodeLabel = $enabled;

        return $new;
    }

    /**
     * Sets the label text to display.
     *
     * @param string $label The label text to display.
     *
     * @return self A new instance with the specified label.
     */
    public function label(string $label): self
    {
        $new = clone $this;
        $new->label = $label;

        return $new;
    }

    /**
     * Sets the URL for the link.
     *
     * @param string|null $url The URL for the link.
     *
     * @return self A new instance with the specified URL.
     */
    public function url(string|null $url): self
    {
        $new = clone $this;
        $new->url = $url;

        return $new;
    }

    /**
     * @return array The HTML attributes for the link.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return string The encoded label content. For default behavior, the label will be HTML-encoded. You can
     * disable this by setting `encodeLabel` to `false`.
     */
    public function getLabel(): string
    {
        return $this->encodeLabel ? Html::encode($this->label) : $this->label;
    }

    /**
     * @return string|null The URL for the link.
     */
    public function getUrl(): string|null
    {
        return $this->url;
    }

    /**
     * @return bool Whether the item is active.
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
