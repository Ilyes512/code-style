# ilyes512/code-style

An ECS (Easy Coding Standards) codestyle package.

## Installation

You can install the package via composer:

```bash
composer require --dev ilyes512/code-style
```

## Usage

Add a `ecs.php` file to the root of your project with the below contents.

`ecs.php`:

```php
<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/ilyes512/code-style/ecs.php');

    $containerConfigurator
        ->parameters()
        ->set(
            Option::PATHS,
            [
                __DIR__ . '/src',
                __DIR__ . '/config',
                __DIR__ . '/tests',
                __DIR__ . '/ecs.php',
            ],
        );
};
```
