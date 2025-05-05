<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Loan;
use App\Entity\Reader;
use App\Entity\Returning;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoanForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('loanDate')
            ->add('dueDate')
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'id',
            ])
            ->add('reader', EntityType::class, [
                'class' => Reader::class,
                'choice_label' => 'id',
            ])
            ->add('bookReturn', EntityType::class, [
                'class' => Returning::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Loan::class,
        ]);
    }
}
