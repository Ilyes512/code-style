<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/ecs.php');

    $containerConfigurator
        ->parameters()
        ->set(Option::PATHS, [
            __DIR__ . '/ecs-local.php',
            __DIR__ . '/ecs.php',
        ]);
};
