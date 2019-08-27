<?php

namespace App\EntityListener;

use App\Entity\Comment;
use App\Entity\Post;
use Symfony\Component\Security\Core\Security;

class CommentListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Comment $comment)
    {
        $comment->setUser($this->security->getUser());
    }
}
