<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Processor;

use App\BookStore\Application\Command\DeleteBookCommand;
use App\BookStore\Domain\ValueObject\BookId;
use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use App\Shared\Application\Command\CommandBusInterface;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProcessorInterface;
use Webmozart\Assert\Assert;

final class DeleteBookProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function process(mixed $data, Operation $operation, RequestConfiguration $configuration): mixed
    {
        Assert::isInstanceOf($data, BookResource::class);

        $this->commandBus->dispatch(new DeleteBookCommand(new BookId($data->id)));

        return null;
    }
}
