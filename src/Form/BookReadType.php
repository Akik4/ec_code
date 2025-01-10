<?php

namespace App\Form;

use App\Entity\BookRead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookReadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_id')
            ->add('book_id', null)
            ->add('rating')
            ->add('description')
            ->add('is_read')
            ->add('cover')
            ->add('created_at', null, [
                'widget' => 'single_text',
                'empty_data' => new \DateTime()
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
                'empty_data' => new \DateTime()
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
