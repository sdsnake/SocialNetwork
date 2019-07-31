<?php

namespace App\Form;

use App\Form\TagsTransformer;
use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Tag;
use Doctrine\DBAL\Types\ArrayType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\Common\Persistence\ObjectManager;

class PostType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'mytextarea'],
            ])
            ->add('img', FileType::class, [
                'label' => 'Ajoutez une image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
            ]);

        $builder->add('tags', TextType::class, [
                'attr' => ['class' => 'dynchoice'],
            ]
        );


        // Data Transformer
        $builder
            ->get('tags')
            ->addModelTransformer(new TagsTransformer($this->manager));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
