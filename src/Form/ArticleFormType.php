<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Enter article tame',
                'constraints' => [
                    new Type('string'),
                    new NotBlank(),
                    new Length(
                        ['max' => 1286,
                        'maxMessage' => 'Your name article too long!',
                        'min' => 2,
                        'minMessage' => 'Your name article small']
                    )
                ]
            ])
            ->add('body', null, [
                'label' => 'text about article',
                'constraints' => [
                    new Type('string'),
                    new NotBlank(),
                    new Length(
                        ['max' => 1286,
                            'maxMessage' => 'Your body article too long!',
                            'min' => 12,
                            'minMessage' => 'Your body article small']
                    )
                ]
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false, //не связана не с одним свойством
                'constraints' => [
                    new Image(['maxSize' => '1024k'])
                ],
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
