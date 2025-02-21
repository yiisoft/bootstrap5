<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Yii\Bootstrap5\Button;
use Yiisoft\Yii\Bootstrap5\ButtonSize;
use Yiisoft\Yii\Bootstrap5\ButtonType;
use Yiisoft\Yii\Bootstrap5\ButtonVariant;
use Yiisoft\Yii\Bootstrap5\Tests\Provider\ButtonProvider;
use Yiisoft\Yii\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Yii\Bootstrap5\Utility\BackgroundColor;
use Yiisoft\Yii\Bootstrap5\Utility\TogglerType;

/**
 * Tests for `Button` widget
 */
#[Group('button')]
final class ButtonTest extends TestCase
{
    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" data-id="123"></button>
            HTML,
            Button::widget()->addAttributes(['data-id' => '123'])->id(false)->render(),
        );
    }

    public function testAddClass(): void
    {
        $buttonWidget = Button::widget()->addClass('test-class', null, BackgroundColor::PRIMARY)->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary test-class bg-primary"></button>
            HTML,
            $buttonWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary test-class bg-primary test-class-1 test-class-2"></button>
            HTML,
            $buttonWidget->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddCssStyle(): void
    {
        $buttonWidget = Button::widget()->addCssStyle('color: red;')->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" style="color: red;"></button>
            HTML,
            $buttonWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" style="color: red; font-weight: bold;"></button>
            HTML,
            $buttonWidget->addCssStyle('font-weight: bold;')->render(),
        );
    }

    public function testAddCssStyleWithOverwriteFalse(): void
    {
        $buttonWidget = Button::widget()->addCssStyle('color: red;')->id(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" style="color: red;"></button>
            HTML,
            $buttonWidget->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" style="color: red;"></button>
            HTML,
            $buttonWidget->addCssStyle('color: blue;', false)->render(),
        );
    }

    public function testAriaExpanded(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" aria-expanded="true"></button>
            HTML,
            Button::widget()->ariaExpanded()->id(false)->render(),
        );
    }

    public function testAriaExpandedWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" aria-expanded="false"></button>
            HTML,
            Button::widget()->ariaExpanded(false)->id(false)->render(),
        );
    }

    public function testAttribute(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" data-id="123"></button>
            HTML,
            Button::widget()->attribute('data-id', '123')->id(false)->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary test-class"></button>
            HTML,
            Button::widget()->attributes(['class' => 'test-class'])->id(false)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#block-buttons
     */
    public function testBlock(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="d-grid gap-2">
            <button type="button" class="btn btn-primary">Button</button>
            <button type="button" class="btn btn-primary">Button</button>
            </div>
            HTML,
            Div::tag()
                ->class('d-grid gap-2')
                ->content(
                    PHP_EOL,
                    Button::widget()->label('Button')->id(false)->variant(ButtonVariant::PRIMARY),
                    PHP_EOL,
                    Button::widget()->label('Button')->id(false)->variant(ButtonVariant::PRIMARY),
                    PHP_EOL,
                )
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary custom-class another-class bg-primary"></button>
            HTML,
            Button::widget()
                ->addClass('test-class')
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->id(false)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#disabled-state
     */
    public function testDisableState(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary" disabled>Primary button</button>
            HTML,
            Button::widget()->disabled()->id(false)->label('Primary button')->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" disabled>Button</button>
            HTML,
            Button::widget()->disabled()->id(false)->label('Button')->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-outline-primary" disabled>Primary button</button>
            HTML,
            Button::widget()
                ->disabled()
                ->id(false)
                ->label('Primary button')
                ->variant(ButtonVariant::OUTLINE_PRIMARY)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-outline-secondary" disabled>Button</button>
            HTML,
            Button::widget()
                ->disabled()
                ->id(false)
                ->label('Button')
                ->variant(ButtonVariant::OUTLINE_SECONDARY)
                ->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" id="test" class="btn btn-secondary"></button>
            HTML,
            Button::widget()->id('test')->render(),
        );
    }

    public function testIdWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary"></button>
            HTML,
            Button::widget()->id('')->render(),
        );
    }

    public function testIdWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary"></button>
            HTML,
            Button::widget()->id(false)->render(),
        );
    }

    public function testIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" id="test" class="btn btn-secondary"></button>
            HTML,
            Button::widget()->attributes(['id' => 'test'])->render(),
        );
    }

    public function testImmutability(): void
    {
        $button = Button::widget();

        $this->assertNotSame($button, $button->active());
        $this->assertNotSame($button, $button->addAttributes([]));
        $this->assertNotSame($button, $button->addClass(''));
        $this->assertNotSame($button, $button->addCssStyle(''));
        $this->assertNotSame($button, $button->ariaExpanded());
        $this->assertNotSame($button, $button->attribute('', ''));
        $this->assertNotSame($button, $button->attributes([]));
        $this->assertNotSame($button, $button->disabled());
        $this->assertNotSame($button, $button->disableTextWrapping());
        $this->assertNotSame($button, $button->id(false));
        $this->assertNotSame($button, $button->label('', false));
        $this->assertNotSame($button, $button->size(ButtonSize::LARGE));
        $this->assertNotSame($button, $button->toggle(TogglerType::BUTTON));
        $this->assertNotSame($button, $button->type(ButtonType::LINK));
        $this->assertNotSame($button, $button->url(''));
        $this->assertNotSame($button, $button->variant(ButtonVariant::PRIMARY));
    }

    public function testLabelWithEncodeFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary"><Label></button>
            HTML,
            Button::widget()->label('<Label>', false)->id(false)->render(),
        );
    }

    public function testLabelWithEncodeTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary">&lt;Label&gt;</button>
            HTML,
            Button::widget()->label('<Label>')->id(false)->render(),
        );
    }

    public function testLabelWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary"><span>Stringable</span></button>
            HTML,
            Button::widget()->label(Span::tag()->content('Stringable'), false)->id(false)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#sizes
     */
    public function testLargeSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary btn-lg">Large button</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Large button')
                ->size(ButtonSize::LARGE)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary btn-lg">Large button</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Large button')
                ->size(ButtonSize::LARGE)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#sizes
     */
    public function testNormalSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary">Label</button>
            HTML,
            Button::widget()->label('Label')->id(false)->size(null)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#base-class
     */
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn">Base class</button>
            HTML,
            Button::widget()->label('Base class')->id(false)->variant(null)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#sizes
     */
    public function testSmallSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary btn-sm">Small button</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Small button')
                ->size(ButtonSize::SMALL)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary btn-sm">Small button</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Small button')
                ->size(ButtonSize::SMALL)
                ->variant(ButtonVariant::SECONDARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTagButtonReset(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="reset" class="btn btn-primary">Reset</button>
            HTML,
            Button::reset()->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="reset" class="btn btn-primary">Clear</button>
            HTML,
            Button::reset('Clear')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTagButtonSubmit(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="submit" class="btn btn-primary">Submit</button>
            HTML,
            Button::submit()->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="submit" class="btn btn-primary">Send</button>
            HTML,
            Button::submit('Send')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTagLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary" href="#" role="button">Label</a>
            HTML,
            Button::link('Label', '#')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary" href="/test" role="button">Label</a>
            HTML,
            Button::link('Label', '/test')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTagInputReset(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="reset" class="btn btn-primary" value="Reset">
            HTML,
            Button::resetInput()->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <input type="reset" class="btn btn-primary" value="Clear">
            HTML,
            Button::resetInput('Clear')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTagInputSubmit(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="submit" class="btn btn-primary" value="Submit">
            HTML,
            Button::submitInput()->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <input type="submit" class="btn btn-primary" value="Send">
            HTML,
            Button::submitInput('Send')->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#toggle-states
     */
    public function testToggleState(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" data-bs-toggle="button">Toggle button</button>
            HTML,
            Button::widget()->toggle()->id(false)->label('Toggle button')->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary active" data-bs-toggle="button" aria-pressed="true">Active toggle button</button>
            HTML,
            Button::widget()->active()->label('Active toggle button')->id(false)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-secondary" disabled data-bs-toggle="button">Disabled toggle button</button>
            HTML,
            Button::widget()->disabled()->id(false)->label('Disabled toggle button')->toggle()->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#toggle-states
     */
    public function testToggleStateWithVariant(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary" data-bs-toggle="button">Toggle button</button>
            HTML,
            Button::widget()->toggle()->id(false)->label('Toggle button')->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary active" data-bs-toggle="button" aria-pressed="true">Active toggle button</button>
            HTML,
            Button::widget()
                ->active()
                ->label('Active toggle button')
                ->id(false)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <button type="button" class="btn btn-primary" disabled data-bs-toggle="button">Disabled toggle button</button>
            HTML,
            Button::widget()
                ->disabled()
                ->id(false)
                ->label('Disabled toggle button')
                ->variant(ButtonVariant::PRIMARY)
                ->toggle()
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#toggle-states
     */
    public function testToggleStateLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-secondary" href="#" data-bs-toggle="button" role="button">Toggle link</a>
            HTML,
            Button::link('Toggle link', '#')->id(false)->toggle()->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-secondary active" href="#" data-bs-toggle="button" aria-pressed="true" role="button">Active toggle link</a>
            HTML,
            Button::link('Active toggle link', '#')->active()->id(false)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-secondary disabled" href="#" data-bs-toggle="button" aria-disabled="true" role="button">Disabled toggle link</a>
            HTML,
            Button::link('Disabled toggle link', '#')->disabled()->id(false)->toggle()->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#toggle-states
     */
    public function testToggleStateLinkAndVariant(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary" href="#" data-bs-toggle="button" role="button">Toggle link</a>
            HTML,
            Button::link('Toggle link', '#')->id(false)->toggle()->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary active" href="#" data-bs-toggle="button" aria-pressed="true" role="button">Active toggle link</a>
            HTML,
            Button::link('Active toggle link', '#')->active()->id(false)->variant(ButtonVariant::PRIMARY)->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary disabled" href="#" data-bs-toggle="button" aria-disabled="true" role="button">Disabled toggle link</a>
            HTML,
            Button::link('Disabled toggle link', '#')
                ->disabled()
                ->id(false)
                ->variant(ButtonVariant::PRIMARY)
                ->toggle()
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTypeButtonReset(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="reset" class="btn btn-primary">Clear</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Clear')
                ->type(ButtonType::RESET)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTypeButtonSubmit(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <button type="submit" class="btn btn-primary">Send</button>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Send')
                ->type(ButtonType::SUBMIT)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTypeLink(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <a class="btn btn-primary" href="/test" role="button">Label</a>
            HTML,
            Button::widget()
                ->id(false)
                ->label('Label')
                ->type(ButtonType::LINK)
                ->url('/test')
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTypeInputReset(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="reset" class="btn btn-primary" value="Clear">
            HTML,
            Button::widget()
                ->id(false)
                ->label('Clear')
                ->type(ButtonType::RESET_INPUT)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#button-tags
     */
    public function testTypeInputSubmit(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="submit" class="btn btn-primary" value="Send">
            HTML,
            Button::widget()
                ->id(false)
                ->label('Send')
                ->type(ButtonType::SUBMIT_INPUT)
                ->variant(ButtonVariant::PRIMARY)
                ->render(),
        );
    }

    /**
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#examples
     * @see https://getbootstrap.com/docs/5.3/components/buttons/#outline-buttons
     */
    #[DataProviderExternal(ButtonProvider::class, 'variant')]
    public function testVariant(ButtonVariant|null $buttonVariant, string $expected): void
    {
        $variant = $buttonVariant->value ?? 'button';

        Assert::equalsWithoutLE(
            $expected,
            Button::widget()
                ->label('A simple ' . $variant . ' check it out!')
                ->id(false)
                ->variant($buttonVariant)
                ->render(),
        );
    }
}
