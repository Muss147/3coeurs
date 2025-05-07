<?php 

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestMailController extends AbstractController
{
    #[Route('/test-mail', name: 'test_mail')]
    public function test(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('hello@moussa-fofana.com')
            ->to('mfofana@aguimaagency.com')
            ->subject('Test d’envoi d’e-mail')
            ->text('Ceci est un test depuis Symfony.');

        $mailer->send($email);

        return new Response('E-mail envoyé avec succès !');
    }
}