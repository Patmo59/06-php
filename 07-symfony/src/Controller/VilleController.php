<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Service\Mailer;
use App\Service\Uploader;
use App\Repository\VilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route("/ville")]
class VilleController extends AbstractController
{
    public function __construct(private Uploader $uploader){}
    #[Route('/add', name: 'addVille')]
    public function create(ManagerRegistry $doc, Request $request, Mailer $mailer): Response
    {
        $ville = new Ville();
        $form = $this ->createForm(VilleType::class, $ville);
        // $form ->remove("createdAt");
        $form ->handleRequest($request);
        if($form ->isSubmitted() && $form -> isValid())
        {
            $photo = $form ->get("photoFile") ->getData();
            if($photo)
            {
                $dir = $this ->getParameter("ville_directory");
                $ville ->setPhoto($this ->uploader ->uploadFile($photo, $dir));
            }
            // dump($ville);
            $em =$doc ->getManager();
            $em ->persist($ville);
            $em ->flush();
            $mailer ->sendEmail(content:" Une nouvelle vile est créee");

            $this -> addFlash("success", "Une nouvelle ville a été ajoutée");
            return $this ->redirectToRoute("readVille");
        }
        return $this->render('ville/create.html.twig', [
          'villeForm'=> $form ->createView(),
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
        return $this ->render("ville/detail.html.twig", 
        [
            "ville"=> $ville,
            "dirImage"=>$this ->getParameter("ville_directory")
        ]);
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
#[Route("update/{id<\d+>}", name:"updateVille")]
public function  update(Ville $ville =null, Request $req, ManagerRegistry $doc):Response
{
    if(!$ville)
    {
        $this ->addFlash("danger", "Aucune ville sélectionnée");
        return $this ->redirectToRoute("readVille");
    }
    $form = $this->createForm(VilleType::class, $ville);
    $form ->handleRequest($req);
    if($form -> isSubMitted())
    {
        $em =$doc ->getManager();
        $em ->persist($ville);
        $em -> flush();
        $this ->addFlash("success", "Votre ville a bien été éditée");
        return $this -> redirectToRoute("readVille");
    }
    return $this ->render("ville/create.html.twig",[
        "villeForm"=> $form ->createView()
    ]);
        
}
#[Route("/interval/{min<\d+>}/{max<\d+>}", name:"intervalVille")]
public function interval(VilleRepository $repo, $min, $max): Response
{
    $villes = $repo -> findByPopulationInterval($min,$max);
    return $this -> render("ville/index.html.twig",[
        "villes"=>$villes
    ]);
}
    #[Route("/{page<\d+>?1}/{nb<\d+>?5}", name:"readVille")]
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