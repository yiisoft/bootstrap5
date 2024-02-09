<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use Yiisoft\Yii\Bootstrap5\Toast;

/**
 * Tests for `Toast` widget.
 */
final class ToastTest extends TestCase
{
    public function testBodyOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->bodyOptions(['class' => 'toast-body test', 'style' => ['text-align' => 'center']])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <strong class="me-auto"></strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body test" style="text-align: center;">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    /**
     * @depends testBodyOptions
     */
    public function testContainerOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->dateTime('a minute ago')
            ->title('Toast title')
            ->begin();
        $html .= 'Woohoo, you\'re reading this text in a toast!';
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <strong class="me-auto">Toast title</strong>
        <small>a minute ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">Woohoo, you're reading this text in a toast!
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    public function testDateTimeOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->title('Toast title')
            ->dateTime('a minute ago')
            ->dateTimeOptions([
                'class' => ['toast-date-time'],
                'style' => ['text-align' => 'right'],
            ])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <strong class="me-auto">Toast title</strong>
        <small class="toast-date-time" style="text-align: right;">a minute ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    public function testTitleOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->title('Toast title')
            ->titleOptions([
                'tag' => 'h5',
                'style' => ['text-align' => 'left'],
            ])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <h5 class="me-auto" style="text-align: left;">Toast title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    public function testCloseButton(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->withCloseButtonOptions(['class' => 'btn-lg'])
            ->title('Toast title')
            ->headerOptions(['class' => 'text-dark'])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="text-dark toast-header">
        <strong class="me-auto">Toast title</strong>
        <button type="button" class="btn-lg btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    public function testHeaderOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->title('Toast title')
            ->titleOptions([
                'tag' => 'h5',
                'style' => ['text-align' => 'left'],
            ])
            ->headerOptions(['class' => 'text-dark'])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="text-dark toast-header">
        <h5 class="me-auto" style="text-align: left;">Toast title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }

    public function testOptions(): void
    {
        $html = Toast::widget()
            ->id('test')
            ->title('Toast title')
            ->titleOptions([
                'tag' => 'h5',
                'style' => ['text-align' => 'left'],
            ])
            ->options(['class' => 'text-danger'])
            ->begin();
        $html .= Toast::end();

        $expected = <<<'HTML'
        <div id="test" class="text-danger toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <h5 class="me-auto" style="text-align: left;">Toast title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div></div>
        HTML;

        $this->assertSame($expected, $html);
    }
}
