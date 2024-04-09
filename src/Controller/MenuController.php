<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
    public function shop(): Response
    {
        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'panier'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];
        return $this->render('menu/shop.html.twig', [
            'menuItems' => $menuItems
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
