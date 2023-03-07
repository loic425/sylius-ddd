<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Provider\Cli;

use App\BookStore\Application\Query\FindBooksQuery;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Infrastructure\Sylius\Context\Option\CliOption;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Sylius\State\Paginator;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\InputOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProviderInterface;
use Webmozart\Assert\Assert;

final class BookCollectionProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
    ) {
    }

    public function provide(Operation $operation, Context $context): object|iterable
    {
        $cliOption = $context->get(CliOption::class);
        Assert::notNull($cliOption);

        $page = (int) $cliOption->input()->getOption('page');
        $itemsPerPage = (int) $cliOption->input()->getOption('items-per-page');

        /** @var BookRepositoryInterface $models */
        $models = $this->queryBus->ask(new FindBooksQuery(page: $page, itemsPerPage: $itemsPerPage));

        $paginator = $models->paginator();

        Assert::notNull($paginator);

        return $paginator;
    }
}
