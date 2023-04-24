<?php

namespace App\Controller\admin;
use App\Entity\Competition;
use App\Form\Admin\CompetitionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ComeptitionController extends AbstractController
{
     public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/admin/comeptition', name: 'app_admin_comeptition')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $competition = new competition() ;
    $form = $this->createForm(CompetitionType::class, $competition);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

 
         $this->em->persist($competition);
         $this->em->flush();

        $this->addFlash('success','competition successfully created' );

        return $this->redirectToRoute('app_admin_competition_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new competition : END 
     
    $competition = $this->em->getRepository(competition::class)->findAll() ;
     return $this->render('admin/comeptition/index.html.twig', [
        'form' => $form->createView(),
        'competition' => $competition,
     ]);
    }
}
