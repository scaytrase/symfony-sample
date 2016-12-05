<?php

namespace ScayTrase\Symfony\Sample\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Post
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var UserInterface
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface")
     */
    private $author;

    /**
     * @var \DateTime
     * @Assert\NotNull()
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $title = '';

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $body = '';

    /**
     * Post constructor.
     */
    public function __construct(UserInterface $author)
    {
        $this->created = new \DateTime();
        $this->id      = Uuid::uuid4();
        $this->author  = $author;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return UserInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param UserInterface $author
     */
    public function setAuthor(UserInterface $author)
    {
        $this->author = $author;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }
}
