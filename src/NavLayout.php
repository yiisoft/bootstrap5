<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5;

/**
 * Layouts for the nav component.
 *
 * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#fill-and-justify
 * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#horizontal-alignment
 * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#vertical
 */
enum NavLayout: string
{
    /**
     * Change the horizontal alignment of your nav with flexbox utilities. By default, navs are left-aligned, but you
     * can change them to center or right-aligned.
     */
    case CENTER = 'justify-content-center';
    /**
     * Take that same HTML, but use `.nav-borders` instead.
     */
    case FILL = 'nav-fill';
    /**
     * All horizontal space will be occupied by nav links, but unlike the `.nav-fill` above, every nav item will be the
     * same width.
     */
    case JUSTIFY = 'nav-justified';
    /**
     * Right alignment of nav items
     */
    case RIGHT = 'justify-content-end';
    /**
     * Stack navigation items vertically
     */
    case VERTICAL = 'flex-column';
}
