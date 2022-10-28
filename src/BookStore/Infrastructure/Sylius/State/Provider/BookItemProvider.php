<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Provider;

use App\BookStore\Application\Query\FindBookQuery;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use App\Shared\Application\Query\QueryBusInterface;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Symfony\Component\Uid\Uuid;

final class BookItemProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function provide(Operation $operation, RequestConfiguration $configuration): ?BookResource
    {
        $id = (string) $configuration->getRequest()->attributes->get('id');

        /** @var Book|null $model */
        $model = $this->queryBus->ask(new FindBookQuery(new BookId(Uuid::fromString($id))));

        return null !== $model ? BookResource::fromModel($model) : null;
    }
}
