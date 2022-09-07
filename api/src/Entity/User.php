<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; // allows to make a constraint to a propriety
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @method string getUserIdentifier()
 * @UniqueEntity(
 *  fields={"email"},
 *  message="This email exist already"
 * ) 
 */

class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\Identifiant
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Your password must have 8 or more characters")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity=Subscriber::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $subscriber;

    public $confirm_password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function isRole(): ?bool
    {
        return $this->role;
    }

    public function setRole(bool $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getSubscriber(): ?Subscriber
    {
        return $this->subscriber;
    }

    public function setSubscriber(Subscriber $subscriber): self
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->getIdentifiant();
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }

    public function serialize()
    {
        return serialize([
            $this->getId(),
            $this->getEmail(),
            $this->getPassword()
        ]);
    }

    public function unserialize($data)
    {
        list($this->id, $this->email, $this->password) =
            unserialize($data, ['allowed_classes' => false]);
    }
}