<?php

namespace App\BookStore\Infrastructure\Symfony\Command;

use App\BookStore\Infrastructure\Sylius\Operation\Cli\Operation;
use App\BookStore\Infrastructure\Sylius\State\Provider\Cli\BookItemProvider;
use App\BookStore\Infrastructure\Sylius\State\Responder\BookItemResponder;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\InputOption;
use Sylius\Component\Resource\Context\Option\OutputOption;
use Sylius\Component\Resource\State\ProviderInterface;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:show-book')]
final class ShowBookCommand extends Command
{
    public function __construct(
        //private readonly ProviderInterface $provider,
        //private readonly ResponderInterface $responder,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'The book id.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $operation = new Operation();
        $operation = $operation->withProvider(BookItemProvider::class);
        $operation = $operation->withResponder(BookItemResponder::class);

        $context = new Context(new InputOption($input), new OutputOption($output));

        //$data = $this->provider->provide($operation, $context);
        //$this->responder->respond($data, $operation, $context);

        return Command::SUCCESS;
    }
}
