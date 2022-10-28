<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\State\Processor;

use App\BookStore\Application\Command\CreateBookCommand;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use App\Shared\Application\Command\CommandBusInterface;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Component\Resource\Metadata\Operation;
use Sylius\Component\Resource\State\ProcessorInterface;
use Webmozart\Assert\Assert;

final class CreateBookProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
    ) {
    }

    public function process(mixed $data, Operation $operation, RequestConfiguration $configuration): BookResource
    {
        Assert::isInstanceOf($data, BookResource::class);

        Assert::notNull($data->name);
        Assert::notNull($data->description);
        Assert::notNull($data->author);
        Assert::notNull($data->content);
        Assert::notNull($data->price);

        $command = new CreateBookCommand(
            new BookName($data->name),
            new BookDescription($data->description),
            new Author($data->author),
            new BookContent($data->content),
            new Price($data->price),
        );

        /** @var Book $model */
        $model = $this->commandBus->dispatch($command);

        return BookResource::fromModel($model);
    }
}
