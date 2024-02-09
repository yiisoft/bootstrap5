<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use Yiisoft\Yii\Bootstrap5\Button;
use Yiisoft\Yii\Bootstrap5\ButtonGroup;

/**
 * Tests for Button widget.
 *
 * ButtonGroupTest
 */
final class ButtonGroupTest extends TestCase
{
    public function testRender(): void
    {
        $html = ButtonGroup::widget()
            ->buttons([
                ['label' => 'button-A'],
                ['label' => 'button-B', 'visible' => true],
                ['label' => 'button-C', 'visible' => false],
                Button::widget()
                    ->label('button-D')
                    ->render(),
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-button-group" class="btn-group" role="group"><button type="button" id="w2-button" class="btn">button-A</button>
        <button type="button" id="w3-button" class="btn">button-B</button>
        <button id="w0-button" class="btn">button-D</button></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonOptions(): void
    {
        $html = ButtonGroup::widget()
            ->buttons([
                ['label' => 'button-A', 'options' => ['class' => 'btn-primary', 'type' => 'submit']],
                ['label' => 'button-B'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-button-group" class="btn-group" role="group"><button type="submit" id="w1-button" class="btn-primary btn">button-A</button>
        <button type="button" id="w2-button" class="btn">button-B</button></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeLabes(): void
    {
        $html = ButtonGroup::widget()
            ->buttons([
                ['label' => 'button-A', 'options' => ['class' => 'btn-primary', 'type' => 'submit']],
                ['label' => '<span><i class=fas fas-test></i>button-B</span>'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-button-group" class="btn-group" role="group"><button type="submit" id="w1-button" class="btn-primary btn">button-A</button>
        <button type="button" id="w2-button" class="btn">&lt;span&gt;&lt;i class=fas fas-test&gt;&lt;/i&gt;button-B&lt;/span&gt;</button></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        $html = ButtonGroup::widget()
            ->buttons([
                ['label' => 'button-A', 'options' => ['class' => 'btn-primary', 'type' => 'submit']],
                ['label' => '<span><i class=fas fas-test></i>button-B</span>'],
            ])
            ->withoutEncodeLabels()
            ->render();
        $expected = <<<'HTML'
        <div id="w3-button-group" class="btn-group" role="group"><button type="submit" id="w4-button" class="btn-primary btn">button-A</button>
        <button type="button" id="w5-button" class="btn"><span><i class=fas fas-test></i>button-B</span></button></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testOptions(): void
    {
        $html = ButtonGroup::widget()
            ->buttons([
                ['label' => 'button-A', 'options' => ['class' => 'btn-primary', 'type' => 'submit']],
                ['label' => 'button-B'],
            ])
            ->options(['class' => 'btn-lg'])
            ->render();
        $expected = <<<'HTML'
        <div id="w0-button-group" class="btn-lg btn-group" role="group"><button type="submit" id="w1-button" class="btn-primary btn">button-A</button>
        <button type="button" id="w2-button" class="btn">button-B</button></div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
