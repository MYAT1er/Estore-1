<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MenuController extends AbstractController
{
    #[Route('/', name: 'menu')]
    public function index(EntityManagerInterface $em,UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $user->setEmail('Admin@gmail.com')->setUsername('Lelouch')->setAdresseDeLivraison('Benin')->setPassword($hasher->hashPassword($user, '2000'))->setRoles(['ROLE_ADMIN']);
        
        $em->persist($user);
        $em->flush();
        
        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'panier'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];
        return $this->render('menu/index.html.twig', [
            'menuItems' => $menuItems
        ]);
    }


    #[Route('/shop', name: 'panier')]
    public function shop(Request $request, JeuxRepository $jeuxRepository, PaginatorInterface $paginator): Response
    {
   
            $jeux = $jeuxRepository->findAll();

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'panier'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];

        $pagination = $paginator->paginate(
            $jeux, // Query simple pour récupérer tous les jeux
            $request->query->getInt('page', 1), // Numéro de la page. Par défaut: 1
            9 // Nombre d'éléments par page
        );
        return $this->render('menu/shop.html.twig', [
            'menuItems' => $menuItems,
            'jeux' => $jeux,
            'pagination' => $pagination,
        ]);
    }


    #[Route('/propos', name: 'propos')]
    public function propos(): Response
    {
        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'panier'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];
        return $this->render('menu/propos.html.twig', [
            'menuItems' => $menuItems
        ]);
    }


    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
       
        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'panier'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];
        
        return $this->render('menu/profil.html.twig', [
            'menuItems' => $menuItems
        ]);
    }
}
