<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11\Tests;

use BrenoRoosevelt\Psr11\NullContainer;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class NullContainerTest extends TestCase
{
    public function testGet(): void
    {
        $this->expectException(NotFoundExceptionInterface::class);
        (new NullContainer)->get('any');
    }

    public function testHas(): void
    {
        $result = (new NullContainer)->has('any');
        $this->assertFalse($result);
    }
}
