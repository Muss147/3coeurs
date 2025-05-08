<?php

namespace App\Controller\AdminController;

use App\Entity\Permissions;
use App\Form\PermissionsType;
use App\Repository\PermissionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/espace-admin/permissions')]
final class PermissionsController extends AbstractController
{
    #[Route('/', name: 'permissions')]
    public function list(Request $request, SessionInterface $session, PermissionsRepository $permissionsRepository, EntityManagerInterface $entityManager): Response
    {
        $session->set('menu', 'users_manage');
        $session->set('subMenu', 'permissions');
        
        $permission = new Permissions();
        $form = $this->createForm(PermissionsType::class, $permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $permission->generateSlug();
            $permission->updatedTimestamps();
            $permission->updatedUserstamps($this->getUser());

            $entityManager->persist($permission);
            // dd($permission);
            $entityManager->flush();

            $this->addFlash('success', 'Permission ajouté avec succès.');
            return $this->redirectToRoute('permissions', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin/roles/permissions.html.twig', [
            'new_permission' => $form,
            'permissions' => $permissionsRepository->findAll()
        ]);
    }
}
