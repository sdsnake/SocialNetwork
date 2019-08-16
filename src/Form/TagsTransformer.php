<?php

namespace App\Form;

use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Collections\ArrayCollection;

class TagsTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($tags)
    {
        return implode(",", $tags->map(function ($tag) {
            return $tag->getName();
        })->toArray());
    }

    public function reverseTransform($tags)
    {
        $tagCollection = new ArrayCollection();

        $tagsRepository = $this->manager
            ->getRepository(Tag::class);

        foreach (explode(',', $tags) as $tag) {
            $tagInRepo = $tagsRepository->findOneByName($tag);

            if ($tagInRepo !== null) {
                // Add tag from repository if found
                $tagCollection->add($tagInRepo);
            } else {
                // Otherwise add new
                $newTag = new Tag();
                $newTag->setName($tag);
                $tagCollection->add($newTag);
            }
        }

        return $tagCollection;
    }
}
