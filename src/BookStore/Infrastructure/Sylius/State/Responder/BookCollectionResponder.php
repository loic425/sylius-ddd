<?php

namespace App\BookStore\Infrastructure\Sylius\State\Responder;

use App\BookStore\Domain\Model\Book;
use App\Shared\Domain\Repository\PaginatorInterface;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\InputOption;
use Sylius\Component\Resource\Context\Option\OutputOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class BookCollectionResponder implements ResponderInterface
{
    /**
     * @param PaginatorInterface|mixed $data
     */
    public function respond(mixed $data, Operation $operation, Context $context): void
    {
        $inputOption = $context->get(InputOption::class);
        $outputOption = $context->get(OutputOption::class);

        Assert::notNull($inputOption);
        Assert::notNull($outputOption);

        $ui = new SymfonyStyle($inputOption->input(), $outputOption->output());

        Assert::isInstanceOf($data, PaginatorInterface::class);

        $this->renderTable($ui, $data);
        $this->renderPagination($ui, $data);
    }

    private function renderPagination(SymfonyStyle $ui, PaginatorInterface $paginator): void
    {
        $ui->info(sprintf('page %s/%s', $paginator->getCurrentPage(), $paginator->getLastPage()));
    }

    private function renderTable(SymfonyStyle $ui, PaginatorInterface $paginator): void
    {
        $ui->section('Books');

        $rows = [];

        /** @var Book $book */
        foreach ($paginator->getIterator() as $book) {
            $rows[] = [
                $book->id()->value,
                $book->name()->value,
                $book->author()->value,
                $book->price()->amount,
            ];
        }

        $ui->table(['Id', 'Name', 'Author', 'Price'], $rows);
    }
}
