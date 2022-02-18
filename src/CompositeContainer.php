<?php
declare(strict_types=1);

namespace BrenoRoosevelt\Psr11;

use Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class CompositeContainer implements ContainerInterface
{
    /** @var ContainerInterface[] */
    private array $containers;

    public function __construct(ContainerInterface ...$containers)
    {
        $this->containers = $containers;
    }

    /** @inheritDoc */
    public function get(string $id)
    {
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return $container->get($id);
            }
        }

        $message = sprintf('Composite Container Exception: no entry was found for %s', $id);
        throw new class($message) extends Exception implements NotFoundExceptionInterface {
        };
    }

    /** @inheritDoc */
    public function has(string $id): bool
    {
        foreach ($this->containers as $container) {
            if ($container->has($id)) {
                return true;
            }
        }

        return false;
    }
}
