<?php

namespace App\Controller\AdminController;

use App\Entity\Roles;
use App\Form\RolesType;
use App\Repository\RolesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/espace-admin/roles')]
final class RolesController extends AbstractController
{
    #[Route('/', name: 'liste_roles')]
    public function index(Request $request, EntityManagerInterface $em, SessionInterface $session, RolesRepository $rolesRepository): Response
    {
        $session->set('menu', 'users_manage');
        $session->set('subMenu', 'roles');

        $role = new Roles();
        $form = $this->createForm(RolesType::class, $role);
        $form->handleRequest($request);
        
        return $this->render('admin/roles/liste.html.twig', [
            'roles' => $rolesRepository->findAll(),
            'new_form' => $form
        ]);
    }
}
