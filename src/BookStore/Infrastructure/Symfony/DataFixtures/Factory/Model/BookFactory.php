<?php

namespace App\BookStore\Infrastructure\Symfony\DataFixtures\Factory\Model;

use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Book>
 *
 * @method        Book|Proxy create(array|callable $attributes = [])
 * @method static Book|Proxy createOne(array $attributes = [])
 * @method static Book|Proxy find(object|array|mixed $criteria)
 * @method static Book|Proxy findOrCreate(array $attributes)
 * @method static Book|Proxy first(string $sortedField = 'id')
 * @method static Book|Proxy last(string $sortedField = 'id')
 * @method static Book|Proxy random(array $attributes = [])
 * @method static Book|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Book[]|Proxy[] all()
 * @method static Book[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Book[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Book[]|Proxy[] findBy(array $attributes)
 * @method static Book[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Book[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @psalm-method        Proxy<Book> create(array|callable $attributes = [])
 * @psalm-method static Proxy<Book> createOne(array $attributes = [])
 * @psalm-method static Proxy<Book> find(object|array|mixed $criteria)
 * @psalm-method static Proxy<Book> findOrCreate(array $attributes)
 * @psalm-method static Proxy<Book> first(string $sortedField = 'id')
 * @psalm-method static Proxy<Book> last(string $sortedField = 'id')
 * @psalm-method static Proxy<Book> random(array $attributes = [])
 * @psalm-method static Proxy<Book> randomOrCreate(array $attributes = [])
 * @psalm-method static RepositoryProxy<Book> repository()
 * @psalm-method static list<Proxy<Book>> all()
 * @psalm-method static list<Proxy<Book>> createMany(int $number, array|callable $attributes = [])
 * @psalm-method static list<Proxy<Book>> createSequence(iterable|callable $sequence)
 * @psalm-method static list<Proxy<Book>> findBy(array $attributes)
 * @psalm-method static list<Proxy<Book>> randomRange(int $min, int $max, array $attributes = [])
 * @psalm-method static list<Proxy<Book>> randomSet(int $number, array $attributes = [])
 */
final class BookFactory extends ModelFactory
{
    public function withAuthor(string $author): self
    {
        return $this->addState(['author' => $author]);
    }

    public function withContent(string $content): self
    {
        return $this->addState(['content' => $content]);
    }

    public function withDescription(string $description): self
    {
        return $this->addState(['description' => $description]);
    }

    public function withName(string $name): self
    {
        return $this->addState(['name' => $name]);
    }

    public function withPrice(float $price): self
    {
        return $this->addState(['price' => $price]);
    }

    protected function getDefaults(): array
    {
        return [
            'author' => self::faker()->name(),
            'content' => self::faker()->sentence(),
            'description' => self::faker()->sentence(),
            'name' => ucfirst(self::faker()->words(2, true)),
            'price' => self::faker()->randomNumber(2),
        ];
    }

    protected function initialize(): self
    {
        return $this
            ->instantiateWith(function(array $attributes): Book {
                return new Book(
                    name: new BookName($attributes['name']),
                    description: new BookDescription($attributes['description']),
                    author: new Author($attributes['author']),
                    content: new BookContent($attributes['content']),
                    price: new Price($attributes['price']),
                );
            })
        ;
    }

    protected static function getClass(): string
    {
        return Book::class;
    }
}
