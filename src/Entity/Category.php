<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *  * @Assert\Unique()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="category")
     * * @Assert\NotBlank()
     */
    private $post;

    public function __construct()
    {
        $this->post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getOui(): Collection
    {
        return $this->oui;
    }

    public function addOui(Post $oui): self
    {
        if (!$this->oui->contains($oui)) {
            $this->oui[] = $oui;
            $oui->setCategory($this);
        }

        return $this;
    }

    public function removeOui(Post $oui): self
    {
        if ($this->oui->contains($oui)) {
            $this->oui->removeElement($oui);
            // set the owning side to null (unless already changed)
            if ($oui->getCategory() === $this) {
                $oui->setCategory(null);
            }
        }

        return $this;
    }
}
