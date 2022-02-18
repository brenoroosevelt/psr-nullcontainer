<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11\Tests;

use BrenoRoosevelt\Psr11\CompositeContainer;
use BrenoRoosevelt\Psr11\StaticContainer;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;

class CompositeContainerTest extends TestCase
{
    public function testGet(): void
    {
        $container = new CompositeContainer(
            new StaticContainer(['id1' => 'value1']),
            new StaticContainer(['id2' => 'value2']),
        );

        $this->assertEquals('value1', $container->get('id1'));
        $this->assertEquals('value2', $container->get('id2'));
    }

    public function testGetException(): void
    {
        $container = new CompositeContainer(
            new StaticContainer(['id1' => 'value1']),
            new StaticContainer(['id2' => 'value2']),
        );

        $this->expectException(NotFoundExceptionInterface::class);
        $container->get('invalid');
    }

    public function testHas(): void
    {
        $container = new CompositeContainer(
            new StaticContainer(['id1' => 'value1']),
            new StaticContainer(['id2' => 'value2']),
        );

        $this->assertTrue($container->has('id1'));
        $this->assertTrue($container->has('id2'));
        $this->assertFalse($container->has('id3'));
    }
}
