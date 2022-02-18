<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11\Tests;

use BrenoRoosevelt\Psr11\StaticContainer;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class StaticContainerTest extends TestCase
{
    public function testGet(): void
    {
        $container = new StaticContainer(['id' => 'value']);
        $this->assertEquals('value', $container->get('id'));
    }

    public function testGetException(): void
    {
        $this->expectException(NotFoundExceptionInterface::class);
        (new StaticContainer)->get('invalid');
    }

    public function testHas(): void
    {
        $container = new StaticContainer(['id' => 'value']);
        $this->assertTrue($container->has('id'));
        $this->assertFalse($container->has('invalid'));
    }
}
