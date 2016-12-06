<?php

namespace ScayTrase\Symfony\Sample\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class User implements UserInterface, EquatableInterface
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     * @ORM\Column(type="string")
     */
    private $username = '';

    /**
     * @var string[]
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $password = '';

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $nickname = '';

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /** {@inheritdoc} */
    public function isEqualTo(UserInterface $user)
    {
        if ($user->getUsername() !== $this->getUsername()) {
            return false;
        }

        $r1 = $this->getRoles();
        $r2 = $user->getRoles();
        sort($r1);
        sort($r2);

        return $r1 === $r2;
    }

    /** {@inheritdoc} */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param \string[] $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /** {@inheritdoc} */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /** {@inheritdoc} */
    public function getSalt()
    {
        return null;
    }

    /** {@inheritdoc} */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /** {@inheritdoc} */
    public function eraseCredentials()
    {
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function __toString()
    {
        return $this->nickname;
    }
}
