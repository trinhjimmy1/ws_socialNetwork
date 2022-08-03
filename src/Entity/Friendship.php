<?php

namespace App\Entity;

use App\Repository\FriendshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendshipRepository::class)]
class Friendship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'profile_request')]
    private Collection $profile_request;

    public function __construct()
    {
        $this->profile_request = new ArrayCollection();
        $this->profile_accept = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProfileRequest(): Collection
    {
        return $this->profile_request;
    }

    public function addProfileRequest(User $profileRequest): self
    {
        if (!$this->profile_request->contains($profileRequest)) {
            $this->profile_request->add($profileRequest);
        }

        return $this;
    }

    public function removeProfileRequest(User $profileRequest): self
    {
        $this->profile_request->removeElement($profileRequest);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getProfileAccept(): Collection
    {
        return $this->profile_accept;
    }

    public function addProfileAccept(User $profileAccept): self
    {
        if (!$this->profile_accept->contains($profileAccept)) {
            $this->profile_accept->add($profileAccept);
        }

        return $this;
    }

    public function removeProfileAccept(User $profileAccept): self
    {
        $this->profile_accept->removeElement($profileAccept);

        return $this;
    }
}
