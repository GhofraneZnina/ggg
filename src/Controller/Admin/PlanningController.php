<?php

namespace App\Controller\Admin;

use App\Entity\Planning;
use App\Entity\Seance;
use App\Entity\Saison;
use App\Form\Admin\PlanningType;
use App\Form\Admin\SeanceType;
use App\Form\Admin\PlanningTypee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Controller\Admin\PlanningRepository;

class PlanningController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, )
    {
        ;
    }
    #[Route('/admin/planning', name: 'app_admin_planning_list')]
    public function index(Request $request): Response
    {
       
    $plannings = $this->em->getRepository(Planning::class)->findAll() ;
    //create 
    $plannings = new Planning() ;
    $form = $this->createForm(PlanningType::class, $plannings);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $data = $request->request->all() ;
        $date = str_replace('/','-',$data['planning']['date']) ;
        $dataTimeDate = new \DateTime($date);
        $plannings->setDate($dataTimeDate);
        
         $this->em->persist($plannings);
         $this->em->flush();

        $this->addFlash('success','planning successfully created' );

        return $this->redirectToRoute('app_admin_planning_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new cotisation : END 
     
    $plannings = $this->em->getRepository(Planning::class)->findAll() ;
     return $this->render('admin/planning/index.html.twig', [
        'form' => $form->createView(),
        'planning' => $plannings,
     ]);

    }

    #[Route('/admin/planning/create', name: 'app_admin_planning_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher,SluggerInterface $slugger): Response
    {
        $planning= new Planning();
        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->all() ;
            $date = str_replace('/','-',$data['planning']['date']) ;
            $dataTimeDate = new \DateTime($date);
            $planning->setDate($dataTimeDate);
            
           
            $planning = $form->getData();
           
                        
            $this->em->persist($planning);
            $this->em->flush();

            $this->addFlash('success','planning successfully created' );

            return $this->redirectToRoute('app_admin_planning_list') ;


        } 
        else if ($form->isSubmitted() && !$form->isValid()) {

            //dd($form->getData());
            $this->addFlash('error','check your data');

                $errors = $form->getErrors(true, true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

        return $this->render('admin/Planning/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/admin/planning/{id}/delete', name: 'app_admin_planning_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $planningRepository = $this->em->getRepository(Planning::class);
       
        $planning =$planningRepository->find(['id'=>$id]);
        if (!$planning) {
            return $this->redirectToRoute('app_admin_planning_list');
        }

      
        $this->em->remove($planning);
        $this->em->flush();
        
        
        $this->addFlash('success','planning successfully deleted ' );
        return $this->redirectToRoute('app_admin_planning_list');
    }
     //////////////
     #[Route('/admin/planning/pagePlanning', name: 'app_admin_planning_page')]
    
    
         /**
          * @Route("/planning", name="planning")
          */
         public function planning(Request $request): Response
         {
             $seances = $this->em->getRepository(Seance::class)->findAll();
          
            $jours = [];

             foreach ($seances as $seance) {
                $jours[] = $seance->getJour()->format('Y-m-d');
             }

            $jours = array_unique($jours);

            sort($jours);
             //create 
         $seance = new Seance() ;
         $form = $this->createForm(SeanceType::class, $seance);
           $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $data = $request->request->all() ;

             $jour = str_replace('/','-',$data['seance']['jour']) ;
            $dataTimeJour = new \DateTime($jour);
             $seance->setJour($dataTimeJour);

    
             $this->em->persist($seance);
             $this->em->flush();

            $this->addFlash('success','seance successfully created' );

             return $this->redirectToRoute('app_admin_planning_page') ;
     } else if ($form->isSubmitted() && !$form->isValid()) {

        //dd($form->getData());
        $this->addFlash('error','check your data');
  }
    //  //  TODO : create new seance : END 

         return $this->render('admin/Planning/pagePlanning.html.twig', [
                'seances' => $seances,
                'jours' => $jours,
                'form' => $form->createView(),
             ]);

     }
        ////////////////////////////////////////////////////////////// */
        

}


?>