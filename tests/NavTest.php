<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Yiisoft\Bootstrap5\Dropdown;
use Yiisoft\Bootstrap5\DropdownItem;
use Yiisoft\Bootstrap5\Nav;
use Yiisoft\Bootstrap5\NavLayout;
use Yiisoft\Bootstrap5\NavLink;
use Yiisoft\Bootstrap5\NavStyle;
use Yiisoft\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;

/**
 * Tests for `Nav` widget.
 */
#[Group('nav')]
final class NavTest extends TestCase
{
    public function testActivateParents(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item active" aria-current="true" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->activateParents(true)
                ->currentPath('/test/link/another-action')
                ->items(
                    NavLink::to('Active', '/test'),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action'),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testActivateParentsWithoutActiveDropdownItem(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->activateParents(true)
                ->currentPath('/not/matching')
                ->items(
                    NavLink::to('Active', '/test', active: true),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action'),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testActivateParentsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item active" aria-current="true" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->activateParents(false)
                ->currentPath('/test/link/another-action')
                ->items(
                    NavLink::to('Active', '/test'),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action'),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul data-test="test" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->addAttributes(['data-test' => 'test'])
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testAddClass(): void
    {
        $navWidget = Nav::widget()
            ->addClass('test-class', null, BackgroundColor::PRIMARY)
            ->items(
                NavLink::to('Active', '#', active: true),
                NavLink::to('Link', url: '#'),
                NavLink::to('Link', url: '#'),
                NavLink::to('Disabled', '#', disabled: true),
            );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav test-class bg-primary">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav test-class bg-primary test-class-1 test-class-2">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddCssStyle(): void
    {
        $navWidget = Nav::widget()
            ->addCssStyle(['color' => 'red'])
            ->items(
                NavLink::to('Active', '#', active: true),
                NavLink::to('Link', url: '#'),
                NavLink::to('Link', url: '#'),
                NavLink::to('Disabled', '#', disabled: true),
            );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul style="color: red;" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul style="color: red; font-weight: bold;" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->addCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $navWidget = Nav::widget()
            ->addCssStyle(['color' => 'red'])
            ->items(
                NavLink::to('Active', '#', active: true),
                NavLink::to('Link', url: '#'),
                NavLink::to('Link', url: '#'),
                NavLink::to('Disabled', '#', disabled: true),
            );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul style="color: red;" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <ul style="color: red;" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            $navWidget->addCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul data-id="123" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->attribute('data-id', '123')
                ->items(NavLink::to('Active', '#', active: true))
                ->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul data-test="test" class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->attributes(['data-test' => 'test'])
                ->items(NavLink::to('Active', '#', active: true))
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#base-nav
     */
    public function testBaseNav(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#base-nav
     */
    public function testBaseNavWithTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="nav">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            <a href="#" class="nav-link">Link</a>
            <a href="#" class="nav-link">Link</a>
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </nav>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->tag('nav')
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav custom-class another-class bg-primary">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->addClass('test-class')
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testCurrentPath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link active" aria-current="page">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/link/another-link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->currentPath('/test/link')
                ->items(
                    NavLink::to('Active', '/test'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Link', '/test/link/another-link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testCurrentPathAndActivateItemsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/link/another-link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->activateItems(false)
                ->currentPath('/test/link')
                ->items(
                    NavLink::to('Active', '/test'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Link', '/test/link/another-link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testDropdownAndCurrentPath(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item active" aria-current="true" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->currentPath('/test/link/another-action')
                ->items(
                    NavLink::to('Active', '/test'),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action'),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testDropdownAndCurrentPathAndActivateItemsWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->activateItems(false)
                ->currentPath('/test/link/another-action')
                ->items(
                    NavLink::to('Active', '/test'),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action'),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testDropdownExplicitActive(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/test/link/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item active" aria-current="true" href="/test/link/another-action">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/something-else">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/test/link/separated-link">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="/test/link" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '/test'),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '/test/link/action'),
                            DropdownItem::link('Another action', '/test/link/another-action', active: true),
                            DropdownItem::link('Something else here', '/test/link/something-else'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '/test/link/separated-link'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', '/test/link'),
                    NavLink::to('Disabled', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testEncodeLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link">&lt;b&gt;Active&lt;/b&gt;</a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true">&lt;b&gt;Disabled&lt;b&gt;</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('<b>Active</b>', '/test'),
                    NavLink::to('<b>Disabled<b>', '/test/disabled', disabled: true),
                )
                ->render(),
        );
    }

    public function testEncodeLabelWithFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="/test" class="nav-link"><b>Active</b></a>
            </li>
            <li class="nav-item">
            <a href="/test/disabled" class="nav-link disabled" aria-disabled="true"><b>Disabled<b></a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('<b>Active</b>', '/test', encodeLabel: false),
                    NavLink::to('<b>Disabled<b>', '/test/disabled', disabled: true, encodeLabel: false),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#fill-and-justify
     */
    public function testFillAndJustified(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Much longer nav link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Much longer nav link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS, NavLayout::JUSTIFY)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#horizontal-alignment
     */
    public function testHorizontalAlignmentCenter(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav justify-content-center">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavLayout::CENTER)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#horizontal-alignment
     */
    public function testHorizontalAlignmentRight(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav justify-content-end">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavLayout::RIGHT)
                ->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav" id="test-id">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->id('test-id')
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testIdWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->id('')
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testIdWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->id(false)
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav" id="test-id">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->attributes(['id' => 'test-id'])
                ->id(true)
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->render(),
        );
    }

    public function testImmutability(): void
    {
        $navWidget = Nav::widget();

        $this->assertNotSame($navWidget, $navWidget->activateItems(false));
        $this->assertNotSame($navWidget, $navWidget->activateParents(true));
        $this->assertNotSame($navWidget, $navWidget->addAttributes([]));
        $this->assertNotSame($navWidget, $navWidget->addClass(''));
        $this->assertNotSame($navWidget, $navWidget->addCssStyle(''));
        $this->assertNotSame($navWidget, $navWidget->attribute('', ''));
        $this->assertNotSame($navWidget, $navWidget->attributes([]));
        $this->assertNotSame($navWidget, $navWidget->class(''));
        $this->assertNotSame($navWidget, $navWidget->currentPath(''));
        $this->assertNotSame($navWidget, $navWidget->fade(false));
        $this->assertNotSame($navWidget, $navWidget->items(NavLink::to('')));
        $this->assertNotSame($navWidget, $navWidget->paneAttributes([]));
        $this->assertNotSame($navWidget, $navWidget->styles(NavStyle::TABS));
    }

    public function testNavLinkWithAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li data-test="test" class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(NavLink::to('Active', '#', active: true, attributes: ['data-test' => 'test']))
                ->render(),
        );
    }

    public function testNavLinkWithUrlAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="#" data-test="test" class="nav-link active" aria-current="page">Active</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(NavLink::to('Active', '#', active: true, urlAttributes: ['data-test' => 'test']))
                ->render(),
        );
    }

    public function testNavLinkWithVisibleFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Invisible', '#', visible: false),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#pills
     */
    public function testPills(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#pills-with-dropdowns
     */
    public function testPillsWithDropdown(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="#">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '#'),
                            DropdownItem::link('Another action', '#'),
                            DropdownItem::link('Something else here', '#'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '#'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#fill-and-justify
     */
    public function testPillsWithFill(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Much longer nav link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Much longer nav link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS, NavLayout::FILL)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#fill-and-justify
     */
    public function testPillsWithJustify(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Much longer nav link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Much longer nav link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS, NavLayout::JUSTIFY)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#javascript-behavior
     */
    public function testPillsWithNavLinkTab(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-pills mb-3" role="tablist" id="pills-tab">
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home-tab-pane" role="tab" aria-controls="pills-home-tab-pane" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile-tab-pane" role="tab" aria-controls="pills-profile-tab-pane" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact-tab-pane" role="tab" aria-controls="pills-contact-tab-pane" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled-tab-pane" role="tab" aria-controls="pills-disabled-tab-pane" aria-selected="false">Disabled</button>
            </li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0" id="pills-home-tab-pane">This is some placeholder content the Home tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0" id="pills-profile-tab-pane">This is some placeholder content the Profile tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0" id="pills-contact-tab-pane">This is some placeholder content the Contact tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0" id="pills-disabled-tab-pane">This is some placeholder content the Disabled tab's associated content.</div>
            </div>
            HTML,
            Nav::widget()
                ->addClass('mb-3')
                ->id('pills-tab')
                ->items(
                    NavLink::tab(
                        'Home',
                        "This is some placeholder content the Home tab's associated content.",
                        true,
                        paneId: 'pills-home-tab',
                    ),
                    NavLink::tab(
                        'Profile',
                        "This is some placeholder content the Profile tab's associated content.",
                        paneId: 'pills-profile-tab',
                    ),
                    NavLink::tab(
                        'Contact',
                        "This is some placeholder content the Contact tab's associated content.",
                        paneId: 'pills-contact-tab',
                    ),
                    NavLink::tab(
                        'Disabled',
                        "This is some placeholder content the Disabled tab's associated content.",
                        paneId: 'pills-disabled-tab',
                    ),
                )
                ->styles(NavStyle::PILLS)
            ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#supported-content
     */
    public function testNavBar(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::NAVBAR)
                ->render(),
        );
    }

    public function testRenderWithEmptyItems(): void
    {
        $this->assertEmpty(Nav::widget()->render());
    }

    /**
     * @link https://github.com/yiisoft/bootstrap5/issues/244
     */
    public function testTabPaneWithEncodeContentFalseValue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" id="test1" data-bs-toggle="tab" data-bs-target="#test1-pane" role="tab" aria-controls="test1-pane" aria-selected="true">title1</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="test2" data-bs-toggle="tab" data-bs-target="#test2-pane" role="tab" aria-controls="test2-pane" aria-selected="false">title2</button>
            </li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="test1" tabindex="0" id="test1-pane"><p>Some HTML</p></div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="test2" tabindex="0" id="test2-pane"><p>Some HTML</p></div>
            </div>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::tab('title1', '<p>Some HTML</p>', true, encodeContent: false, paneId: 'test1'),
                    NavLink::tab('title2', '<p>Some HTML</p>', encodeContent: false, paneId: 'test2'),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }

    public function testTabPaneWithSetIDPaneAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" id="test1" data-bs-toggle="tab" data-bs-target="#test1-pane" role="tab" aria-controls="test1-pane" aria-selected="true">title1</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="test2" data-bs-toggle="tab" data-bs-target="#test2-pane" role="tab" aria-controls="test2-pane" aria-selected="false">title2</button>
            </li>
            </ul>
            <div class="tab-content">
            <div id="test1-pane" class="tab-pane fade show active" role="tabpanel" aria-labelledby="test1" tabindex="0">Some HTML</div>
            <div id="test2-pane" class="tab-pane fade" role="tabpanel" aria-labelledby="test2" tabindex="0">Some HTML</div>
            </div>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::tab('title1', 'Some HTML', true, paneAttributes: ['id' => 'test1']),
                    NavLink::tab('title2', 'Some HTML', false, paneAttributes: ['id' => 'test2']),
                )
                ->styles(NavStyle::TABS)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#tabs
     */
    public function testTabs(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::TABS)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#tabs-with-dropdowns
     */
    public function testTabsWithDropdown(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="#">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '#'),
                            DropdownItem::link('Another action', '#'),
                            DropdownItem::link('Something else here', '#'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '#'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#javascript-behavior
     */
    public function testTabsWithNavLinkTab(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs" role="tablist" id="nav-tabs">
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Disabled</button>
            </li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" tabindex="0" id="home-tab-pane">This is some placeholder content the Home tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="profile-tab" tabindex="0" id="profile-tab-pane">This is some placeholder content the Profile tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="contact-tab" tabindex="0" id="contact-tab-pane">This is some placeholder content the Contact tab's associated content.</div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0" id="disabled-tab-pane">This is some placeholder content the Disabled tab's associated content.</div>
            </div>
            HTML,
            Nav::widget()
                ->id('nav-tabs')
                ->items(
                    NavLink::tab(
                        'Home',
                        "This is some placeholder content the Home tab's associated content.",
                        true,
                        paneId: 'home-tab',
                    ),
                    NavLink::tab(
                        'Profile',
                        "This is some placeholder content the Profile tab's associated content.",
                        paneId: 'profile-tab',
                    ),
                    NavLink::tab(
                        'Contact',
                        "This is some placeholder content the Contact tab's associated content.",
                        paneId: 'contact-tab',
                    ),
                    NavLink::tab(
                        'Disabled',
                        "This is some placeholder content the Disabled tab's associated content.",
                        paneId: 'disabled-tab',
                    ),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }

    public function testThrowExceptionForFadeWithoutTabsOrPills(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Fade effect can only be used with tabs or pills.');

        Nav::widget()->fade(true)->render();
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#underline
     */
    public function testUnderline(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-underline">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::UNDERLINE)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#vertical
     */
    public function testVertical(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav flex-column">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavLayout::VERTICAL)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#working-with-flex-utilities
     */
    public function testWorkingWithFlexUtilities(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="nav nav-pills flex-column flex-sm-row">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            <a href="#" class="nav-link active" aria-current="page">Longer nav link</a>
            <a href="#" class="nav-link">Link</a>
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </nav>
            HTML,
            Nav::widget()
                ->addClass('flex-sm-row')
                ->items(
                    NavLink::to('Active', '#', active: true),
                    NavLink::to('Longer nav link', '#', active: true),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::PILLS, NavLayout::VERTICAL)
                ->tag('nav')
                ->render(),
        );
    }

    public function testDropdownAddTogglerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle test-class" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="#">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    Dropdown::widget()
                        ->addTogglerClass('test-class')
                        ->items(
                            DropdownItem::link('Action', '#'),
                            DropdownItem::link('Another action', '#'),
                            DropdownItem::link('Something else here', '#'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '#'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }

    public function testDropdownAddClassForAllItemsDropdown(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown test-class">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="#">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->addDropdownClass('test-class')
                ->items(
                    NavLink::to('Active', '#', active: true),
                    Dropdown::widget()
                        ->items(
                            DropdownItem::link('Action', '#'),
                            DropdownItem::link('Another action', '#'),
                            DropdownItem::link('Something else here', '#'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '#'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }

    public function testDropdownAddClassForIndividualItemDropdown(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#" class="nav-link active" aria-current="page">Active</a>
            </li>
            <li class="nav-item dropdown test-class">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="#">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
            <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="#">Separated link</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">Link</a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            HTML,
            Nav::widget()
                ->items(
                    NavLink::to('Active', '#', active: true),
                    Dropdown::widget()
                        ->addClass('test-class')
                        ->items(
                            DropdownItem::link('Action', '#'),
                            DropdownItem::link('Another action', '#'),
                            DropdownItem::link('Something else here', '#'),
                            DropdownItem::divider(),
                            DropdownItem::link('Separated link', '#'),
                        )
                        ->togglerContent('Dropdown'),
                    NavLink::to('Link', url: '#'),
                    NavLink::to('Disabled', '#', disabled: true),
                )
                ->styles(NavStyle::TABS)
            ->render(),
        );
    }
}
