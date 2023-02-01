<?php

declare(strict_types=1);

namespace Fi1a\Unit\Facade\Fixtures;

use Fi1a\Facade\Facade;

/**
 * Фасад для тестирования
 *
 * @method static Foo bar(string $value)
 * @method static string|null getValue()
 */
class FooFacade extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function factory(): object
    {
        return new Foo();
    }
}
