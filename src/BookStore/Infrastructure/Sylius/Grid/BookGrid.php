<?php

namespace App\BookStore\Infrastructure\Sylius\Grid;

use App\BookStore\Domain\Model\Book;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class BookGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function __construct()
    {
        // TODO inject services if required
    }

    public static function getName(): string
    {
        return 'app_book';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            // see https://github.com/Sylius/SyliusGridBundle/blob/master/docs/field_types.md
            ->addField(
                StringField::create('name.value')
                    ->setLabel('Name.value')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('description.value')
                    ->setLabel('Description.value')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('author.value')
                    ->setLabel('Author.value')
                    ->setSortable(true)
            )
            ->addField(
                StringField::create('content.value')
                    ->setLabel('Content.value')
                    ->setSortable(true)
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                )
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Book::class;
    }
}
