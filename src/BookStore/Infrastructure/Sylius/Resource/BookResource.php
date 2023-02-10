<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\Resource;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Infrastructure\Sylius\State\Processor\CreateBookProcessor;
use App\BookStore\Infrastructure\Sylius\State\Processor\DeleteBookProcessor;
use App\BookStore\Infrastructure\Sylius\State\Processor\UpdateBookProcessor;
use App\BookStore\Infrastructure\Sylius\State\Provider\BookCollectionProvider;
use App\BookStore\Infrastructure\Sylius\State\Provider\BookItemProvider;
use Sylius\Component\Resource\Metadata\Create;
use Sylius\Component\Resource\Metadata\Delete;
use Sylius\Component\Resource\Metadata\Index;
use Sylius\Component\Resource\Metadata\Resource;
use Sylius\Component\Resource\Metadata\Show;
use Sylius\Component\Resource\Metadata\Update;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Validator\Constraints as Assert;

#[Resource(
    alias: 'app.book',
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: 'admin',
    operations: [
        new Create(
            processor: CreateBookProcessor::class,
        ),
        new Update(
            provider: BookItemProvider::class,
            processor: UpdateBookProcessor::class,
        ),
        new Index(
            provider: BookCollectionProvider::class,
            grid: 'app_book',
        ),
        new Show(
            template: 'admin/book/show.html.twig',
            provider: BookItemProvider::class,
        ),
        new Delete(
            provider: BookItemProvider::class,
            processor: DeleteBookProcessor::class,
        ),
    ],
)]
final class BookResource implements ResourceInterface
{
    public function __construct(
        public ?AbstractUid $id = null,

        #[Assert\NotNull]
        #[Assert\Length(min: 1, max: 255)]
        public ?string $name = null,

        #[Assert\NotNull]
        #[Assert\Length(min: 1, max: 1023)]
        public ?string $description = null,

        #[Assert\NotNull]
        #[Assert\Length(min: 1, max: 255)]
        public ?string $author = null,

        #[Assert\NotNull]
        #[Assert\Length(min: 1, max: 65535)]
        public ?string $content = null,

        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public ?int $price = null,
    ) {
    }

    public static function fromModel(Book $book): static
    {
        return new self(
            $book->id()->value,
            $book->name()->value,
            $book->description()->value,
            $book->author()->value,
            $book->content()->value,
            $book->price()->amount,
        );
    }

    public function getId(): ?string
    {
        return null !== $this->id ? (string) $this->id : null;
    }
}
