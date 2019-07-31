<?php

namespace App\Entity;

use App\Tests\Unit\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRepository")
 * @ORM\Table(
 *     name="feedback",
 * )
 */
class Feedback extends AbstractEntity
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Asserts\NotBlank()
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Asserts\NotBlank()
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Asserts\NotBlank()
     */
    private $content;

    public function __construct(array $data = null)
    {
        $this->createdAt = $this->updatedAt = new \DateTime();
        parent::__construct($data);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * @param string $name
     * @return Feedback
     */
    public function setName(string $name = null): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return (string)$this->phone;
    }

    /**
     * @param string $phone
     * @return Feedback
     */
    public function setPhone(string $phone = null): self
    {
        $this->phone = $phone;
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
     * @return Feedback
     */
    public function setContent(string $content = null): self
    {
        $this->content = $content;
        return $this;
    }
}
