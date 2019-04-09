<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ArticleTranslation
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="article_translations")
 */
class ArticleTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $description;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    public $content;
}