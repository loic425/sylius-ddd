<?php

declare(strict_types=1);

use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->add('app_admin_dashboard', '/admin')
        ->controller(TemplateController::class)
        ->defaults(['template' => 'admin/index.html.twig'])
    ;
};
