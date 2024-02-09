<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $formContact = $this->createForm(ContactType::class);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contactData = $formContact->getData();

            // https://symfony.com/doc/current/mailer.html :
            $email = (new Email()) //use Symfony\Component\Mime\Email;
                ->from( $contactData['email'] )
                ->to('conact@test.com')
                ->subject($contactData['sujet'])
                ->text($contactData['message'])
                ->html('<p>' . $contactData['message'] . '</p>');

            $mailer->send($email);

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact,
        ]);
    }
}
