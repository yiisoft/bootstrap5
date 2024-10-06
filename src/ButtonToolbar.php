<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use Stringable;
use Yiisoft\Html\Tag\Base\Tag;
use Yiisoft\Yii\Bootstrap5\Enum\MenuType;

/**
 * ButtonToolbar Combines sets of button groups into button toolbars for more complex components.
 * Use utility classes as needed to space out groups, buttons, and more.
 *
 * For example,
 *
 * ```php
 * // a button toolbar with items configuration
 * echo ButtonToolbar::widget()
 *     ->items([
 *         ButtonGroup::widget()
                ->options([
                    'aria-label' => 'First group',
                    'class' => ['mr-2'],
                ])
                ->items(
                    Link::widget()->options(['class' => 'btn'])->id('BTN1')->label('1'),
                    Link::widget()->options(['class' => 'btn'])->id('BTN2')->label('2'),
                    Link::widget()->options(['class' => 'btn'])->id('BTN3')->label('3'),
                    Link::widget()->options(['class' => 'btn'])->id('BTN4')->label('4'),
                ),
            ButtonGroup::widget()
                ->options([
                    'aria-label' => 'Second group',
                ])
                ->items(
                    Link::widget()->options(['class' => 'btn'])->id('BTN5')->label('5'),
                    Link::widget()->options(['class' => 'btn'])->id('BTN6')->label('6'),
                    Link::widget()->options(['class' => 'btn'])->id('BTN7')->label('7'),
                ),
 *     ]);
 * ```
 *
 * Pressing on the button should be handled via JavaScript. See the following for details:
 */
final class ButtonToolbar extends AbstractMenu
{
    protected string $tag = 'div';
    protected MenuType $type = MenuType::BtnToolbar;

    public function items(string|Stringable ...$items): self
    {
        $new = clone $this;
        $new->items = $items;

        return $new;
    }

    protected function getVisibleItems(): array
    {
        return $this->items;
    }

    public function activateParent(): void
    {
    }

    protected function prepareMenu(): Tag
    {
        return parent::prepareMenu()->attribute('role', 'toolbar');
    }

    protected function renderItem(mixed $item, int $index): string
    {
        return match (true) {
            $item instanceof AbstractMenu => $item->setParent($this)->render(),

            default => (string)$item
        };
    }
}
