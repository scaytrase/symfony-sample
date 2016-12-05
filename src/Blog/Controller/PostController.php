<?php

namespace ScayTrase\Symfony\Sample\Blog\Controller;

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
        return [];
    }
}
