<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Bootstrap5\Progress;
use Yiisoft\Bootstrap5\ProgressStack;
use Yiisoft\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;

/**
 * Tests for `ProgressStack` widget.
 */
#[Group('progress')]
final class ProgressStackTest extends TestCase
{
    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-id="123" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()
                ->addAttributes(['data-id' => '123'])
                ->bars(Progress::widget()->id(false))
                ->id(false)
                ->render(),
        );
    }

    public function testAddClass(): void
    {
        $progressStack = ProgressStack::widget()
            ->addClass('test-class', null, BackgroundColor::PRIMARY)
            ->bars(Progress::widget()->id(false))
            ->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked test-class bg-primary">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked test-class bg-primary test-class-1 test-class-2">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddCssStyle(): void
    {
        $progressStack = ProgressStack::widget()
            ->addCssStyle('color: red;')
            ->bars(Progress::widget()->id(false))
            ->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red; font-weight: bold;" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->addCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $progressStack = ProgressStack::widget()
            ->addCssStyle('color: red;')
            ->bars(Progress::widget()->id(false))
            ->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            $progressStack->addCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-id="123" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()
                ->attribute('data-id', '123')
                ->bars(Progress::widget()->id(false))
                ->id(false)
                ->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked test-class">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()
                ->attributes(['class' => 'test-class'])
                ->bars(Progress::widget()->id(false))
                ->id(false)
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked custom-class another-class bg-primary">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()
                ->addClass('test-class')
                ->bars(Progress::widget()->id(false))
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->id(false)
                ->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked" id="test-id">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()->bars(Progress::widget()->id(false))->id('test-id')->render(),
        );
    }

    public function testIdWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()->bars(Progress::widget()->id(false))->id('')->render(),
        );
    }

    public function testIdWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()->bars(Progress::widget()->id(false))->id(false)->render(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="test-id" class="progress-stacked">
            <div style="width: 0%" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()->attributes(['id' => 'test-id'])->bars(Progress::widget()->id(false))->render(),
        );
    }

    public function testImmutability(): void
    {
        $progressStack = ProgressStack::widget();

        $this->assertNotSame($progressStack, $progressStack->addAttributes([]));
        $this->assertNotSame($progressStack, $progressStack->addClass());
        $this->assertNotSame($progressStack, $progressStack->addCssStyle(''));
        $this->assertNotSame($progressStack, $progressStack->attribute('', ''));
        $this->assertNotSame($progressStack, $progressStack->attributes([]));
        $this->assertNotSame($progressStack, $progressStack->bars());
        $this->assertNotSame($progressStack, $progressStack->class());
        $this->assertNotSame($progressStack, $progressStack->id(false));
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#multiple-bars
     */
    public function testMultiple(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress-stacked">
            <div aria-label="Segment one" style="width: 15%" class="progress" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" id="segment-one">
            <div class="progress-bar"></div>
            </div>
            <div aria-label="Segment two" style="width: 30%" class="progress" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" id="segment-two">
            <div class="progress-bar bg-success"></div>
            </div>
            <div aria-label="Segment three" style="width: 20%" class="progress" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" id="segment-three">
            <div class="progress-bar bg-info"></div>
            </div>
            </div>
            HTML,
            ProgressStack::widget()
                ->bars(
                    Progress::widget()
                        ->ariaLabel('Segment one')
                        ->id('segment-one')
                        ->percent(15),
                    Progress::widget()
                        ->ariaLabel('Segment two')
                        ->backGroundColor(BackgroundColor::SUCCESS)
                        ->id('segment-two')
                        ->percent(30),
                    Progress::widget()
                        ->ariaLabel('Segment three')
                        ->backGroundColor(BackgroundColor::INFO)
                        ->id('segment-three')
                        ->percent(20),
                )
                ->id(false)
                ->render(),
        );
    }

    public function testRenderWithEmptyBars(): void
    {
        $this->assertEmpty(ProgressStack::widget()->bars()->id(false)->render());
    }
}
