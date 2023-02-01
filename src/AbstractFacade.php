<?php

declare(strict_types=1);

namespace Fi1a\Facade;

/**
 * Фасад
 */
abstract class AbstractFacade
{
    /**
     * Фабричный метод
     */
    abstract protected static function factory(): object;

    /**
     * Возвращает экземпляр класса
     */
    protected static function getFacadeInstance(): object
    {
        return static::factory();
    }

    /**
     * Статические вызовы методов фасада
     *
     * @param  array<int, mixed>  $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments)
    {
        /** @psalm-suppress MixedMethodCall */
        return static::getFacadeInstance()->$method(...$arguments);
    }
}
