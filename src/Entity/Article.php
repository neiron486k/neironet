<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Translation\ArticleTranslation;
use App\Traits\TranslatableInterface;
use App\Traits\TranslatableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"article"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
 */
class Article implements TranslatableInterface
{
    use TranslatableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"article"})
     */
    private $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @var ArticleTranslation
     * @ORM\OneToMany(targetEntity="App\Entity\Translation\ArticleTranslation", mappedBy="article", cascade={"all"})
     * @Assert\Valid
     */
    protected $translations;

    public function __construct()
    {
        $this->isPublished = false;
        $this->translations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     * @Groups({"article"})
     */
    public function getTitle(): string
    {
        return (string)$this->getTranslation()->getTitle();
    }

    /**
     * @return string
     * @Groups({"article"})
     */
    public function getDescription(): string
    {
        return (string)$this->getTranslation()->getDescription();
    }

    /**
     * @return string
     * @Groups({"article"})
     */
    public function getContent(): string
    {
        return (string)$this->getTranslation()->getContent();
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $isPublished
     * @return Article
     */
    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;
        return $this;
    }

}
