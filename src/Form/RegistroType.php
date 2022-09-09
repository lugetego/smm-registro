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
                        'Otro' => 'Otro'
                    ],
                    'required' => false,
                    'expanded' => false,
                    'label'=>'Género',
                    'placeholder' => 'Seleccionar'

                ]
            )
            ->add('nacimiento',BirthdayType::class, array(
                'required' => false,
                'label'=>'Fecha de nacimiento',
                'widget' => 'choice',
                'html5' => false,
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
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
                    'label'=>'¿Eres miembro de la Sociedad Matemática Mexicana?',

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
                    'label'=>'¿Te gustaría recibir el Boletín de la Sociedad Matemática Mexicana?',

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