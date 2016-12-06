<?php

namespace ScayTrase\Symfony\Sample\Blog\Controller;

use ScayTrase\Symfony\Sample\Blog\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/post")
 */
final class ComposeController extends Controller
{
    /**
     * @Route("/create", name="post_create")
     * @Route("/edit/{post}", name="post_edit")
     * @Template()
     * @Security("is_granted('ROLE_AUTHOR')")
     * @param Request $request
     *
     * @return array
     */
    public function composeAction(Request $request, Post $post = null)
    {
        $post = $post ?: new Post($this->getUser());

        $builder = $this->createFormBuilder($post);
        $builder->add('title');
        $builder->add('body');
        $builder->add('slug');

        $form = $builder->getForm();
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $post = $form->getData();
                $this->getDoctrine()->getManager()->persist($post);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('index');
            }
        }

        return ['form' => $form->createView()];
    }
}
