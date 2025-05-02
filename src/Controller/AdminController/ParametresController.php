<?php

namespace App\Controller\AdminController;

use App\Entity\Categories;
use App\Entity\Parametres;
use App\Form\CategoriesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ParametresController extends AbstractController
{
    #[Route('/categories', name: 'liste_categories')]
    public function categories(Request $request, EntityManagerInterface $entityManager, SessionInterface $session, SluggerInterface $slugger): Response
    {
        $session->set('menu', 'categories');
        $categories = $entityManager->getRepository(Categories::class)->findAll();

        $categorie = new Categories();
        $formCategorie = $this->createForm(CategoriesType::class, $categorie);
        $formCategorie->handleRequest($request);

        if ($formCategorie->isSubmitted() && $formCategorie->isValid()) {
            $libelle = $formCategorie->get('libelle')->getData();
            $categorie->setSlug($slugger->slug(strtolower($libelle)))->updatedTimestamps();
            $categorie->updatedUserstamps($this->getUser());

            $entityManager->persist($categorie);
            $entityManager->flush();
            $this->redirectToRoute('liste_categories');
        }
        return $this->render('admin/parametres/categories.html.twig', [
            'categories' => $categories,
            'new_categ' => $formCategorie
        ]);
    }

    #[Route('/parametres', name: 'liste_parametres')]
    public function parametres(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $session->set('menu', 'parametres');
        $parametres = $entityManager->getRepository(Parametres::class)->findAll();
        return $this->render('admin/parametres/index.html.twig', [
            'parametres' => $parametres,
        ]);
    }
}
