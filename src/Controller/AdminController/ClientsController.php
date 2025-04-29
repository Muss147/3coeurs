<?php

namespace App\Controller\AdminController;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\ClientsType;
use App\Entity\Clients;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/espace-admin/clients')]
final class ClientsController extends AbstractController
{
    #[Route('/', name: 'liste_clients')]
    public function index(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $session->set('menu', 'clients');

        $client = new Clients();
        $formClient = $this->createForm(ClientsType::class, $client);
        $formClient->handleRequest($request);

        if ($formClient->isSubmitted() && $formClient->isValid()) {
            dd($client);
            $entityManager->persist($client);
            $entityManager->flush();

            $this->addFlash('success', 'Client ajouté avec succès.');
        }
        return $this->render('admin/clients/liste.html.twig', [
            'form_client' => $formClient,
        ]);
    }
}
