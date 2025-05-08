<?php

namespace App\Controller\AdminController;

use App\Entity\Files;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\RolesRepository;
use App\Repository\UsersRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

#[Route('/espace-admin/users')]
final class UsersController extends AbstractController
{
    private $fileUploader;
    private $entityManager;
    private $slugger;
    private $mailer;
    private $resetPasswordHelper;

    public function __construct(FileUploader $fileUploader, EntityManagerInterface $entityManager, SluggerInterface $slugger, MailerInterface $mailer, ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->fileUploader = $fileUploader;
        $this->entityManager = $entityManager;
        $this->slugger = $slugger;
        $this->mailer = $mailer;
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    #[Route('/', name: 'liste_users')]
    public function list(Request $request, UsersRepository $usersRepository, RolesRepository $RolesRepository, SessionInterface $session): Response
    {
        $session->set('menu', 'users_manage');
        $session->set('subMenu', 'users');
        
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user, ['form_type' => 'add']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Verify if email is already exist
            $email = $form->get('email')->getData();
            if ($isExist = $usersRepository->findOneByEmail($email)) {
                if ($isExist->getDeletedAt()) $this->addFlash('error', 'L\'adresse email existe dans la corbeille. Veuillez vous rendre dans la corbeille pour la supprimer puis réessayer.');
                else $this->addFlash('error', 'L\'adresse email existe déjà. Réessayez avec une autre.');
                
                return $this->redirectToRoute('users_list', [], Response::HTTP_SEE_OTHER);
            }
            /** @var UploadedFile $profileFile */
            $profileFile = $form->get('avatar')->getData();
            // $token = bin2hex(random_bytes(32));
            if ($profileFile) {
                // dd($profileFile);
                // Utilisez le service pour uploader le fichier
                $file = $this->fileUploader->upload($profileFile); // 'images' est ici le sous-dossier de stockage

                // Créez une nouvelle instance de l'entité Files
                $fileEntity = new Files();
                $fileEntity->setFilename($file['filename']);
                $fileEntity->setType($file['type']);
                $fileEntity->setAlt('Avatar de ' . $user->getNomComplet());

                // Associez le fichier à l'utilisateur
                $user->setAvatar($fileEntity);

                // Persistez l'entité Files dans la base de données
                $this->entityManager->persist($fileEntity);
            }
            $user->updatedTimestamps();
            $user->updatedUserstamps($this->getUser());

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // Envoyer l'email de Bienvenue
            $activateToken = $this->resetPasswordHelper->generateResetToken($user);
            $this->sendPasswordResetEmail($user, $activateToken->getToken());

            $this->addFlash('success', 'L\'utilisateur a été ajouté avec succès. Un Email de confirmation lui a été envoyé sur son adresse pour confirmaer son compte.');
            return $this->redirectToRoute('users_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/users/liste.html.twig', [
            'users' => $usersRepository->findAll(),
            'roles' => $RolesRepository->findAll(),
            // 'user' => $user,
            'new_user' => $form,
        ]);
    }
    
    private function sendPasswordResetEmail(Users $user, string $token)
    {
        try {
            $email = (new Email())
                ->from('no-reply@pricing-tool.com', 'Pricing Tool')
                ->to($user->getEmail())
                ->subject('Bienvenue sur votre plateforme !')
                ->html($this->renderView('users/_email_activate.html.twig', [
                    'user' => $user,
                    'resetLink' => $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL)
                ]));

            $this->mailer->send($email);
        } catch (\Exception $e) {
            // Optionnellement, renvoyer une exception ou retourner une réponse spécifique
            throw new \RuntimeException('L\'envoi de l\'email a échoué, veuillez réessayer plus tard. Erreur : '. $e->getMessage());
        }
    }

}
