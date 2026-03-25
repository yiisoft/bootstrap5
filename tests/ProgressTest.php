<?php

declare(strict_types=1);

namespace Yiisoft\Bootstrap5\Tests;

use LogicException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Bootstrap5\Progress;
use Yiisoft\Bootstrap5\ProgressVariant;
use Yiisoft\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Bootstrap5\Utility\BackgroundColor;
use Yiisoft\Bootstrap5\Utility\Sizing;

/**
 * Tests for `Progress` widget.
 */
#[Group('progress')]
final class ProgressTest extends TestCase
{
    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-id="123" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->addAttributes(['data-id' => '123'])->id(false)->render(),
        );
    }

    public function testAddClass(): void
    {
        $progress = Progress::widget()->addClass('test-class', null, BackgroundColor::PRIMARY)->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress test-class bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress test-class bg-primary test-class-1 test-class-2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddCssStyle(): void
    {
        $progress = Progress::widget()->addCssStyle('color: red;')->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red; font-weight: bold;" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->addCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $progress = Progress::widget()->addCssStyle('color: red;')->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div style="color: red;" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            $progress->addCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-id="123" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->attribute('data-id', '123')->id(false)->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress test-class" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->attributes(['class' => 'test-class'])->id(false)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#animated-stripes
     */
    public function testAnimatedStripe(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Animated striped example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 75%" class="progress-bar progress-bar-striped progress-bar-animated"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Animated striped example')
                ->id('progress')
                ->percent(75)
                ->variant(ProgressVariant::ANIMATED_STRIPED)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#backgrounds
     */
    public function testBackgrounds(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Success example" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 25%" class="progress-bar bg-success"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Success example')
                ->backgroundColor(BackgroundColor::SUCCESS)
                ->id('progress')
                ->percent(25)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Success example" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 25%" class="progress-bar bg-success">
            25%
            </div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Success example')
                ->backgroundColor(BackgroundColor::SUCCESS)
                ->content('25%')
                ->id('progress')
                ->percent(25)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#backgrounds
     */
    public function testBackgroundsWithDanger(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Danger example" class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 100%" class="progress-bar bg-danger"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Danger example')
                ->backgroundColor(BackgroundColor::DANGER)
                ->id('progress')
                ->percent(100)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Danger example" class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 100%" class="progress-bar bg-danger">
            100%
            </div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Danger example')
                ->backgroundColor(BackgroundColor::DANGER)
                ->content('100%')
                ->id('progress')
                ->percent(100)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#backgrounds
     */
    public function testBackgroundsWithInfo(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Info example" class="progress" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 50%" class="progress-bar bg-info"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Info example')
                ->backgroundColor(BackgroundColor::INFO)
                ->id('progress')
                ->percent(50)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Info example" class="progress" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 50%" class="progress-bar bg-info">
            50%
            </div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Info example')
                ->backgroundColor(BackgroundColor::INFO)
                ->content('50%')
                ->id('progress')
                ->percent(50)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#backgrounds
     */
    public function testBackgroundsWithWarning(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Warning example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 75%" class="progress-bar bg-warning"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Warning example')
                ->backgroundColor(BackgroundColor::WARNING)
                ->id('progress')
                ->percent(75)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Warning example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 75%" class="progress-bar bg-warning">
            75%
            </div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Warning example')
                ->backgroundColor(BackgroundColor::WARNING)
                ->content('75%')
                ->id('progress')
                ->percent(75)
                ->render(),
        );
    }

    public function testBarAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar test-class"></div>
            </div>
            HTML,
            Progress::widget()->barAttributes(['class' => 'test-class'])->id(false)->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress custom-class another-class bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()
                ->addClass('test-class')
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->id(false)
                ->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="test-id">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->id('test-id')->render(),
        );
    }

    public function testIdWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->id('')->render(),
        );
    }

    public function testIdWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->id(false)->render(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="test-id" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->attributes(['id' => 'test-id'])->render(),
        );
    }

    public function testImmutability(): void
    {
        $progress = Progress::widget();

        $this->assertNotSame($progress, $progress->addAttributes([]));
        $this->assertNotSame($progress, $progress->addClass(''));
        $this->assertNotSame($progress, $progress->addCssStyle(''));
        $this->assertNotSame($progress, $progress->attribute('', ''));
        $this->assertNotSame($progress, $progress->attributes([]));
        $this->assertNotSame($progress, $progress->backgroundColor(BackgroundColor::PRIMARY));
        $this->assertNotSame($progress, $progress->barAttributes([]));
        $this->assertNotSame($progress, $progress->class(''));
        $this->assertNotSame($progress, $progress->content(''));
        $this->assertNotSame($progress, $progress->id(''));
        $this->assertNotSame($progress, $progress->max(0));
        $this->assertNotSame($progress, $progress->min(0));
        $this->assertNotSame($progress, $progress->percent(0));
        $this->assertNotSame($progress, $progress->sizing(Sizing::WIDTH_75));
        $this->assertNotSame($progress, $progress->stacked());
        $this->assertNotSame($progress, $progress->variant(ProgressVariant::ANIMATED_STRIPED));
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#labels
     */
    public function testLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Example with label" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 25%" class="progress-bar">
            25%
            </div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Example with label')->content('25%')->id('progress')->percent(25)->render(),
        );
    }

    public function testMax(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="50">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->id(false)->max(50)->render(),
        );
    }

    public function testMin(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="10" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->id(false)->min(10)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#how-it-works
     */
    public function testPercent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 0%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Basic example')->id(false)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#how-it-works
     */
    public function testPercentWith25(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 25%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Basic example')->id(false)->percent(25)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#how-it-works
     */
    public function testPercentWith50(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 50%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Basic example')->id(false)->percent(50)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#how-it-works
     */
    public function testPercentWith75(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 75%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Basic example')->id(false)->percent(75)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#how-it-works
     */
    public function testPercentWith100(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
            <div style="width: 100%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()->ariaLabel('Basic example')->id(false)->percent(100)->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#height
     */
    public function testSizingWithHeight(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Example 20px high" style="height: 20px" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 25%" class="progress-bar"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Example 20px high')
                ->addCssStyle('height: 20px')
                ->id('progress')
                ->percent(25)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#width
     */
    public function testSizingWithWidth(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Basic example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div class="progress-bar w-75"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Basic example')
                ->id('progress')
                ->percent(75)
                ->sizing(Sizing::WIDTH_75)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/progress/#striped
     */
    public function testStripe(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Default striped example" class="progress" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 10%" class="progress-bar progress-bar-striped"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Default striped example')
                ->id('progress')
                ->percent(10)
                ->variant(ProgressVariant::STRIPED)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Success striped example" class="progress" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 25%" class="progress-bar bg-success progress-bar-striped"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Success striped example')
                ->backgroundColor(BackgroundColor::SUCCESS)
                ->id('progress')
                ->percent(25)
                ->variant(ProgressVariant::STRIPED)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Info striped example" class="progress" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 50%" class="progress-bar bg-info progress-bar-striped"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Info striped example')
                ->backgroundColor(BackgroundColor::INFO)
                ->id('progress')
                ->percent(50)
                ->variant(ProgressVariant::STRIPED)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Warning striped example" class="progress" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 75%" class="progress-bar bg-warning progress-bar-striped"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Warning striped example')
                ->backgroundColor(BackgroundColor::WARNING)
                ->id('progress')
                ->percent(75)
                ->variant(ProgressVariant::STRIPED)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div aria-label="Danger striped example" class="progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="progress">
            <div style="width: 100%" class="progress-bar bg-danger progress-bar-striped"></div>
            </div>
            HTML,
            Progress::widget()
                ->ariaLabel('Danger striped example')
                ->backgroundColor(BackgroundColor::DANGER)
                ->id('progress')
                ->percent(100)
                ->variant(ProgressVariant::STRIPED)
                ->render(),
        );
    }

    public function testThrowExceptionForPercentLessThanZero(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('"$percent" must be positive. -1 given');

        Progress::widget()->percent(-1);
    }
}
