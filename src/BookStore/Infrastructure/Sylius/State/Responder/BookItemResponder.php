<?php

namespace App\BookStore\Infrastructure\Sylius\State\Responder;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Infrastructure\Sylius\Context\Option\CliOption;
use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\InputOption;
use Sylius\Component\Resource\Context\Option\OutputOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class BookItemResponder implements ResponderInterface
{
    /**
     * @param Book|mixed $data
     */
    public function respond(mixed $data, Operation $operation, Context $context): mixed
    {
        $cliOption = $context->get(CliOption::class);

        Assert::notNull($cliOption);

        $ui = new SymfonyStyle($cliOption->input(), $cliOption->output());

        Assert::isInstanceOf($data, Book::class);
        $book = BookResource::fromModel($data);

        $ui->title($book->name);

        $ui->section('Id');
        $ui->writeln((string) $book->id);

        $ui->section('Author');
        $ui->writeln($book->author);

        $ui->section('Description');
        $ui->writeln($book->description);

        $ui->section('Content');
        $ui->writeln($book->content);

        $ui->section('Price');
        $ui->writeln($book->price);

        return Command::SUCCESS;
    }
}
