<?php

namespace App\Controller;

use App\Entity\Commandes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];

        // Récupérer l'utilisateur actuel
    $user = $this->getUser();
    
    // Récupérer toutes les commandes de l'utilisateur
    $jeuxCommandes = $entityManager->getRepository(Commandes::class)->findBy(['user' => $user]);
    
    // Calculer le prix total
    $prixTotal = 0;
    foreach ($jeuxCommandes as $commande) {
        // Utiliser getIdJeux() pour accéder à l'objet Jeux associé à chaque commande
        $prixTotal += $commande->getIdJeux()->getPrix() * $commande->getNombresCommandes();
        }

        return $this->render('panier/index.html.twig', [
            'jeuxCommandes' => $jeuxCommandes,
            'prixTotal' => $prixTotal,
            'menuItems' => $menuItems
        ]);
    }
}
