<?php

namespace App\EntityListener;

use App\Entity\Post;
use Symfony\Component\Security\Core\Security;

class PostListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Post $post)
    {
        return $post->setUser($this->security->getUser());
    }
}
