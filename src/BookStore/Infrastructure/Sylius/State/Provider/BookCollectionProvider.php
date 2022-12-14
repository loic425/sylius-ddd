<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Provider;

use App\BookStore\Infrastructure\Sylius\Repository\BookRepository;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Bundle\ResourceBundle\Controller\ResourcesCollectionProviderInterface;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\RequestConfigurationOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Webmozart\Assert\Assert;

final class BookCollectionProvider implements ProviderInterface
{
    public function __construct(
        private ResourcesCollectionProviderInterface $resourcesCollectionProvider,
        private BookRepository $bookRepository,
    ) {
    }

    public function provide(Operation $operation, Context $context): object|iterable
    {
        $requestionConfigurationOption = $context->get(RequestConfigurationOption::class);
        Assert::notNull($requestionConfigurationOption);

        $configuration = $requestionConfigurationOption->configuration();

        return $this->resourcesCollectionProvider->get(
            $configuration,
            $this->bookRepository,
        );
    }
}
