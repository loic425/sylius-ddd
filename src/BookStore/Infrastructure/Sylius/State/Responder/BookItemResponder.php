<?php

namespace App\BookStore\Infrastructure\Sylius\State\Responder;

use App\BookStore\Domain\Model\Book;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\InputOption;
use Sylius\Component\Resource\Context\Option\OutputOption;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

final class BookItemResponder implements ResponderInterface
{
    /**
     * @param Book|mixed $data
     */
    public function respond(mixed $data, Operation $operation, Context $context): void
    {
        $inputOption = $context->get(InputOption::class);
        $outputOption = $context->get(OutputOption::class);

        Assert::notNull($inputOption);
        Assert::notNull($outputOption);

        $ui = new SymfonyStyle($inputOption->input(), $outputOption->output());

        Assert::isInstanceOf($data, Book::class);

        $ui->title($data->name()->value);

        $ui->section('Id');
        $ui->writeln((string) $data->id());

        $ui->section('Author');
        $ui->writeln($data->author()->value);

        $ui->section('Description');
        $ui->writeln($data->description()->value);

        $ui->section('Content');
        $ui->writeln($data->content()->value);

        $ui->section('Price');
        $ui->writeln((string) $data->price()->amount);
    }
}
