<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5;

use Generator;
use RuntimeException;
use Yiisoft\Yii\Bootstrap5\Enum\MenuType;
use Yiisoft\Yii\Bootstrap5\Enum\Size;

use function sprintf;

abstract class AbstractNav extends AbstractMenu
{
    protected ?Size $vertical = null;

    final public function items(Link|Dropdown ...$items): static
    {
        $new = clone $this;
        $new->items = $items;

        return $new;
    }

    public function activateParent(): void
    {
    }

    public function type(MenuType $type): static
    {
        $new = clone $this;
        $new->type = $type;

        return $new;
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#tabs
     */
    public function tabs(): static
    {
        return $this->type(MenuType::Tabs);
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#pills
     */
    public function pills(): static
    {
        return $this->type(MenuType::Pills);
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#underline
     */
    public function underline(): static
    {
        return $this->type(MenuType::Underline);
    }

    /**
     * @link https://getbootstrap.com/docs/5.3/components/navs-tabs/#vertical
     */
    public function vertical(?Size $vertical): static
    {
        $new = clone $this;
        $new->vertical = $vertical;

        return $new;
    }

    final protected function getVisibleItems(): Generator
    {
        $index = 0;

        /** @var Link|Dropdown $item */
        foreach ($this->items as $item) {
            /** @var Link|null $link */
            $link = $item instanceof Dropdown ? $item->getToggle() : $item;

            if ($link === null) {
                throw new RuntimeException(
                    sprintf(
                        'Every "%s" $item must contains a "toggle" property.',
                        Dropdown::class
                    )
                );
            }

            if ($link->isVisible()) {
                yield $index++ => $item;
            }
        }
    }

    /**
     * @param Link|Dropdown $item
     */
    protected function renderItem(mixed $item, int $index): string
    {
        if ($item instanceof Dropdown) {
            /** @psalm-suppress PossiblyNullArgument */
            return $item->toggle(
                $this->prepareLink($item->getToggle(), $index),
            )
            ->setParent($this)
            ->render();
        }

        $link = $this->prepareLink($item, $index);

        return ($link->getItem()?->widgetClassName($this->type->itemClassName()) ?? $link)->render();
    }
}
