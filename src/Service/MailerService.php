<?php

namespace App\Service;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notifyAdmin(Contact $contact) {
        $id = $contact->getId();
        $mail = (new Email())
            ->to('blackswantest.rehan@gmail.com')
            ->from('blackswantest.rehan@gmail.com')
            ->subject('NEW CONTACT HAS BEEN ADDED')
            ->html("New Contact has been created with ID {$id}");

        return $mail;
    }

    public function notifyClient(Contact $contact){
        $address = $contact->getEmail();
        $mail = (new Email())
            ->to($address)
            ->from('blackswantest.rehan@gmail.com')
            ->subject('SIGN UP SUCCESS')
            ->html('<p>Thank you for signing up with our news provider!</p>');

        return $mail;
    }

}