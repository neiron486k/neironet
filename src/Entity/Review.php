<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"review"}},
 *     collectionOperations={"get"},
 *     itemOperations={}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ORM\Table(name="reviews")
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"review"})
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Groups({"review"})
     */
    public $content;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    public $user;

    public function getId(): ?int
    {
        return $this->id;
    }
}
