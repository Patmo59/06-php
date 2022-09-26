<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route("/home")]
class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')] // on change le chemin  pour aller à la racine et le nom par "accueil"
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "fruits"=>["banane","tomate","cerise"],
            "pays"=>[
                "france"=>"bonjour le monde ! ",
                "angleterre"=>"hello word !",
            ],
            "chiffre"=>rand(0,10),
            "vide"=>[1]
        ]);
    }
    #[Route('/bonjour/{nom<^[a-zA-Z]+$>}/{prenom<^[a-zA-Z]+$>?Jean}', name:'bonjour')]
    public function bonjour($nom,$prenom, Request $request): Response
    {
        dump($request);
        // dump($nom, $prenom);
        // dd($nom, $prenom);
        return $this ->render("home/bonjour.html.twig", [
            "nom" =>$nom,
            "prenom"=>$prenom
        ]);
    }
    #[Route('/bonjour/anglais/{username}', name:'hello',
    defaults:["username"=>"Charles"],
    requirements: ["username" => "^[a-zA-Z]+$"])]
    
    public function hello($username): 
    RedirectResponse
    {
        dd($username);
        return $this ->redirectToRoute("bonjour", [
            "nom"=>"inconnu", "prenom"=> $username
        ]);
    }
}
