<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"alias"}, message="There is already an account with this alias")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * * @Assert\Unique()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotNull()
     */
    private $alias;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     * * @Assert\NotCompromisedPassword
     */
    private $password;

    /**
    * @var string
     *  @Assert\NotBlank()
    */

    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="user")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user", cascade={"persist", "remove"})
     */
    private $comment;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->alias;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {   
        $this->password = $password;

        return $this;
    }


    public function getPlainPassword()
    {
        return  $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        return $this->plainPassword = $plainPassword;

    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here

    }

    /**
     * @return Collection|Post[]
     */
    public function getposts(): Collection
    {
        return $this->posts;
    }

    public function addposts(Post $posts): self
    {
        if (!$this->posts->contains($posts)) {
            $this->posts[] = $posts;
            $posts->setUserId($this);
        }

        return $this;
    }

    public function removeposts(Post $posts): self
    {
        if ($this->posts->contains($posts)) {
            $this->posts->removeElement($posts);
            // set the owning side to null (unless already changed)
            if ($posts->getUserId() === $this) {
                $posts->setUserId(null);
            }
        }

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(Comment $comment): self
    {
        $this->comment = $comment;

        // set the owning side of the relation if necessary
        if ($this !== $comment->getUser()) {
            $comment->setUser($this);
        }

        return $this;
    }
}
