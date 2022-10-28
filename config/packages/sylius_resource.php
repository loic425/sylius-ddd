<?php

declare(strict_types=1);

use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use App\BookStore\Infrastructure\Symfony\Form\Type\BookType;
use Symfony\Config\SyliusResourceConfig;

return static function (SyliusResourceConfig $resourceConfig): void {
    $resourceConfig->mapping()->paths(['%kernel.project_dir%/src/BookStore/Infrastructure/Sylius/Resource']);

    $bookResource = $resourceConfig->resources('app.book');
    $bookResource->classes()
        ->model(BookResource::class)
        ->form(BookType::class)
    ;
};
