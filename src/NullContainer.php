<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class NullContainer implements ContainerInterface
{
    public function get(string $id): bool
    {
        $message = sprintf('Null Container Exception: no entry was found for %s', $id);
        throw new class($message) extends Exception implements NotFoundExceptionInterface {
        };
    }

    public function has(string $id): bool
    {
        return false;
    }
}
