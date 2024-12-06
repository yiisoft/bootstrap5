<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use InvalidArgumentException;
use RuntimeException;
use Yiisoft\Yii\Bootstrap5\Link;
use Yiisoft\Yii\Bootstrap5\Breadcrumbs;
use Yiisoft\Yii\Bootstrap5\Tests\Support\Assert;
use Yiisoft\Yii\Bootstrap5\Utility\BackgroundColor;

/**
 * Tests for `Breadcrumbs` widget
 *
 * @group breadcrumb
 */
final class BreadcrumbsTest extends \PHPUnit\Framework\TestCase
{
    public function testActive(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="Basic example of breadcrumbs">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Library</a></li>
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->ariaLabel('Basic example of breadcrumbs')
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#', active: true),
                    new Link('Data', '#'),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testActiveWithException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Only one "link" can be active.');

        Breadcrumbs::widget()
            ->ariaLabel('Basic example of breadcrumbs')
            ->links(
                new Link('Home', '/'),
                new Link('Library', '#', active: true),
                new Link('Data', '#', active: true),
            )
            ->listId(false)
            ->render();
    }

    public function testAddCssClass(): void
    {
        $alert = Breadcrumbs::widget()
            ->ariaLabel('Basic example of breadcrumbs')
            ->addClass('test-class', null, BackgroundColor::PRIMARY)
            ->links(
                new Link('Home', '/'),
                new Link('Library', '#', active: true),
                new Link('Data', '#'),
            )
            ->listId(false);

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="test-class bg-primary" aria-label="Basic example of breadcrumbs">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Library</a></li>
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            </ol>
            </nav>
            HTML,
            $alert->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="test-class bg-primary test-class-1 test-class-2" aria-label="Basic example of breadcrumbs">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Library</a></li>
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            </ol>
            </nav>
            HTML,
            $alert->addClass('test-class-1', 'test-class-2')->render(),
        );
    }

    public function testAddAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="test-class-definition" data-test="test" aria-label="Basic example of breadcrumbs">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget(config: ['attributes()' => [['class' => 'test-class-definition']]])
                ->addAttributes(['data-test' => 'test'])
                ->ariaLabel('Basic example of breadcrumbs')
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testAriaLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="Basic example of breadcrumbs">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->ariaLabel('Basic example of breadcrumbs')
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="test-class" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->attributes(['class' => 'test-class'])
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav class="custom-class another-class bg-primary" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->addClass('test-class')
                ->class('custom-class', 'another-class', BackgroundColor::PRIMARY)
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    /**
     * @link https://getbootstrap.com/docs/5.2/components/breadcrumb/#dividers
     */
    public function testDivider(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav style="--bs-breadcrumb-divider: &apos;&gt;&apos;;" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->divider('>')
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testDividerWithEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "divider" cannot be empty.');

        Breadcrumbs::widget()->divider('');
    }

    public function testImmutability(): void
    {
        $breacrumb = Breadcrumbs::widget();

        $this->assertNotSame($breacrumb, $breacrumb->addAttributes([]));
        $this->assertNotSame($breacrumb, $breacrumb->addClass(''));
        $this->assertNotSame($breacrumb, $breacrumb->ariaLabel(''));
        $this->assertNotSame($breacrumb, $breacrumb->attributes([]));
        $this->assertNotSame($breacrumb, $breacrumb->class(''));
        $this->assertNotSame($breacrumb, $breacrumb->divider('>'));
        $this->assertNotSame($breacrumb, $breacrumb->itemActiveClass(''));
        $this->assertNotSame($breacrumb, $breacrumb->itemAttributes([]));
        $this->assertNotSame($breacrumb, $breacrumb->linkAttributes([]));
        $this->assertNotSame($breacrumb, $breacrumb->links(new Link()));
        $this->assertNotSame($breacrumb, $breacrumb->listAttributes([]));
        $this->assertNotSame($breacrumb, $breacrumb->listId(''));
        $this->assertNotSame($breacrumb, $breacrumb->listTagName(''));
    }

    public function testItemActiveClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item test-active-class" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->itemActiveClass('test-active-class')
                ->listId(false)
                ->render(),
        );
    }

    public function testItemAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item test-item-class"><a href="/">Home</a></li>
            <li class="breadcrumb-item test-item-class"><a href="#">Library</a></li>
            <li class="breadcrumb-item test-item-class active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->itemAttributes(['class' => 'test-item-class'])
                ->listId(false)
                ->render(),
        );
    }

    public function testLinkAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="test-link-class" href="/">Home</a></li>
            <li class="breadcrumb-item"><a class="test-link-class" href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->linkAttributes(['class' => 'test-link-class'])
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testLinksWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="test-link-class" href="/" data-test="test">Home</a></li>
            <li class="breadcrumb-item"><a class="test-link-class" href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->linkAttributes(['class' => 'test-link-class'])
                ->links(
                    new Link('Home', '/', attributes: ['data-test' => 'test']),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testListAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb test-list-class">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listAttributes(['class' => 'test-list-class'])
                ->listId(false)
                ->render(),
        );
    }

    public function testListId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol id="test-id" class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId('test-id')
                ->render(),
        );
    }

    public function testListIdWithEmpty(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId('')
                ->render(),
        );
    }

    public function testListIdWithFalse(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }

    public function testListIdWithSetAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol id="test-id" class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listAttributes(['id' => 'test-id'])
                ->render(),
        );
    }

    public function testListTagName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <footer class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </footer>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '/'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->listTagName('footer')
                ->render(),
        );
    }

    public function testListTagNameWithException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('List tag cannot be empty.');

        Breadcrumbs::widget()
            ->links(
                new Link('Home', '/'),
                new Link('Library', '#'),
                new Link('Data', active: true),
            )
            ->listTagName('')
            ->render();
    }

    public function testLinksWithEmpty(): void
    {
        $this->assertEmpty(Breadcrumbs::widget()->render());
    }

    /**
     * @link https://getbootstrap.com/docs/5.2/components/breadcrumb/#example
     */
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>
            HTML,
            Breadcrumbs::widget()
                ->links(
                    new Link('Home', '#'),
                    new Link('Library', '#'),
                    new Link('Data', active: true),
                )
                ->listId(false)
                ->render(),
        );
    }
}
