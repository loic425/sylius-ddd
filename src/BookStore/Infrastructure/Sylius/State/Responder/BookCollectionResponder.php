<?php

namespace App\BookStore\Infrastructure\Sylius\State\Responder;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Infrastructure\Sylius\Context\Option\CliOption;
use App\Shared\Domain\Repository\PaginatorInterface;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class BookCollectionResponder implements ResponderInterface
{
    /**
     * @param PaginatorInterface|mixed $data
     */
    public function respond(mixed $data, Operation $operation, Context $context): mixed
    {
        $cliOption = $context->get(CliOption::class);

        Assert::notNull($cliOption);

        $ui = new SymfonyStyle($cliOption->input(), $cliOption->output());

        Assert::isInstanceOf($data, PaginatorInterface::class);

        $this->renderTable($ui, $data);
        $this->renderPagination($cliOption->command(), $ui, $data);

        return Command::SUCCESS;
    }

    private function renderPagination(Command $command, SymfonyStyle $ui, PaginatorInterface $paginator): void
    {
        $ui->info(sprintf('page %s/%s', $paginator->getCurrentPage(), $paginator->getLastPage()));

        if ($paginator->getCurrentPage() > 1) {
            $ui->note(sprintf('Previous page: bin/console %s --page=%s', $command->getName(), $paginator->getCurrentPage() - 1));
        }

        if ($paginator->getCurrentPage() < $paginator->getLastPage()) {
            $ui->note(sprintf('Next page: bin/console %s --page=%s', $command->getName(), $paginator->getCurrentPage() + 1));
        }
    }

    private function renderTable(SymfonyStyle $ui, PaginatorInterface $paginator): void
    {
        $ui->section('Books');

        $rows = [];

        /** @var Book $book */
        foreach ($paginator->getIterator() as $book) {
            $rows[] = [
                sprintf('<info>bin/console app:show-book %s</info>', $book->id()->value),
                $book->name()->value,
                $book->author()->value,
                $book->price()->amount,
            ];
        }

        $ui->table(['Id', 'Name', 'Author', 'Price'], $rows);
    }
}
