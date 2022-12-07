<?php

namespace App\BookStore\Infrastructure\Symfony\Command;

use App\BookStore\Infrastructure\Sylius\Operation\Cli\Operation;
use App\BookStore\Infrastructure\Sylius\State\Provider\Cli\BookCollectionProvider;
use App\BookStore\Infrastructure\Sylius\State\Responder\BookCollectionResponder;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Context\Option\ConsoleOption;
use Sylius\Component\Resource\Context\Option\InputOption as InputContextOption;
use Sylius\Component\Resource\Context\Option\OutputOption as OutputContextOption;
use Sylius\Component\Resource\State\ProviderInterface;
use Sylius\Component\Resource\State\ResponderInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:list-books')]
final class ListBooksCommand extends Command
{
    public function __construct(
        private readonly ProviderInterface $provider,
        private readonly ResponderInterface $responder,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('page', null, InputOption::VALUE_REQUIRED, 'Page number.', 1)
            ->addOption('items-per-page', null, InputOption::VALUE_REQUIRED, 'Amount of items per page.', 10)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $operation = new Operation();
        $operation = $operation->withProvider(BookCollectionProvider::class);
        $operation = $operation->withResponder(BookCollectionResponder::class);

        $context = new Context(new ConsoleOption($this), new InputContextOption($input), new OutputContextOption($output));

        $data = $this->provider->provide($operation, $context);
        $this->responder->respond($data, $operation, $context);

        return Command::SUCCESS;
    }
}
