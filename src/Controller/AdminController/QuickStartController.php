<?php

namespace App\Controller\AdminController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/espace-admin')]
final class QuickStartController extends AbstractController
{
    #[Route('/', name: 'quick_start')]
    public function quick_start(): Response
    {
        return $this->render('admin/quickStart.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
