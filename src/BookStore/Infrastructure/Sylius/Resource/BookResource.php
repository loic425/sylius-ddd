<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Sylius\Resource;

use App\BookStore\Domain\Model\Book;
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

#[Resource(alias: 'app.book')]
#[Show(routePrefix: 'admin', template: 'admin/book/show.html.twig', section: 'admin', provider: BookItemProvider::class)]
#[Create(routePrefix: 'admin', template: '@SyliusUxSemanticUi/crud/create.html.twig', section: 'admin')]
#[Update(routePrefix: 'admin', template: '@SyliusUxSemanticUi/crud/update.html.twig', section: 'admin')]
#[Index(routePrefix: 'admin', template: '@SyliusUxSemanticUi/crud/index.html.twig', section: 'admin', grid: 'app_book')]
#[Delete(routePrefix: 'admin', section: 'admin')]
final class BookResource implements ResourceInterface
{
    public function __construct(
        public ?AbstractUid $id = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\Length(min: 1, max: 255, groups: ['create', 'Default'])]
        public ?string $name = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\Length(min: 1, max: 1023, groups: ['create', 'Default'])]
        public ?string $description = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\Length(min: 1, max: 255, groups: ['create', 'Default'])]
        public ?string $author = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\Length(min: 1, max: 65535, groups: ['create', 'Default'])]
        public ?string $content = null,

        #[Assert\NotNull(groups: ['create'])]
        #[Assert\PositiveOrZero(groups: ['create', 'Default'])]
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
