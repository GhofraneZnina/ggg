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
    #[Route('/admin/planning/{saisonId}', name: 'app_admin_planning_list')]
    public function index(Request $request, int $saisonId): Response
    {
       
    $saison = $this->em->getRepository(Saison::class)->find($saisonId);
    //create 
    $plannings = new Planning() ;
    $plannings->setSaison($saison);
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
        
        return $this->redirectToRoute('app_admin_planning_list', ['saisonId' => $saisonId]) ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new cotisation : END 
    
     
     $plannings = $this->em->getRepository(Planning::class)->findBy(['saison' => $saisonId]); 
    
     return $this->render('admin/planning/index.html.twig', [
        'form' => $form->createView(),
        'planning' => $plannings,
        'saison'=>$saison,
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
     #[Route('/admin/planning/pagePlanning/{id}', name: 'app_admin_planning_page')]
    
         public function planning(int $id,Request $request): Response
         {   
            $planning = $this->em->getRepository(Planning::class)->findOneBy(['id'=>$id]);
            $seances = $this->em->getRepository(Seance::class)->findBy(['planning' => $planning]);

            // Define a custom comparison function to sort the seances by dateDebut and dateFin
            usort($seances, function($a, $b) {
                if ($a->getHoraireDebut() === $b->getHoraireFin()) {
                    return $a->getHoraireFin() <=> $b->getHoraireFin();
                }
                return $a->getHoraireDebut() <=> $b->getHoraireDebut();
            });
            
            // Retrieve the Saison entity associated with the given planning ID
            $saison = $this->em->getRepository(Saison::class)->find($id);
            
            // Extract unique jours from the seances and sort them
            $jours = array_unique(array_map(function($seance) {
                return $seance->getJour();
            }, $seances));
            sort($jours);
            
            // Create a new Seance entity and form
             //create 
         $seance = new Seance() ;
         
        $seance->setPlanning($planning);
         $form = $this->createForm(SeanceType::class, $seance);
           $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $data = $request->request->all() ;

            
    
             $this->em->persist($seance);
             $this->em->flush();

            $this->addFlash('success','seance successfully created' );

             return $this->redirectToRoute('app_admin_planning_page' , ['id' => $id]) ;
            
     } else if ($form->isSubmitted() && !$form->isValid()) {

        $this->addFlash('error','check your data');
  }
    //  //  TODO : create new seance : END 

         return $this->render('admin/Planning/pagePlanning.html.twig', [
                'seances' => $seances,
                'jours' => $jours,
                'planning'=>$planning,
                'saison' => $saison,
                'form' => $form->createView(),
             ]);

     }
        ////////////////////////////////////////////////////////////// */
//         function filterByDay(Planning $planning, $day) {
            
//             return $planning->getDate() == $day;
//         }
//          #[Route('/admin/planning/pagePlanningg/{saisonId}', name: 'app_admin_planningg_page')]
//         public function showSeasonPlanningAction($saisonId)
// {
//      // Get the season based on the ID passed in the URL
//      $saison = $this->em->getRepository(Saison::class)->find($saisonId);

//      // Get the planning for the season
//      $planning = $this->em->getRepository(Planning::class)->findBySaison($saison);
     
//      // Get the seances for the planning
//      $seances = $this->em->getRepository(Seance::class)->findBy(['planning' => $planning]);
 
//      // Pass the season, planning, and seances data to the Twig template
//      return $this->render('admin/planning/seasonPlanning.html.twig', [
//          'saison' => $saison,
//          'planning' => $planning,
//          'seances' => $seances,
//      ]);
    
// } 




}


?>