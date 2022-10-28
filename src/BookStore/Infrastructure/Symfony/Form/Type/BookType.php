<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\Symfony\Form\Type;

use App\BookStore\Infrastructure\Sylius\Resource\BookResource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('author')
            ->add('description')
            ->add('content', TextareaType::class)
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookResource::class,
        ]);
    }
}
