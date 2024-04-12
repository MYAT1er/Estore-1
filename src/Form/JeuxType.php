<?php

namespace App\Form;

use App\Entity\Jeux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JeuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('plateforme', ChoiceType::class, [
                'choices' => [
                    '' => 'null',
                    'playstation' => 'playstation',
                    'Nintendo Switch' => 'Nintendo Switch',
                    'Xbox' => 'Xbox',
                    'pc' => 'pc'
                ]
            ])
            ->add('prix')
            ->add('stockDisponible')
            ->add('dateSortie', null, [
                'widget' => 'single_text'
            ])
            ->add('editeur')
            ->add('image', FileType::class, [
                'label' => 'image',
                'mapped' => false,
                'required' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeux::class,
        ]);
    }
}
