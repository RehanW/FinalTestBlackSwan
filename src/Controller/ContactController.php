<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contactpage')]
    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, MailerService $mailerService): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($contact);
            $entityManager->flush();

            $emailA = $mailerService->notifyAdmin($contact);
            $emailC = $mailerService->notifyClient($contact);

            $mailer->send($emailA);
            $mailer->send($emailC);

            return new Response('Contact id = ' . $contact->getId() . ' has been created for subscriber ' . $contact->getFirstName());
        }

        return new Response($twig->render('contact/index.html.twig', [
            'contact_form' => $form->createView()
        ]));
    }

    public function new(MailerService $mailer)
    {
        $contact = new Contact();

        if ($mailer->notifyClient($contact)){
            $this->addFlash('success', 'Notification mail was sent successfully!');
        }

        if ($mailer->notifyAdmin($contact)){
            $this->addFlash('success', 'Notification mail was sent successfully!');
        }

    }

}
