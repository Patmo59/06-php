<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Repository\VilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route("/ville")]
class VilleController extends AbstractController
{
    #[Route('/add', name: 'addVille')]
    public function create(ManagerRegistry $doc): Response
    {
        $em = $doc -> getManager();
        $ville = new Ville();
        $ville ->setNom("Lille")
            ->setPopulation(234475)
            ->setCreatedAt(new \DateTimeImmutable());
    $em ->persist($ville);
        $ville2 = new Ville();
        $ville2 ->setNom("Nice")
            ->setPopulation(342669)
            ->setCreatedAt(new \DateTimeImmutable());
    $em ->persist($ville2);
    $em ->flush();
        return $this->render('ville/index.html.twig', [
            'controller_name' => 'VilleController',
        ]);
    }
   
    #[Route("/name/{name<[^\d]}/{nb?1}", name:"readVilleName")]
    public function readByName(VilleRepository $repo,$nb,$name): Response
        {
            if($nb >1)
            {
                $ville = $repo ->findBy(["nom" =>$name], [], $nb);
                return $this ->render("ville/index.html.twig", ["ville"=>$ville]);
            }
                $ville = $repo ->findOneBy(["nom" =>$name]);
                return $this->render("ville/detail.html.twig",["ville" =>$ville]);
        } 
    #[Route("/detail/{id<\d+>}", name:"detailVille")]
    public function detail(ville $ville=null):Response
    {
        if(!$ville) return $this ->redirectToRoute("readville");
        return $this ->render("ville/detail.html.twig", ["ville"=> $ville]);
    }
    #[Route("/delete/{id<\d+>}", name:"deleteVille")]
public function delete(Ville $ville=null, ManagerRegistry $doc):Response
{
    if($ville)
    {
        $em = $doc ->getManager();
        $em ->remove($ville);
        $em ->flush();
    }
    return $this -> redirectToRoute("readVille");
}

    #[Route("/{page?<\d+>1}/{nb<\d+>?5}", name:"readVille")]
    public function read(VilleRepository $repo, $nb, $page):Response
    {
        // $repo = $doc ->getRepository(Ville::class);
        // $villes = $repo ->findAll();
        $villes = $repo ->findBy([], [], $nb, ($page-1)*$nb);
                $total = $repo ->count([]);
                $nbPage = ceil($total/$nb);
        return $this ->render("ville/index.html.twig",[
            "villes" =>  $villes,
            "nbPage"=>$nbPage,
            "nombre"=>$nb,
            "page"=>$page
        ]);
    }
}