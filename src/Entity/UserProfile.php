<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 * @ORM\Table(name="user_profiles")
 */
class UserProfile
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $middleNAme;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return (string)$this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserProfile
     */
    public function setFirstName(string $firstName = null): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return (string)$this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserProfile
     */
    public function setLastName(string $lastName = null): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMiddleNAme(): string
    {
        return (string)$this->middleNAme;
    }

    /**
     * @param string $middleNAme
     * @return UserProfile
     */
    public function setMiddleNAme(string $middleNAme = null): self
    {
        $this->middleNAme = $middleNAme;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return trim((string)$this->getFirstName() . ' ' . $this->getLastName());
    }
}
