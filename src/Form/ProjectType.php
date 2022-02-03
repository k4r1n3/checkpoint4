<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tags;
use phpDocumentor\Reflection\DocBlock\Description;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use function Sodium\add;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre du projet'])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('tags', EntityType::class, [
                'label'         => 'Sélectionner des tags',
                'class'         => Tags::class,
                'choice_label'  => 'name',
                'expanded'      => true,
                'multiple'      => true,
                'by_reference'  => false,
            ])
            ->add('documentFile', VichFileType::class, [
                'attr' => [
                    'required' => true,
                ],
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class]);
    }
}
