<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bootstrap5\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Yiisoft\Yii\Bootstrap5\NavLink;

/**
 * Tests for `NavLink`.
 */
#[Group('nav')]
final class NavLinkTest extends TestCase
{
    public function testImmutability(): void
    {
        $navLink = NavLink::to('Home', '/', true);

        $this->assertNotSame($navLink, $navLink->active(false));
        $this->assertNotSame($navLink, $navLink->attributes([]));
        $this->assertNotSame($navLink, $navLink->disabled(false));
        $this->assertNotSame($navLink, $navLink->encodeLabel(false));
        $this->assertNotSame($navLink, $navLink->paneId(true));
        $this->assertNotSame($navLink, $navLink->label(''));
        $this->assertNotSame($navLink, $navLink->paneAttributes([]));
        $this->assertNotSame($navLink, $navLink->url(''));
        $this->assertNotSame($navLink, $navLink->urlAttributes([]));
        $this->assertNotSame($navLink, $navLink->visible(false));
    }

    public function testThrowExceptionWithActiveAndDisableTrueValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A nav link cannot be both active and disabled.');

        NavLink::to('Home', '/', true, true);
    }
}
