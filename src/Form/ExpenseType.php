<?php

namespace App\Form;

use App\Entity\Expense;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('title')
            ->add('category', ChoiceType::class, [
                'choices' => [
                    '-' => null,
                    'Loyer' => 'Loyer',
                    'Assurance Habit.' => 'Assurance Habitation',
                    'Course alimentaire' => 'Course alimentaire',
                    'Electroménager' => 'Electroménager',
                    'TV/Internet' => 'TV/Internet'
                ]
            ])
            ->add('amount')
            ->add('store')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}
