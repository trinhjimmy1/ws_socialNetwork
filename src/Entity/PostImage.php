<?php

namespace App\Entity;

use App\Repository\PostImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostImageRepository::class)]
class PostImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'postImages')]
    private ?Post $post = null;

    #[ORM\ManyToOne(inversedBy: 'postImages')]
    private ?User $user_profile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getUserProfile(): ?User
    {
        return $this->user_profile;
    }

    public function setUserProfile(?User $user_profile): self
    {
        $this->user_profile = $user_profile;

        return $this;
    }
}
