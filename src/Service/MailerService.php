<?php

namespace App\Service;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private string $mailFrom;
    private string $adminMail;

    public function __construct(MailerInterface $mailer, string $mailFrom, string $adminMail)
    {
        $this->mailer = $mailer;
        $this->mailFrom = $mailFrom;
        $this->adminMail = $adminMail;
    }

    public function notifyAdmin(Contact $contact) {
        $id = $contact->getId();
        $mail = (new Email())
            ->to($this->adminMail)
            ->from($this->mailFrom)
            ->subject('NEW CONTACT HAS BEEN ADDED')
            ->html("New Contact has been created with ID {$id}");

        return $mail;
    }

    public function notifyClient(Contact $contact){
        $address = $contact->getEmail();
        $mail = (new Email())
            ->to($address)
            ->from($this->mailFrom)
            ->subject('SIGN UP SUCCESS')
            ->html('<p>Thank you for signing up with our news provider!</p>');

        return $mail;
    }

    /**
     * @return string
     */
    public function getAdminMail(): string
    {
        return $this->adminMail;
    }

    /**
     * @param string $adminMail
     */
    public function setAdminMail(string $adminMail): void
    {
        $this->adminMail = $adminMail;
    }
    /**
     * @return string
     */
    public function getMailFrom(): string
    {
        return $this->mailFrom;
    }

    /**
     * @param string $mailFrom
     */
    public function setMailFrom(string $mailFrom): void
    {
        $this->mailFrom = $mailFrom;
    }
}