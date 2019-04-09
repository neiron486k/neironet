<?php

namespace App\Entity\Translation;

use App\Entity\AbstractEntity;
use App\Entity\Article;
use App\Traits\TranslationInterface;
use App\Traits\TranslationTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleTranslation
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="article_translations")
 */
class ArticleTranslation implements TranslationInterface
{
    use TranslationTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="translations")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $article;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
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
     * @return ArticleTranslation
     */
    public function setTitle(string $title): self
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
     * @return ArticleTranslation
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return ArticleTranslation
     */
    public function setArticle(Article $article): self
    {
        $this->article = $article;
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
     * @return ArticleTranslation
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}