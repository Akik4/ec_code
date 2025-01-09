<?php

namespace App\Form;

use App\Entity\BookRead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book_id', null, [
                'required' => false
            ])
            ->add('rating', null, [
                'required' => false
            ])
            ->add('description', null, [
                'required' => false
            ])
            ->add('read', null, [
                'required' => false,
                'empty_data' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookRead::class,
        ]);
    }
}
