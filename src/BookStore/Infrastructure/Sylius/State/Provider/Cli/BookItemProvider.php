<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Provider\Cli;

use App\BookStore\Application\Query\FindBookQuery;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\ValueObject\BookId;
use App\Shared\Application\Query\QueryBusInterface;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Uid\Uuid;

final class BookItemProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function provide(Operation $operation, Context $context): ?Book
    {
        $id = (string) $context->get(InputInterface::class)->getArgument('id');

        /** @var Book|null $model */
        $model = $this->queryBus->ask(new FindBookQuery(new BookId(Uuid::fromString($id))));

        return $model;
    }
}