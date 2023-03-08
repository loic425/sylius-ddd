<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Provider;

use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Grid\State\RequestGridProvider;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;

final class BookCollectionProvider implements ProviderInterface
{
    public function __construct(
        private RequestGridProvider $requestGridProvider,
    ) {
    }

    public function provide(Operation $operation, Context $context): object|iterable
    {
        return $this->requestGridProvider->provide($operation, $context);
    }
}
