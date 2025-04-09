<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5;

/**
 *  Styles for the nav component.
 *
 * @see https://getbootstrap.com/docs/5.3/components/navs-tabs/#horizontal-alignment
 */
enum NavStyle: string
{
    /**
     * Horizontal navigation component for the top of an application. It is the most common navigation pattern for
     * desktop apps. Use it with `.navbar-nav` to apply the default styling.
     */
    case NAVBAR = 'navbar-nav me-auto mb-2 mb-lg-0';
    /**
     * Take that same HTML, but use `.nav-pills` instead.
     */
    case PILLS = 'nav-pills';
    /**
     * Takes the basic nav from above and adds the `.nav-tabs` class to generate a tabbed interface. Use them to create
     * tabbable regions with our tab JavaScript plugin.
     */
    case TABS = 'nav-tabs';
    /**
     * Take that same HTML, but use `.nav-underline` instead.
     */
    case UNDERLINE = 'nav-underline';
}
