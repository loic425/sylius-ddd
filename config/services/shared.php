<?php

declare(strict_types=1);

use App\Shared\Infrastructure\Sylius\Menu\AdminMenuBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->parameters()->set('locale', 'en');

    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\Shared\\', __DIR__.'/../../src/Shared')
        ->exclude([__DIR__.'/../../src/Shared/Infrastructure/Kernel.php']);

    $services
        ->set(AdminMenuBuilder::class)
        ->decorate('sylius.ux.menu.admin')
    ;
};
