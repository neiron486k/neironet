<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assets;
use Fresh\VichUploaderSerializationBundle\Annotation as Fresh;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 * @ORM\Table(name="user_profiles")
 * @Vich\Uploadable
 * @Fresh\VichSerializableClass
 */
class UserProfile implements \Serializable
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

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Fresh\VichSerializableField("avatarFile")
     */
    private $avatar;

    /**
     * @var File
     * @Vich\UploadableField(mapping="images", fileNameProperty="avatar")
     * @Assets\NotBlank(groups={"create"})
     */
    private $avatarFile;

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
    public function getAvatar(): string
    {
        return (string)$this->avatar;
    }

    /**
     * @param string $avatar
     * @return UserProfile
     */
    public function setAvatar(string $avatar = null): self
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return File
     */
    public function getAvatarFile(): ?File
    {
        return $this->avatarFile;
    }

    /**
     * @param File $avatarFile
     * @return UserProfile
     */
    public function setAvatarFile(File $avatarFile = null): self
    {
        $this->avatarFile = $avatarFile;

        if ($avatarFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->id,
        ]);
    }

    public function unserialize($serialized): void
    {
        list ($this->id) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return trim((string)$this->getFirstName() . ' ' . $this->getLastName());
    }
}
