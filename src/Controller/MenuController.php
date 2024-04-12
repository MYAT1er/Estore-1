<?php

namespace App\Controller;

use App\Repository\JeuxRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(): Response
    {
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
