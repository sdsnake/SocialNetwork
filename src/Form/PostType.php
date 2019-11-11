<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class PostType
 * @package App\Form
 */
class PostType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $tagsTransformer;

    /**
     * PostType constructor.
     * @param ObjectManager $manager
     */
    public function __construct(TagsTransformer $tagsTransformer)
    {
        $this->tagsTransformer = $tagsTransformer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => 'Catégorie'
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'mytextarea'],
                'label' => 'Votre message'
            ])
            ->add('img', FileType::class, [
                'label' => 'Ajoutez une image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
            ])
            ->add(
                'tags',
                TextType::class,
                [
                'attr' => ['class' => 'dynchoice'],
                ]
            );


        // Data Transformer
        $builder
            ->get('tags')
            ->addModelTransformer($this->tagsTransformer);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
