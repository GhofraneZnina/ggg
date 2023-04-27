<?php

namespace App\Controller\Admin;
use App\Entity\Competition;
use App\Form\Admin\CompetitionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CompetitionController extends AbstractController
{
     public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/admin/competition', name: 'app_admin_comeptition')]
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
        $data = $request->request->all();

        $dateDebut = str_replace('/', '-', $data['competition']['dateDebut']);
        $dataTimeDebut = new \DateTime($dateDebut);
        $competition->setDateDebut($dataTimeDebut);
        
        $dateFin = str_replace('/', '-', $data['competition']['dateFin']);
        $dataTimeFin = new \DateTime($dateFin);
        $competition->setDateFin($dataTimeFin);
 
         $this->em->persist($competition);
         $this->em->flush();

        $this->addFlash('success','competition successfully created' );

        return $this->redirectToRoute('app_admin_competition_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new competition : END 
     
    $competition = $this->em->getRepository(Competition::class)->findAll() ;
     return $this->render('admin/competition/index.html.twig', [
        'form' => $form->createView(),
        'competition' => $competition,
     ]);
    }
    #[Route('/admin/competition/{id}/delete', name: 'app_admin_competition_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $competitionRepository = $this->em->getRepository(CotisationAnnuelle::class);
       
        $competiton =$competitionRepository->find(['id'=>$id]);;
        if (!$competiton) {
            return $this->redirectToRoute('app_admin_competition_list');
        }

      
        $this->em->remove($competiton);
        $this->em->flush();
        
        
        $this->addFlash('success','competition successfully deleted ' );
        return $this->redirectToRoute('app_admin_competition_list');
    }
}
