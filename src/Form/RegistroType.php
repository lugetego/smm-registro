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
            ->add('area', ChoiceType::class, [
                'choices' => [
                    'General and overarching topics; collections'=>'General and overarching topics; collections',
                    'History and biography'=>'History and biography',
                    'Mathematical logic and foundations'=>'Mathematical logic and foundations',
                    'Combinatorics'=>'Combinatorics',
                    'Order, lattices, ordered algebraic structures'=>'Order, lattices, ordered algebraic structures',
                    'General algebraic systems'=>'General algebraic systems',
                    'Number theory'=>'Number theory',
                    'Field theory and polynomials'=>'Field theory and polynomials',
                    'Commutative algebra'=>'Commutative algebra',
                    'Algebraic geometry'=>'Algebraic geometry',
                    'Linear and multilinear algebra; matrix theory'=>'Linear and multilinear algebra; matrix theory',
                    'Associative rings and algebras '=>'Associative rings and algebras ',
                    'Nonassociative rings and algebras'=>'Nonassociative rings and algebras',
                    'Category theory; homological algebra '=>'Category theory; homological algebra ',
                    '$K$-theory'=>'$K$-theory',
                    'Group theory and generalizations'=>'Group theory and generalizations',
                    'Topological groups, Lie groups '=>'Topological groups, Lie groups ',
                    'Real functions'=>'Real functions',
                    'Measure and integration '=>'Measure and integration ',
                    'Functions of a complex variable'=>'Functions of a complex variable',
                    'Potential theory '=>'Potential theory ',
                    'Several complex variables and analytic spaces '=>'Several complex variables and analytic spaces ',
                    'Special functions (33-XX deals with the properties of functions as functions) '=>'Special functions (33-XX deals with the properties of functions as functions) ',
                    'Ordinary differential equations'=>'Ordinary differential equations',
                    'Partial differential equations'=>'Partial differential equations',
                    'Dynamical systems and ergodic theory'=>'Dynamical systems and ergodic theory',
                    'Difference and functional equations'=>'Difference and functional equations',
                    'Sequences, series, summability'=>'Sequences, series, summability',
                    'Approximations and expansions '=>'Approximations and expansions ',
                    'Harmonic analysis on Euclidean spaces'=>'Harmonic analysis on Euclidean spaces',
                    'Abstract harmonic analysis '=>'Abstract harmonic analysis ',
                    'Integral transforms, operational calculus '=>'Integral transforms, operational calculus ',
                    'Integral equations'=>'Integral equations',
                    'Functional analysis '=>'Functional analysis ',
                    'Operator theory'=>'Operator theory',
                    'Calculus of variations and optimal control; optimization'=>'Calculus of variations and optimal control; optimization',
                    'Geometry '=>'Geometry ',
                    'Convex and discrete geometry'=>'Convex and discrete geometry',
                    'Differential geometry '=>'Differential geometry ',
                    'General topology '=>'General topology ',
                    'Algebraic topology'=>'Algebraic topology',
                    'Manifolds and cell complexes '=>'Manifolds and cell complexes ',
                    'Global analysis, analysis on manifolds'=>'Global analysis, analysis on manifolds',
                    'Probability theory and stochastic processes '=>'Probability theory and stochastic processes ',
                    'Statistics'=>'Statistics',
                    'Numerical analysis'=>'Numerical analysis',
                    'Computer science '=>'Computer science ',
                    'Mechanics of particles and systems '=>'Mechanics of particles and systems ',
                    'Mechanics of deformable solids'=>'Mechanics of deformable solids',
                    'Fluid mechanics '=>'Fluid mechanics ',
                    'Optics, electromagnetic theory '=>'Optics, electromagnetic theory ',
                    'Classical thermodynamics, heat transfer '=>'Classical thermodynamics, heat transfer ',
                    'Quantum theory'=>'Quantum theory',
                    'Statistical mechanics, structure of matter'=>'Statistical mechanics, structure of matter',
                    'Relativity and gravitational theory'=>'Relativity and gravitational theory',
                    'Astronomy and astrophysics '=>'Astronomy and astrophysics ',
                    'Geophysics'=>'Geophysics',
                    'Operations research, mathematical programming'=>'Operations research, mathematical programming',
                    'Game theory, economics, finance, and other social and behavioral sciences'=>'Game theory, economics, finance, and other social and behavioral sciences',
                    'Biology and other natural sciences'=>'Biology and other natural sciences',
                    'Systems theory; control '=>'Systems theory; control ',
                    'Information and communication theory, circuits'=>'Information and communication theory, circuits',
                    'Mathematics education'=>'Mathematics education',
                ],
                    'label'=>'Área de especialidad',
                    'placeholder'=>'Seleccionar'

                ]
            )
            ->add('afiliacion', null, array(
                'label'=>'Afiliación',
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