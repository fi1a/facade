<?php

declare(strict_types=1);

namespace Fi1a\Unit\Facade;

use Fi1a\Unit\Facade\Fixtures\FooFacade;
use PHPUnit\Framework\TestCase;

/**
 * Фасад
 */
class FacadeTest extends TestCase
{
    /**
     * Фасад
     */
    public function testFacade(): void
    {
        $this->assertEquals('value', FooFacade::bar('value')->getValue());
    }
}
