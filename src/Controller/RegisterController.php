<?php

namespace App\Controller;

use App\Type\Form\Register;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher

    )
    {
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request)
    {
        $form = $this->formFactory->create(Register::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           $hashedPassword = $this->userPasswordHasher->hashPassword($form->getData(),$form->getData()->getPassword());
           $form->getData()->setPassword($hashedPassword);
           $this->entityManager->persist($form->getData());
           $this->entityManager->flush();
           return $this->redirectToRoute('app_login');
        }


        return $this->render('register/register.html.twig',[
            'form' => $form->createView()
        ]);
    }
}