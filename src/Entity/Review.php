<?php

namespace App\Entity;

use App\Traits\PublishedTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ORM\Table(name="reviews")
 * @JMS\ExclusionPolicy("all")
 */
class Review
{
    use TimestampableEntity,
        PublishedTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Expose()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @JMS\Expose()
     */
    private $content;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     * @JMS\Expose()
     */
    private $user;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @JMS\Expose()
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @JMS\Expose()
     */
    protected $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return (string)$this->content;
    }

    /**
     * @param string|null $content
     * @return Review
     */
    public function setContent(string $content = null): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
