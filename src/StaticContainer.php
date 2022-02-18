<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class StaticContainer implements ContainerInterface
{
    private array $services;

    /**
     * @param array<string, mixed> $services
     */
    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    /** @inheritDoc */
    public function get(string $id)
    {
        if (! array_key_exists($id, $this->services)) {
            $message = sprintf('Static Container Exception: no entry was found for %s', $id);
            throw new class($message) extends Exception implements NotFoundExceptionInterface {
            };
        }

        return $this->services[$id];
    }

    /** @inheritDoc */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}
