<?php

namespace App\Form;

use App\Entity\Registro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichFileType;


class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre',null, array(
                'label'=>'Nombre(s)',
            ))
            ->add('apaterno', null, array(
                'label'=>'Apellido paterno',
            ))
            ->add('amaterno', null, array(
                'label'=>'Apellido materno',
            ))
            ->add(
                'genero',
                ChoiceType::class,
                [
                    'choices' => [
                        'Mujer' => 'Mujer',
                        'Hombre' => 'Hombre',
                    ],
                    'required' => false,
                    'expanded' => true,
                    'label'=>'Género',
                    'placeholder' => false

                ]
            )
            ->add('nacimiento',BirthdayType::class, array(
                'required' => false,
                'label'=>'Fecha de nacimiento',
                'widget' => 'single_text',
                'by_reference' => true,

                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                ],
            ))
            ->add('correo', null, array(
                'label'=>'Correo electrónico',
            ))
            ->add('afiliacion', null, array(
                'label'=>'Afiliación',
            ))
            ->add('area', null, array(
                'label'=>'Área de especialidad',
            ))
            ->add(
                'miembrosmm',
                ChoiceType::class,
                [
                    'choices' => [
                        'Si' => 'Si',
                        'No' => 'No',
                    ],
                    'expanded' => true,
                    'label'=>'¿Es miembro de la SMM?',

                ]
            )
            ->add(
                'newsletter',
                ChoiceType::class,
                [
                    'choices' => [
                        'Si' => 'Si',
                        'No' => 'No',
                    ],
                    'expanded' => true,
                    'label'=>'¿Desea recibir la newsletter de la SMM?',

                ]
            )


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registro::class,
        ]);
    }
}