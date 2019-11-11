<?php

namespace App\Entity;

class PostsSearch {

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(?string $tag): void
    {
        $this->tag = $tag;
    }

}