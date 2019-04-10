<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\PublishedTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"article"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 *
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
 */
class Article
{
    use TimestampableEntity,
        PublishedTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"article"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Asserts\NotBlank()
     * @Groups({"article"})
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"article"})
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"article"})
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return (string)$this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title = null): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return (string)$this->description;
    }

    /**
     * @param string $description
     * @return Article
     */
    public function setDescription(string $description = null): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return (string)$this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent(string $content = null): self
    {
        $this->content = $content;
        return $this;
    }
}
