<?php

namespace App\BookStore\Infrastructure\Symfony\Command;

use App\BookStore\Infrastructure\Sylius\Operation\Cli\Operation;
use Sylius\Component\Resource\Context\Context;
use Sylius\Component\Resource\Metadata\Factory\OperationFactoryInterface;
use Sylius\Component\Resource\State\CallableProcessor;
use Sylius\Component\Resource\State\CallableProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

#[AsCommand(name: 'sylius:resource-operation')]
final class ResourceOperationCommand extends Command
{
    public function __construct(
        private CallableProvider $provider,
        private CallableProcessor $processor,
        private OperationFactoryInterface $operationFactory,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('operation', InputArgument::REQUIRED, 'The operation.')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'The resource id.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var Operation $operation */
        $operationArgument = $input->getArgument('operation');

        Assert::true(is_a($operationArgument, Operation::class, true), sprintf('Operation should implement %s.', Operation::class));

        $operation = $this->operationFactory->create($operationArgument, []);

        $data = $this->provider->provide($operation, new Context($input, $output));

        return Command::SUCCESS;
    }
}
