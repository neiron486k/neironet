<?php

namespace App\Entity;

use App\Traits\PublishedTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\Translatable\Translatable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Asserts;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Fresh\VichUploaderSerializationBundle\Annotation as Fresh;
use JMS\Serializer\Annotation as JMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="articles")
 * @Vich\Uploadable
 * @Fresh\VichSerializableClass
 * @JMS\ExclusionPolicy("all")
 * @UniqueEntity({"slug"})
 */
class Article implements Translatable
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
     * @ORM\Column(type="string")
     * @Asserts\NotBlank()
     * @Gedmo\Translatable
     * @JMS\Expose()
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(length=128, unique=true)
     * @JMS\Expose()
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     * @JMS\Expose()
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     * @JMS\Expose()
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Fresh\VichSerializableField("coverFile")
     * @JMS\Expose()
     */
    private $cover;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="cover")
     * @var File
     */
    private $coverFile;

    /**
     * @var ArticleType
     * @ORM\ManyToOne(targetEntity="ArticleType")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     * @JMS\Expose()
     */
    private $type;

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

    /**
     * @param File|null $cover
     * @return Article
     */
    public function setCoverFile(File $cover = null): self
    {
        $this->coverFile = $cover;

        if ($cover) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getCoverFile(): ?File
    {
        return $this->coverFile;
    }

    /**
     * @param string|null $cover
     * @return Article
     */
    public function setCover(string $cover = null): self
    {
        $this->cover = $cover;
        return $this;
    }

    public function getCover(): string
    {
        return (string)$this->cover;
    }

    /**
     * @return mixed
     */
    public function getSlug(): string
    {
        return (string)$this->slug;
    }

    /**
     * @param string $slug
     * @return Article
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return ArticleType
     */
    public function getType(): ArticleType
    {
        return $this->type;
    }

    /**
     * @param ArticleType $type
     * @return Article
     */
    public function setType(ArticleType $type): self
    {
        $this->type = $type;
        return $this;
    }
}
