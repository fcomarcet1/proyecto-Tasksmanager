<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'titulo: ',
                'required' => true
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenido: ',
                'required' => true
            ])
            ->add('hours', IntegerType::class, [
                'label' => 'Horas presupuestadas: ',
                'required' => true
            ])
            ->add('priority', ChoiceType::class, [
                'label' => 'Prioridad: ',
                'choices'  => [
                    'Normal' => null,
                    'Alta' => true,
                ]
            ])
            ->add('delivery_date', DateType::class, [
                'label' => 'Fecha de entrega',
                'widget' => 'single_text',
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}