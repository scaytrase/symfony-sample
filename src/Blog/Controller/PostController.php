<?php

namespace ScayTrase\Symfony\Sample\Blog\Controller;

use ScayTrase\Symfony\Sample\Blog\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class PostController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     * @return array
     */
    public function indexAction()
    {
        return ['posts' => $this->getDoctrine()->getRepository(Post::class)->findAll()];
    }

    /**
     * @Template()
     *
     * @param Post $post
     *
     * @return array
     */
    public function showAction(Post $post)
    {
        return ['post' => $post];
    }
}
