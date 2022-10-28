<?php

declare(strict_types=1);

use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Infrastructure\ApiPlatform\State\Processor\AnonymizeBooksProcessor;
use App\BookStore\Infrastructure\ApiPlatform\State\Processor\CreateBookProcessor;
use App\BookStore\Infrastructure\ApiPlatform\State\Processor\DeleteBookProcessor;
use App\BookStore\Infrastructure\ApiPlatform\State\Processor\DiscountBookProcessor;
use App\BookStore\Infrastructure\ApiPlatform\State\Processor\UpdateBookProcessor;
use App\BookStore\Infrastructure\ApiPlatform\State\Provider\BookCollectionProvider;
use App\BookStore\Infrastructure\ApiPlatform\State\Provider\BookItemProvider;
use App\BookStore\Infrastructure\ApiPlatform\State\Provider\CheapestBooksProvider;
use App\BookStore\Infrastructure\Doctrine\DoctrineBookRepository;
use App\BookStore\Infrastructure\Sylius\State\Provider as SyliusProvider;
use App\BookStore\Infrastructure\Sylius\State\Processor as SyliusProcessor;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Sylius\Bundle\ResourceBundle\Controller\ResourcesCollectionProviderInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\BookStore\\', __DIR__.'/../../src/BookStore');

    // Sylius providers

    $services->set(SyliusProvider\BookItemProvider::class)
        ->autoconfigure(false)
        ->tag('sylius.state_provider', ['priority' => 0]);

    $services->set(SyliusProvider\BookCollectionProvider::class)
        ->autoconfigure(false)
        ->tag('sylius.state_provider', ['priority' => 0]);

    // Sylius processors

    $services->set(SyliusProcessor\CreateBookProcessor::class)
        ->autoconfigure(false)
        ->tag('sylius.state_processor', ['priority' => 0]);

    $services->set(SyliusProcessor\UpdateBookProcessor::class)
        ->autoconfigure(false)
        ->tag('sylius.state_processor', ['priority' => 0]);

    $services->set(SyliusProcessor\DeleteBookProcessor::class)
        ->autoconfigure(false)
        ->tag('sylius.state_processor', ['priority' => 0]);

    // providers
    $services->set(CheapestBooksProvider::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_provider', ['priority' => 1]);

    $services->set(BookItemProvider::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_provider', ['priority' => 0]);

    $services->set(BookCollectionProvider::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_provider', ['priority' => 0]);

    // processors
    $services->set(AnonymizeBooksProcessor::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_processor', ['priority' => 1]);

    $services->set(DiscountBookProcessor::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_processor', ['priority' => 1]);

    $services->set(CreateBookProcessor::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_processor', ['priority' => 0]);

    $services->set(UpdateBookProcessor::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_processor', ['priority' => 0]);

    $services->set(DeleteBookProcessor::class)
        ->autoconfigure(false)
        ->tag('api_platform.state_processor', ['priority' => 0]);

    // repositories
    $services->set(BookRepositoryInterface::class)
        ->class(DoctrineBookRepository::class);

    $services->alias(ResourcesCollectionProviderInterface::class, 'sylius.resource_controller.resources_collection_provider');
};
