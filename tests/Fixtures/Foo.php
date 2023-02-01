<?php

declare(strict_types=1);

namespace Fi1a\Unit\Facade\Fixtures;

/**
 * Класс для тестирования
 */
class Foo
{
    /**
     * @var string|null
     */
    protected $value;

    /**
     * Метод для тестирования
     *
     * @return $this
     */
    public function bar(string $value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
