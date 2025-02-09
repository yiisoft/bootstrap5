<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;
use Yiisoft\Widget\WidgetFactory;

use function str_replace;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = new Container(ContainerConfig::create());

        WidgetFactory::initialize($this->container);
    }

    protected function tearDown(): void
    {
        unset($this->container);

        parent::tearDown();
    }

    private function loadHtml(string $html): string
    {
        $output = str_replace(
            ["\r", "\n", '>', '</', "\n\n"],
            ['', '', ">\n", "\n</", "\n"],
            $html
        );

        return trim($output);
    }

    /**
     * Test two strings as HTML content
     */
    protected function assertEqualsHTML(string $expected, string $actual, string $message = ''): void
    {
        $expected = $this->loadHtml($expected);
        $actual = $this->loadHtml($actual);

        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * Asserting two strings are equal ignoring line endings.
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);

        $this->assertEquals($expected, $actual, $message);
    }

    /**
     * Asserting same ignoring slash.
     */
    protected function assertSameIgnoringSlash(string $expected, string $actual): void
    {
        $expected = str_replace(['/', '\\'], '/', $expected);
        $actual = str_replace(['/', '\\'], '/', $actual);

        $this->assertSame($expected, $actual);
    }
}
