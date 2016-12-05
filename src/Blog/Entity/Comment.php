<?php

namespace ScayTrase\Symfony\Sample\Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 */
class Comment
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @var Post
     * @ORM\ManyToOne(targetEntity="ScayTrase\Symfony\Sample\Blog\Entity\Post")
     */
    private $post;

    /**
     * @var UserInterface
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface")
     */
    private $author;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * Comment constructor.
     *
     * @param UserInterface $author
     * @param Post          $post
     */
    public function __construct(UserInterface $author, Post $post)
    {
        $this->id      = Uuid::uuid4();
        $this->created = new \DateTime();
        $this->author  = $author;
        $this->post    = $post;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @param Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return UserInterface
     */
    public function getAuthor(): UserInterface
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
}
