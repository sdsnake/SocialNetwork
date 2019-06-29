<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'mytextarea'],
            ])
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => Post::class,
        ]);
    }
}
