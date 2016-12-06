<?php

namespace ScayTrase\Symfony\Sample\Blog\Controller;

use ScayTrase\Symfony\Sample\Blog\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

final class AuthController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @Template()
     * @param Request $request
     *
     * @return array
     */
    public function registerAction(Request $request)
    {
        $builder = $this->createFormBuilder(new User());
        $builder->add('username', TextType::class, ['empty_data' => '']);
        $builder->add('password', TextType::class, ['empty_data' => '']);
        $builder->add('nickname', TextType::class, ['empty_data' => '']);

        $form = $builder->getForm();
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                /** @var User $user */
                $user = $form->getData();
                $user->setRoles(['ROLE_AUTHOR']);
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('login');
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/login", name="login")
     * @Template()
     *
     * @return array
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];
    }
}
