<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use InvalidArgumentException;
use Stringable;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Li;

/**
 * Represents a Bootstrap Nav item and link.
 */
final class NavLink
{
    private const NAV_LINK_ACTIVE_CLASS = 'active';
    private const NAV_LINK_DISABLED_CLASS = 'disabled';
    private const NAV_LINK_CLASS = 'nav-link';
    private const NAV_ITEM_CLASS = 'nav-item';
    /** @psalm-suppress PropertyNotSetInConstructor */
    private A|Li $content;

    private function __construct()
    {
    }

    /**
     * Creates a nav item with a link.
     *
     * @param string|Stringable $label The label of the link.
     * @param string|null $url The URL of the link.
     * @param bool $active Whether the link is active.
     * @param bool $disabled Whether the link is disabled.
     * @param array $attributes Additional HTML attributes for the list item.
     * @param array $linkAttributes Additional HTML attributes for the link.
     *
     * @throws InvalidArgumentException If the link is both active and disabled.
     *
     * @return self A new instance with the specified attributes.
     */
    public static function item(
        string|Stringable $label = '',
        string|null $url = null,
        bool $active = false,
        bool $disabled = false,
        array $attributes = [],
        array $linkAttributes = [],
    ): self {
        $navlink = new self();

        $classes = $attributes['class'] ?? null;
        $linkClasses = $linkAttributes['class'] ?? null;

        unset($attributes['class'], $linkAttributes['class']);

        if ($active === true && $disabled === true) {
            throw new InvalidArgumentException('The nav item cannot be active and disabled at the same time.');
        }

        Html::addCssClass($linkAttributes, [self::NAV_LINK_CLASS]);

        if ($active === true) {
            Html::addCssClass($linkAttributes, [self::NAV_LINK_ACTIVE_CLASS]);

            $linkAttributes['aria-current'] = 'page';
        }

        if ($disabled === true) {
            Html::addCssClass($linkAttributes, [self::NAV_LINK_DISABLED_CLASS]);

            $linkAttributes['aria-disabled'] = 'true';
        }

        $navlink->content = Li::tag()
            ->addClass(
                self::NAV_ITEM_CLASS,
                $classes,
            )
            ->addContent(
                "\n",
                A::tag()->addAttributes($linkAttributes)->addClass($linkClasses)->addContent($label)->href($url),
                "\n",
            );

        return $navlink;
    }

    /**
     * Creates a nav link.
     *
     * @param string|Stringable $label The label of the link.
     * @param string|null $url The URL of the link.
     * @param bool $active Whether the link is active.
     * @param bool $disabled Whether the link is disabled.
     * @param array $attributes Additional HTML attributes for the link.
     *
     * @throws InvalidArgumentException If the link is both active and disabled.
     *
     * @return self A new instance with the specified attributes.
     */
    public static function to(
        string|Stringable $label = '',
        string|null $url = null,
        bool $active = false,
        bool $disabled = false,
        array $attributes = [],
    ): self {
        $navlink = new self();

        $classes = $attributes['class'] ?? null;

        unset($attributes['class']);

        if ($active === true && $disabled === true) {
            throw new InvalidArgumentException('The nav link cannot be active and disabled at the same time.');
        }

        Html::addCssClass($attributes, [self::NAV_LINK_CLASS]);

        if ($active === true) {
            Html::addCssClass($attributes, [self::NAV_LINK_ACTIVE_CLASS]);

            $attributes['aria-current'] = 'page';
        }

        if ($disabled === true) {
            Html::addCssClass($attributes, [self::NAV_LINK_DISABLED_CLASS]);

            $attributes['aria-disabled'] = 'true';
        }

        $navlink->content = A::tag()->addAttributes($attributes)->addClass($classes)->addContent($label)->href($url);

        return $navlink;
    }

    /**
     * @return A|Li Returns the encoded label content.
     */
    public function getContent(): A|Li
    {
        return $this->content;
    }
}
