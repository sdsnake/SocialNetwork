<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;


    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10, minMessage="Contenu trop court")
     *
     * @var string
     */
    private $content;


    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="post")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var Category|null
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="post", orphanRemoval=true)
     *
     * @var Comment|null
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var User|null
     */
    private $user;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     *
     * @var string
     */
    private $imgFilename;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="loves")
     *
     * @var User|null
     */
    private $loves;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="posts", cascade={"persist"})
     *
     * @var Tag|null
     */
    private $tags;

    /**
     * Post constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->imgFilename = "nothing.png";
        $this->createdAt = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->loves = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(user $user)
    {
        $this->user = $user;

        return $this;
    }


    public function getImgFilename()
    {
        return $this->imgFilename;
    }

    public function setImgFilename($imgFilename)
    {
        $this->imgFilename = $imgFilename;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getLoves(): Collection
    {
        return $this->loves;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addPost($this);
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removePost($this);
        }
        return $this;
    }
}
