<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Bootstrap5\Accordion;
use Yiisoft\Bootstrap5\AccordionItem;
use Yiisoft\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;

/**
 * Tests for `Accordion` widget
 */
#[Group('accordion')]
final class AccordionTest extends TestCase
{
    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" data-id="123">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->addAttributes(['data-id' => '123'])
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testAddClass(): void
    {
        $accordion = Accordion::widget()
            ->addClass('test-class', null, BackgroundColor::PRIMARY)
            ->id('accordion')
            ->items(
                AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
            );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion test-class bg-primary">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion test-class bg-primary test-class-1 test-class-2">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddCssStyle(): void
    {
        $accordion = Accordion::widget()
            ->addCssStyle('color: red;')
            ->id('accordion')
            ->items(AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'));

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" style="color: red;">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" style="color: red; font-weight: bold;">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $accordion = Accordion::widget()
            ->addCssStyle('color: red;')
            ->id('accordion')
            ->items(AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'));

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" style="color: red;">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" style="color: red;">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAddTogglerAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-id="123" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->addTogglerAttribute('data-id', '123')
                ->render(),
        );
    }

    public function testAddTogglerClass(): void
    {
        $accordion = Accordion::widget()
            ->addTogglerClass('test-class', null, BackgroundColor::PRIMARY)
            ->id('accordion')
            ->items(AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'));

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed test-class bg-primary" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed test-class bg-primary test-class-1 test-class-2" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addTogglerClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddTogglerCssStyle(): void
    {
        $accordion = Accordion::widget()
            ->id('accordion')
            ->items(AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'))
            ->addTogglerCssStyle('color: red;');

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" style="color: red;" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" style="color: red; font-weight: bold;" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addTogglerCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddTogglerCssStyleWithOverwriteFalse(): void
    {
        $accordion = Accordion::widget()
            ->id('accordion')
            ->items(AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'))
            ->addTogglerCssStyle('color: red;');

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" style="color: red;" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" style="color: red;" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            $accordion->addTogglerCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion" data-id="123">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->attribute('data-id', '123')
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion test-class">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->attributes(['class' => 'test-class'])
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/accordion/#always-open
     */
    public function testAlwaysOpen(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="true" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse show">
            <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="false" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse">
            <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-3" aria-expanded="false" aria-controls="accordion-3">
            Accordion Item #3
            </button>
            </h2>
            <div id="accordion-3" class="accordion-collapse collapse">
            <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->alwaysOpen()
                ->id('accordion')
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "<strong>This is the first item's accordion body.</strong>" .
                        ' It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-1',
                        encodeBody: false,
                        active: true
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "<strong>This is the second item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-2',
                        encodeBody: false
                    ),
                    AccordionItem::to(
                        'Accordion Item #3',
                        "<strong>This is the third item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-3',
                        encodeBody: false
                    )
                )
                ->render(),
        );
    }

    public function testBodyAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body test-class">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->bodyAttributes(['class' => 'test-class'])
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion custom-class another-class bg-primary">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->addClass('test-class')
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testCollapseAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse test-class" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->collapseAttributes(['class' => 'test-class'])
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/accordion/#flush
     */
    public function testFlush(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion accordion-flush">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="false" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-3" aria-expanded="false" aria-controls="accordion-3">
            Accordion Item #3
            </button>
            </h2>
            <div id="accordion-3" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->flush()
                ->id('accordion')
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "<strong>This is the first item's accordion body.</strong>" .
                        ' It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-1',
                        encodeBody: false
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "<strong>This is the second item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-2',
                        encodeBody: false
                    ),
                    AccordionItem::to(
                        'Accordion Item #3',
                        "<strong>This is the third item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-3',
                        encodeBody: false
                    ),
                )
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/accordion/#flush
     */
    public function testFlushWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="true" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse show" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="false" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-3" aria-expanded="false" aria-controls="accordion-3">
            Accordion Item #3
            </button>
            </h2>
            <div id="accordion-3" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->flush(false)
                ->id('accordion')
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "<strong>This is the first item's accordion body.</strong>" .
                        ' It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-1',
                        encodeBody: false,
                        active: true
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "<strong>This is the second item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-2',
                        encodeBody: false
                    ),
                    AccordionItem::to(
                        'Accordion Item #3',
                        "<strong>This is the third item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-3',
                        encodeBody: false
                    ),
                )
                ->render(),
        );
    }

