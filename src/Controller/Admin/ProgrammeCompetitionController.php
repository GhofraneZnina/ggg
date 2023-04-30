<?php

namespace App\Controller\Admin;
use App\Entity\ProgrammeCompetition;
use App\Form\Admin\ProgrammeCompetitionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeCompetitionController extends AbstractController
{
     public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/admin/Programmecompetition', name: 'app_admin_programmeCompetition')]
    
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $programme = new programmeCompetition() ;
    $form = $this->createForm(ProgrammeCompetitionType::class, $programme);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $data = $request->request->all();
    
       
            $date = str_replace('/', '-', $data['programme_competition']['date']);
            $dataTime = new \DateTime($date);
            $programme->setDate($dataTime);
    
            $this->em->persist($programme);
            $this->em->flush();
    
            $this->addFlash('success','programme successfully created');
    
            return $this->redirectToRoute('app_admin_programmeCompetition');
        } 
   

       
     else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new competition : END 
     
    $programme = $this->em->getRepository(ProgrammeCompetition::class)->findAll() ;
     return $this->render('admin/ProgrammeCompetition/index.html.twig', [
        'form' => $form->createView(),
        'programme' => $programme,
     ]);
    }
    #[Route('/admin/programmeCompetition/{id}/delete', name: 'app_admin_programmeCompetition_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $programmeCompetitionRepository = $this->em->getRepository(ProgrammeCompetition::class);
       
        $programme =$programmeCompetitionRepository->find(['id'=>$id]);;
        if (!$programme) {
            return $this->redirectToRoute('app_admin_programmeCompetition');
        }

      
        $this->em->remove($programme);
        $this->em->flush();
        
        
        $this->addFlash('success','programme competition successfully deleted ' );
        return $this->redirectToRoute('app_admin_ProgrammeCompetition');
    }
}
