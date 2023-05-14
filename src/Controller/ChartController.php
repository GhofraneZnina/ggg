<?php

namespace App\Controller;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Groupe;
use App\Repository\GroupeRepository;

use App\Entity\User;
use App\Repository\UserRepository;

use App\Entity\Planning;
use App\Repository\PlanningRepository;


use App\Entity\Entraineur;
use App\Repository\EntraineurRepository;

use App\Entity\Nageur;
use APP\Entity\Parents;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;



class ChartController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em) {
        ;
    }
    #[Route('/chart', name: 'app_chart')]
    public function statistiques(
        UserRepository $userRepo, EntraineurRepository $entraineurRepo,
        GroupeRepository $groupeRepo,
        EntityManagerInterface $entityManager
        ){

            $repository = $entityManager->getRepository(Groupe::class);
            $groupes = $repository->findAll();
       
            $users = $this->em->getRepository(User::class)->findAll();
            $plannings = $this->em->getRepository(Planning::class)->findAll();
            
        $categNom = [];
        $categColor = [];
        $borderColor= [];

        $categCount = [];

     
            foreach($groupes as $groupe){
         $categNom[] = $groupe->getIntitule();
       
        $categColor[] = [
            'rgb(255, 99, 132)'
        
        ];
        $borderColor[] ='rgb(255, 99, 132)';
       
         $categCount[] = count([0, 10, 5, 2, 20, 30, 45]);
        }
        
        //**** Begin Chart2 planningGraph planningsCount*/
        $planningsNom = [];
        $planningsColor = [];
        $borderColor= [];

        $planningsCount = [];

     
            foreach($plannings as $planning){
         $planningsNom[] = $planning->getLabel();
       
        $planningsColor[] = [
            'rgb(255, 99, 132)'
        
        ];
        $borderColor[] ='rgb(255, 99, 132)';
       
         $planningsCount[] = count([0, 10, 5, 2, 20, 30, 45]);
        }
     return $this->render('chart/index.html.twig', [
              'categNom' => json_encode($categNom),
              'categColor' => json_encode($categColor),
              'borderColor' => json_encode($borderColor),
              'categCount' => json_encode($categCount),

              'planningsNom' => json_encode($planningsNom),
              'planningsColor' => json_encode($planningsColor),
              'borderColor' => json_encode($borderColor),
              'planningsCount' => json_encode($planningsCount),
        ]);
    }

   

}
