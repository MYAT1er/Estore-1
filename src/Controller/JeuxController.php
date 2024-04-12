<?php

namespace App\Controller;


use App\Entity\Jeux;
use App\Entity\Commandes;
use App\Form\JeuxType;
use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/jeux')]
class JeuxController extends AbstractController
{

    
    #[Route('/', name: 'app_jeux_index', methods: ['GET'])]
    public function index(JeuxRepository $jeuxRepository, Request $request): Response
    {     
        
            $jeux = $jeuxRepository->findAll();
        

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];

        return $this->render('jeux/index.html.twig', [
            'jeuxes' => $jeux,
            'menuItems' => $menuItems
        ]);
    }

    #[Route('/new', name: 'app_jeux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];


        $jeux = new Jeux();
        $form = $this->createForm(JeuxType::class, $jeux);
        $form->handleRequest($request);

        

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('photo_dir'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

    
                $jeux->setImage($newFilename);
            }

            $entityManager->persist($jeux);
            $entityManager->flush();   

            return $this->redirectToRoute('app_jeux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeux/new.html.twig', [
            'jeux' => $jeux,
            'form' => $form,
            'menuItems' => $menuItems
        ]);
    }

    #[Route('/{id}/commander', name: 'app_jeux_commander', methods: ['GET'])]
public function commander(Request $request, Jeux $jeu, EntityManagerInterface $entityManager): Response
{
    // Récupérer l'utilisateur actuellement connecté (vous pouvez adapter cela selon votre logique d'authentification)
    $user = $this->getUser();

    // Créer une nouvelle commande
    $commande = new Commandes();
    $commande->setIdJeux($jeu);
    $commande->setuser($user);

    // Récupérer la quantité depuis la requête
    $quantite = $request->request->get('quantite');

    // Vérifier si la quantité est null
    if ($quantite === null) {
        // Si la quantité est null, définir une valeur par défaut à 1
        $quantite = 1;
    }

    // Définir la quantité dans la commande
    $commande->setNombresCommandes($quantite);

    // Mettre à jour le stock du jeu
    $stockActuel = $jeu->getStockDisponible();
    $nouveauStock = $stockActuel - $commande->getNombresCommandes();
    $jeu->setStockDisponible($nouveauStock);

    // Enregistrer la commande dans la base de données
    $entityManager->persist($commande);
    $entityManager->flush();

    // Rediriger vers le panier
    return $this->redirectToRoute('panier');
}

    #[Route('/{id}', name: 'app_jeux_show', methods: ['GET'])]
    public function show(Jeux $jeux): Response
    {

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];

        return $this->render('jeux/show.html.twig', [
            'jeux' => $jeux,
            'menuItems' => $menuItems
        ]);
    }

    #[Route('/details/{id}', name: 'jeux_details', methods: ['GET'])]
    public function details(Jeux $jeux): Response
    {
        $stockDisponible = $jeux->getStockDisponible();
        $boutonTexte = ($stockDisponible > 0) ? 'Commander' : 'OutofStock';

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];


        return $this->render('details.html.twig', [
            'jeux' => $jeux,
            'boutonTexte' => $boutonTexte,
            'menuItems' => $menuItems
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jeux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Jeux $jeux, EntityManagerInterface $entityManager): Response
    {

        $menuItems=[
            ['label'=>'Accueil', 'route'=>'menu'],
            ['label'=>'Shop', 'route'=>'paniers'],
            ['label'=>'A propos', 'route'=>'propos'],
            ['label'=>'Profil', 'route'=>'profil']
        ];

        $form = $this->createForm(JeuxType::class, $jeux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_jeux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeux/edit.html.twig', [
            'jeux' => $jeux,
            'form' => $form,
            'menuItems' => $menuItems
        ]);
    }

    #[Route('/{id}', name: 'app_jeux_delete', methods: ['POST'])]
    public function delete(Request $request, Jeux $jeux, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeux->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($jeux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_jeux_index', [], Response::HTTP_SEE_OTHER);
    }
}
