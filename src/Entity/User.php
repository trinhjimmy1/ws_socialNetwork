<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(length: 255)]
    private ?string $birth_place = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $about = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $interest = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $languages = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_picture = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'user_profile', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $post;

    #[ORM\OneToMany(mappedBy: 'user_profile', targetEntity: PostLike::class)]
    private Collection $post_likes;

    #[ORM\OneToMany(mappedBy: 'user_profile', targetEntity: PostComment::class)]
    private Collection $postComments;

    #[ORM\OneToMany(mappedBy: 'user_profile', targetEntity: PostImage::class)]
    private Collection $postImages;

    #[ORM\ManyToMany(targetEntity: Friendship::class, mappedBy: 'profile_request')]
    private Collection $profile_request;

    #[ORM\ManyToMany(targetEntity: Friendship::class, mappedBy: 'profile_accept')]
    private Collection $profile_accept;

    public function __construct()
    {
        $this->post = new ArrayCollection();
        $this->post_likes = new ArrayCollection();
        $this->postComments = new ArrayCollection();
        $this->postImages = new ArrayCollection();
        $this->profile_request = new ArrayCollection();
        $this->profile_accept = new ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birth_place;
    }

    public function setBirthPlace(string $birth_place): self
    {
        $this->birth_place = $birth_place;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getInterest(): ?string
    {
        return $this->interest;
    }

    public function setInterest(?string $interest): self
    {
        $this->interest = $interest;

        return $this;
    }

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(?string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getUserPicture(): ?string
    {
        return $this->user_picture;
    }

    public function setUserPicture(?string $user_picture): self
    {
        $this->user_picture = $user_picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(Post $post): self
    {
        if (!$this->post->contains($post)) {
            $this->post->add($post);
            $post->setUserProfile($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUserProfile() === $this) {
                $post->setUserProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike>
     */
    public function getPostLikes(): Collection
    {
        return $this->post_likes;
    }

    public function addPostLike(PostLike $postLike): self
    {
        if (!$this->post_likes->contains($postLike)) {
            $this->post_likes->add($postLike);
            $postLike->setUserProfile($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): self
    {
        if ($this->post_likes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getUserProfile() === $this) {
                $postLike->setUserProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostComment>
     */
    public function getPostComments(): Collection
    {
        return $this->postComments;
    }

    public function addPostComment(PostComment $postComment): self
    {
        if (!$this->postComments->contains($postComment)) {
            $this->postComments->add($postComment);
            $postComment->setUserProfile($this);
        }

        return $this;
    }

    public function removePostComment(PostComment $postComment): self
    {
        if ($this->postComments->removeElement($postComment)) {
            // set the owning side to null (unless already changed)
            if ($postComment->getUserProfile() === $this) {
                $postComment->setUserProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostImage>
     */
    public function getPostImages(): Collection
    {
        return $this->postImages;
    }

    public function addPostImage(PostImage $postImage): self
    {
        if (!$this->postImages->contains($postImage)) {
            $this->postImages->add($postImage);
            $postImage->setUserProfile($this);
        }

        return $this;
    }

    public function removePostImage(PostImage $postImage): self
    {
        if ($this->postImages->removeElement($postImage)) {
            // set the owning side to null (unless already changed)
            if ($postImage->getUserProfile() === $this) {
                $postImage->setUserProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Friendship>
     */
    public function getProfileRequest(): Collection
    {
        return $this->profile_request;
    }

    public function addProfileRequest(Friendship $profileRequest): self
    {
        if (!$this->profile_request->contains($profileRequest)) {
            $this->profile_request->add($profileRequest);
            $profileRequest->addProfileRequest($this);
        }

        return $this;
    }

    public function removeProfileRequest(Friendship $profileRequest): self
    {
        if ($this->profile_request->removeElement($profileRequest)) {
            $profileRequest->removeProfileRequest($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Friendship>
     */
    public function getProfileAccept(): Collection
    {
        return $this->profile_accept;
    }

    public function addProfileAccept(Friendship $profileAccept): self
    {
        if (!$this->profile_accept->contains($profileAccept)) {
            $this->profile_accept->add($profileAccept);
            $profileAccept->addProfileAccept($this);
        }

        return $this;
    }

    public function removeProfileAccept(Friendship $profileAccept): self
    {
        if ($this->profile_accept->removeElement($profileAccept)) {
            $profileAccept->removeProfileAccept($this);
        }

        return $this;
    }
}
