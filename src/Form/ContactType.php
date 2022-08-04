<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'mb-3 form-control form-control-lg no-shadow',
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'mb-3 form-control form-control-lg',
                    'placeholder' => 'Votre e-mail'
                ],
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)))
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'mb-3 form-control form-control-lg',
                    'placeholder' => 'Votre demande'
                ],
                'constraints' => array(
                    new NotBlank(),
                    new Length(array('min' => 3)),
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