    public function testHeaderAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header test-class">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->headerAttributes(['class' => 'test-class'])
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testHeaderTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h3 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h3>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->headerTag('h3')
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="test-id" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#test-id">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('test-id')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="test-id" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#test-id">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->attributes(['id' => 'test-id'])
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->render(),
        );
    }

    public function testImmutability(): void
    {
        $accordion = Accordion::widget();

        $this->assertNotSame($accordion, $accordion->addAttributes([]));
        $this->assertNotSame($accordion, $accordion->addClass(''));
        $this->assertNotSame($accordion, $accordion->addCssStyle(''));
        $this->assertNotSame($accordion, $accordion->addTogglerAttribute('', ''));
        $this->assertNotSame($accordion, $accordion->addTogglerClass(''));
        $this->assertNotSame($accordion, $accordion->addTogglerCssStyle(''));
        $this->assertNotSame($accordion, $accordion->alwaysOpen());
        $this->assertNotSame($accordion, $accordion->attribute('', ''));
        $this->assertNotSame($accordion, $accordion->attributes([]));
        $this->assertNotSame($accordion, $accordion->bodyAttributes([]));
        $this->assertNotSame($accordion, $accordion->class(''));
        $this->assertNotSame($accordion, $accordion->collapseAttributes([]));
        $this->assertNotSame($accordion, $accordion->flush());
        $this->assertNotSame($accordion, $accordion->headerAttributes([]));
        $this->assertNotSame($accordion, $accordion->headerTag(''));
        $this->assertNotSame($accordion, $accordion->id(''));
        $this->assertNotSame($accordion, $accordion->items(AccordionItem::to('', '')));
        $this->assertNotSame($accordion, $accordion->togglerAttributes([]));
        $this->assertNotSame($accordion, $accordion->togglerTag(''));
    }

    public function testItemsWithActive(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="true" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse show" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the second item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "This is the first item's accordion body.",
                        'accordion-1'
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "This is the second item's accordion body.",
                        'accordion-2',
                        active: true
                    ),
                )
                ->render(),
        );
    }

    public function testItemsWithMultipleActive(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="true" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse show" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="true" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse show" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the second item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "This is the first item's accordion body.",
                        'accordion-1',
                        active: true
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "This is the second item's accordion body.",
                        'accordion-2',
                        active: true
                    ),
                )
                ->id('accordion')
                ->render(),
        );
    }

    public function testItemsWithEncodeHeaderAndEncodeBody(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            &lt;strong&gt;Accordion Item #1&lt;/strong&gt;
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            &lt;strong&gt;This is the first item's accordion body.&lt;/strong&gt;
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->items(
                    AccordionItem::to(
                        '<strong>Accordion Item #1</strong>',
                        "<strong>This is the first item's accordion body.</strong>",
                        'accordion-1'
                    )
                )
                ->id('accordion')
                ->render(),
        );
    }

    public function testItemsWithEncodeHeaderAndEncodeBodyWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            <strong>Accordion Item #1</strong>
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong>
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->items(
                    AccordionItem::to(
                        '<strong>Accordion Item #1</strong>',
                        "<strong>This is the first item's accordion body.</strong>",
                        'accordion-1',
                        encodeHeader: false,
                        encodeBody: false
                    )
                )
                ->id('accordion')
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/accordion/#example
     */
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="true" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse show" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="false" aria-controls="accordion-2">
            Accordion Item #2
            </button>
            </h2>
            <div id="accordion-2" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-3" aria-expanded="false" aria-controls="accordion-3">
            Accordion Item #3
            </button>
            </h2>
            <div id="accordion-3" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element.  These classes control the overall appearance, as well as the showing and hiding via CSS transitions.  You can modify any of this with custom CSS or overriding our default variables.  It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->items(
                    AccordionItem::to(
                        'Accordion Item #1',
                        "<strong>This is the first item's accordion body.</strong>" .
                        ' It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-1',
                        encodeBody: false,
                        active: true
                    ),
                    AccordionItem::to(
                        'Accordion Item #2',
                        "<strong>This is the second item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-2',
                        encodeBody: false
                    ),
                    AccordionItem::to(
                        'Accordion Item #3',
                        "<strong>This is the third item's accordion body.</strong>" .
                        ' It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. ' .
                        ' These classes control the overall appearance, as well as the showing and hiding via CSS transitions. ' .
                        ' You can modify any of this with custom CSS or overriding our default variables. ' .
                        " It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
                        'accordion-3',
                        encodeBody: false
                    ),
                )
                ->id('accordion')
                ->render(),
        );
    }

    public function testRenderWithEmptyItems(): void
    {
        $this->assertEmpty(Accordion::widget()->render());
    }

    public function testThrowExceptionForIdWithEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "id" must be specified.');

        Accordion::widget()
            ->id('')
            ->items(
                AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
            )
            ->render();
    }

    public function testThrowExceptionForIdWithFalseValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "id" must be specified.');

        Accordion::widget()
            ->id(false)
            ->items(
                AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
            )
            ->render();
    }

    public function testThrowExceptionForHeaderTagEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Header tag cannot be empty string.');

        Accordion::widget()
            ->items(
                AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
            )
            ->headerTag('')
            ->render();
    }

    public function testThrowExceptionForTogglerTagNameEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Toggler tag cannot be empty string.');

        Accordion::widget()
            ->items(
                AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
            )
            ->togglerTag('')
            ->render();
    }

    public function testTogglerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed btn-lg" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['class' => 'btn-lg'])
                ->render(),
        );
    }

    public function testTogglerAttributesWithAriaControls(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" aria-controls="custom-value" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['aria-controls' => 'custom-value'])
                ->render(),
        );
    }

    public function testTogglerAttributesWithAriaControlsWithNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['aria-controls' => null])
                ->render(),
        );
    }

    public function testTogglerAttributesWithAriaExpanded(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" aria-expanded="custom-value" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['aria-expanded' => 'custom-value'])
                ->render(),
        );
    }

    public function testTogglerAttributesWithAriaExpandedNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['aria-expanded' => null])
                ->render(),
        );
    }

    public function testTogglerAttributesWithDataBsTarget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-target="custom-value" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['data-bs-target' => 'custom-value'])
                ->render(),
        );
    }

    public function testTogglerAttributesWithDataBsTargetNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['data-bs-target' => null])
                ->render(),
        );
    }

    public function testTogglerAttributesWithDataBsToggle(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="custom-value" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['data-bs-toggle' => 'custom-value'])
                ->render(),
        );
    }

    public function testTogglerAttributesWithDataBsToggleNull(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <button type="button" class="accordion-button collapsed" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </button>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerAttributes(['data-bs-toggle' => null])
                ->render(),
        );
    }

    public function testTogglerTagName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="accordion" class="accordion">
            <div class="accordion-item">
            <h2 class="accordion-header">
            <my-custom-tag class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="false" aria-controls="accordion-1">
            Accordion Item #1
            </my-custom-tag>
            </h2>
            <div id="accordion-1" class="accordion-collapse collapse" data-bs-parent="#accordion">
            <div class="accordion-body">
            This is the first item's accordion body.
            </div>
            </div>
            </div>
            </div>
            HTML,
            Accordion::widget()
                ->id('accordion')
                ->items(
                    AccordionItem::to('Accordion Item #1', "This is the first item's accordion body.", 'accordion-1'),
                )
                ->togglerTag('my-custom-tag')
                ->render(),
        );
    }
}
