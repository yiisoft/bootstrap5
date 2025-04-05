<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Bootstrap5\Dropdown;
use Yiisoft\Bootstrap5\DropdownItem;
use Yiisoft\Bootstrap5\Nav;
use Yiisoft\Bootstrap5\NavBar;
use Yiisoft\Bootstrap5\NavBarExpand;
use Yiisoft\Bootstrap5\NavBarPlacement;
use Yiisoft\Bootstrap5\NavLink;
use Yiisoft\Bootstrap5\NavStyle;
use Yiisoft\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Img;
use Yiisoft\Html\Tag\Span;

use function trim;

/**
 * Tests for `NavBar` widget.
 */
#[Group('navbar')]
final class NavBarTest extends TestCase
{
    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg" data-id="123">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->addAttributes(['data-id' => '123'])->id('navbar')->begin()) . NavBar::end(),
        );
    }

    public function testAddClass(): void
    {
        $navbar = NavBar::widget()->addClass('test-class', null, BackgroundColor::PRIMARY)->id('navbar');

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg test-class bg-primary">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->begin()) . NavBar::end(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg test-class bg-primary test-class-1 test-class-2">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->addClass('test-class-1', 'test-class-2')->begin()) . NavBar::end(),
        );
    }

    public function testAddCssStyle(): void
    {
        $navbar = NavBar::widget()->addCssStyle('color: red;')->id('navbar');

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg" style="color: red;">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->begin()) . NavBar::end(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg" style="color: red; font-weight: bold;">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->addCssStyle('font-weight: bold;')->begin()) . NavBar::end(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $navbar = NavBar::widget()->addCssStyle('color: red;')->id('navbar');

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg" style="color: red;">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->begin()) . NavBar::end(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg" style="color: red;">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim($navbar->addCssStyle('color: blue;', false)->begin()) . NavBar::end(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg test-class">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->attributes(['class' => 'test-class'])->id('navbar')->begin()) . NavBar::end(),
        );
    }

    public function testBrand(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <b>YiiFramework</b>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->brand('<b>YiiFramework</b>')->id('navbar')->begin()) . NavBar::end(),
        );
    }

    public function testBrandAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 test-class">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()->brandText('NavBar')
                    ->brandAttributes(['class' => 'test-class'])
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#text
     */
    public function testBrandText(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->brandText('NavBar')->id('navbar')->begin()) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#text
     */
    public function testBrandTextAsLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">NavBar</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->brandText('NavBar')->brandUrl('#')->id('navbar')->begin()) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#image
     */
    public function testBrandAsImage(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" width="30" height="24" alt="bootstrap">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandImage('/docs/5.3/assets/brand/bootstrap-logo.svg')
                    ->brandImageAttributes(
                        [
                            'alt' => 'bootstrap',
                            'width' => 30,
                            'height' => 24,
                        ],
                    )
                    ->brandUrl('#')
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#image
     */
    public function testBrandAsImageWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" width="30" height="24" alt="bootstrap">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                ->brandImage(
                    Img::tag()
                        ->alt('bootstrap')
                        ->height(24)
                        ->src('/docs/5.3/assets/brand/bootstrap-logo.svg')
                        ->width(30)
                )
                ->brandUrl('#')
                ->id('navbar')
                ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#image-and-text
     */
    public function testBrandAsImageAndText(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" width="30" height="24" alt="bootstrap">
            NavBar
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandImage('/docs/5.3/assets/brand/bootstrap-logo.svg')
                    ->brandImageAttributes(
                        [
                            'alt' => 'bootstrap',
                            'width' => 30,
                            'height' => 24,
                        ],
                    )
                    ->brandText('NavBar')
                    ->brandUrl('#')
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    public function testBrandWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <span>NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->brand(Span::tag()->content('NavBar'))->id('navbar')->begin()) . NavBar::end(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg custom-class another-class bg-primary">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->addClass('test-class')
                    ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#containers
     */
    public function testContainer(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="container">
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            </div>
            HTML,
            trim(
                NavBar::widget()
                    ->container(true)
                    ->containerAttributes(['class' => 'container'])
                    ->brandText('NavBar')
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#containers
     */
    public function testContainerResponsive(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-md">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->innerContainerAttributes(['class' => 'container-md'])
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#responsive-behaviors
     */
    public function testExpandWithSm(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->expand(NavBarExpand::SM)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#responsive-behaviors
     */
    public function testExpandWithMd(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->expand(NavBarExpand::MD)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#responsive-behaviors
     */
    public function testExpandWithLg(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->expand(NavBarExpand::LG)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#responsive-behaviors
     */
    public function testExpandWithXl(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-xl">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->expand(NavBarExpand::XL)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#responsive-behaviors
     */
    public function testExpandWithXxl(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-xxl">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->expand(NavBarExpand::XXL)
                    ->id('navbar')
                    ->begin()
            ) . NavBar::end(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#test-id" aria-controls="test-id" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="test-id" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->attributes(['id' => 'test-id'])->id(true)->begin()) . NavBar::end(),
        );
    }

    public function testImmutability(): void
    {
        $navBar = NavBar::widget();

        $this->assertNotSame($navBar, $navBar->addAttributes([]));
        $this->assertNotSame($navBar, $navBar->addClass(''));
        $this->assertNotSame($navBar, $navBar->addCssStyle(''));
        $this->assertNotSame($navBar, $navBar->attributes([]));
        $this->assertNotSame($navBar, $navBar->brand(Span::tag()));
        $this->assertNotSame($navBar, $navBar->brandImage(''));
        $this->assertNotSame($navBar, $navBar->brandImageAttributes([]));
        $this->assertNotSame($navBar, $navBar->brandText(''));
        $this->assertNotSame($navBar, $navBar->brandAttributes([]));
        $this->assertNotSame($navBar, $navBar->brandUrl(''));
        $this->assertNotSame($navBar, $navBar->class(''));
        $this->assertNotSame($navBar, $navBar->container(false));
        $this->assertNotSame($navBar, $navBar->containerAttributes([]));
        $this->assertNotSame($navBar, $navBar->expand(NavBarExpand::LG));
        $this->assertNotSame($navBar, $navBar->id(false));
        $this->assertNotSame($navBar, $navBar->innerContainer(false));
        $this->assertNotSame($navBar, $navBar->innerContainerAttributes([]));
        $this->assertNotSame($navBar, $navBar->placement(NavBarPlacement::FIXED_TOP));
        $this->assertNotSame($navBar, $navBar->tag(''));
        $this->assertNotSame($navBar, $navBar->toggler(''));
        $this->assertNotSame($navBar, $navBar->theme('dark'));
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#placement
     */
    public function testPlacementWithFixedBottom(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg fixed-bottom">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                ->brandText('NavBar')
                ->id('navbar')
                ->placement(NavBarPlacement::FIXED_BOTTOM)
                ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#placement
     */
    public function testPlacementWithFixedTop(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->id('navbar')
                    ->placement(NavBarPlacement::FIXED_TOP)
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#placement
     */
    public function testPlacementWithStickyBottom(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg sticky-bottom">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->id('navbar')
                    ->placement(NavBarPlacement::STICKY_BOTTOM)
                    ->begin()
            ) . NavBar::end(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#placement
     */
    public function testPlacementWithStickyTop(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">NavBar</span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            HTML,
            trim(
                NavBar::widget()
                    ->brandText('NavBar')
                    ->id('navbar')
                    ->placement(NavBarPlacement::STICKY_TOP)
                    ->begin()
            ),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navbar/#color-schemes
     */
    public function testTheme(): void
    {
        $navbar = NavBar::widget()
            ->addClass(BackgroundColor::BODY_TERTIARY)
            ->brandText('NavBar')
            ->brandUrl('#')
            ->id('navbar')
            ->theme('dark')
            ->begin();

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">NavBar</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
            HTML,
            trim($navbar),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">NavBar</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" href="/home" aria-current="page">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/link">Link</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
            <ul class="dropdown-menu">
            <li>
            <a class="dropdown-item" href="/sub/action">Action</a>
            </li>
            <li>
            <a class="dropdown-item" href="/sub/another-action">Another action</a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>
            <li>
            <a class="dropdown-item" href="/sub/something-else">Something else here</a>
            </li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" href="#" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            </div>
            </div>
            </nav>
            HTML,
            NavBar::widget()
                ->addClass(BackgroundColor::BODY_TERTIARY)
                ->brandText('NavBar')
                ->brandUrl('#')
                ->id('navbarSupportedContent')
                ->begin() .
                Nav::widget()
                    ->currentPath('/home')
                    ->items(
                        NavLink::to('Home', '/home'),
                        NavLink::to('Link', '/link'),
                        Dropdown::widget()
                            ->items(
                                DropdownItem::link('Action', '/sub/action'),
                                DropdownItem::link('Another action', '/sub/another-action'),
                                DropdownItem::divider(),
                                DropdownItem::link('Something else here', '/sub/something-else'),
                            )
                            ->togglerContent('Dropdown'),
                        NavLink::to('Disabled', '#', disabled: true),
                    )
                    ->styles(NavStyle::NAVBAR)
                    ->render() .
            NavBar::end(),
        );
    }

    public function testThrowExceptionForTagWithEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag cannot be empty string.');

        NavBar::widget()->tag('')->begin();
    }

    public function testToggler(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <button>Custom toggler</button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->toggler('<button>Custom toggler</button>')->id('navbar')->begin()) . NavBar::end(),
        );
    }

    public function testTogglerWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <button type="button">Custom toggler</button>
            <div id="navbar" class="collapse navbar-collapse">
            </div>
            </div>
            </nav>
            HTML,
            trim(NavBar::widget()->toggler(Button::button('Custom toggler'))->id('navbar')->begin()) . NavBar::end(),
        );
    }
}
