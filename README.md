# Фасад (Facade)

[![Latest Version][badge-release]][packagist]
[![Software License][badge-license]][license]
[![PHP Version][badge-php]][php]
![Coverage Status][badge-coverage]
[![Total Downloads][badge-downloads]][downloads]
[![Support mail][badge-mail]][mail]

Фасады предоставляют "статический" интерфейс для классов,
используют динамические методы для проксирования вызовов методов к объектам, созданным в фабричном методе.

## Установка

Установить этот пакет можно как зависимость, используя Composer.

``` bash
composer require fi1a/facade
```

## Использование

Допустим у нас есть класс `Foo\Bar`.

```php
namespace Foo;

class Bar
{
    public function baz()
    {
        return $this;
    }
    
    public function qux(string $value): string
    {
        return $value;
    }
}
```

Для доступа к его методам через "статический" интерфейс используется фасад `Facades\BarFacade`.
Любые фасады, должны расширять абстрактный класс `Fi1a\Facade\AbstractFacade` и реализовывать метод
`protected static function factory(): object` возвращающий экземпляр объекта класса.
В примере метод `protected static function factory(): object` возвращает экземпляр класса `Foo\Bar`.

```php
namespace Facades;

use Fi1a\Facade\AbstractFacade;
use Foo\Bar;

/**
 * Фасад класса Foo\Bar
 *
 * @method static Bar baz()
 * @method static string qux(string $value)
 */
class BarFacade extends AbstractFacade
{

    /**
     * @inheritDoc
     */
    protected static function factory(): object
    {
        return new Bar();
    }
}
```

Вызов методов класса `Foo\Bar` через фасад.

```php
echo \Facades\BarFacade::baz()->qux('value'); // "value"
```

Фвбричный метод может возвращать всегда новый экземпляр класса или единожды созданный. Создание экземпляра класса
можно возложить на [Dependency injection container](https://github.com/fi1a/dependency-injection).

Пример единожды созданного через Dependency injection container экземпляра класса.
Сначала необходимо в конфигурацию Dependency injection container задать определение созданное с помощью builder'а:

```php
di()->config()->addDefinition(
    Builder::build(Foo\BarInterface::class)
        ->defineFactory(function () {
            static $instance;
            
            if ($instance === null) {
                $instance = new Foo\Bar();            
            }
            
            return $instance;
        })
        ->getDefinition()
);
```

Фасад использующий Dependency injection container

```php
namespace Facades;

use Fi1a\Facade\AbstractFacade;
use Foo\Bar;

/**
 * Фасад класса Foo\Bar
 *
 * @method static Bar baz()
 * @method static string qux(string $value)
 */
class BarFacade extends AbstractFacade
{

    /**
     * @inheritDoc
     */
    protected static function factory(): object
    {
        return di()->get(Foo\BarInterface::class); // Foo\BarInterface
    }
}
```

[badge-release]: https://img.shields.io/packagist/v/fi1a/facade?label=release
[badge-license]: https://img.shields.io/github/license/fi1a/facade?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/fi1a/facade?style=flat-square
[badge-coverage]: https://img.shields.io/badge/coverage-100%25-green
[badge-downloads]: https://img.shields.io/packagist/dt/fi1a/facade.svg?style=flat-square&colorB=mediumvioletred
[badge-mail]: https://img.shields.io/badge/mail-support%40fi1a.ru-brightgreen

[packagist]: https://packagist.org/packages/fi1a/facade
[license]: https://github.com/fi1a/facade/blob/master/LICENSE
[php]: https://php.net
[downloads]: https://packagist.org/packages/fi1a/facade
[mail]: mailto:support@fi1a.ru