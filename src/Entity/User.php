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
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
    * @var string
    */

    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="user")
     */
    private $UserPosts;

    public function __construct()
    {
        $this->UserPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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
    public function getUserPosts(): Collection
    {
        return $this->UserPosts;
    }

    public function addUserPosts(Post $UserPosts): self
    {
        if (!$this->UserPosts->contains($UserPosts)) {
            $this->UserPosts[] = $UserPosts;
            $UserPosts->setUserId($this);
        }

        return $this;
    }

    public function removeUserPosts(Post $UserPosts): self
    {
        if ($this->UserPosts->contains($UserPosts)) {
            $this->UserPosts->removeElement($UserPosts);
            // set the owning side to null (unless already changed)
            if ($UserPosts->getUserId() === $this) {
                $UserPosts->setUserId(null);
            }
        }

        return $this;
    }
}
