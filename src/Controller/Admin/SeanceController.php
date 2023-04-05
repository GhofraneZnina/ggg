<?php

namespace App\Controller\Admin;
use App\Entity\Seance;
use App\Form\Admin\SeanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class SeanceController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/seance', name: 'app_admin_seance_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $seance = new Seance() ;
    $form = $this->createForm(SeanceType::class, $seance);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

 
         $this->em->persist($seance);
         $this->em->flush();

        $this->addFlash('success','seance successfully created' );

        return $this->redirectToRoute('app_admin_seance_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new seance : END 
     
    $seance = $this->em->getRepository(Seance::class)->findAll() ;
     return $this->render('admin/seance/index.html.twig', [
        'form' => $form->createView(),
        'seance' => $seance,
     ]);





      
    #[Route('/admin/seance/create', name: 'app_admin_seance_create')]
    
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher,SluggerInterface $slugger): Response
    {
        $seance= new seance();
        $form = $this->createForm(seanceType::class, $seance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->all() ;
            $date = str_replace('/','-',$data['seance']['date']) ;
            $dataTimeDate = new \DateTime($date);
            $seance->setDate($dataTimeDate);
            
           
            $seance = $form->getData();
           
                        
            $this->em->persist($seance);
            $this->em->flush();

            $this->addFlash('success','seance successfully created' );

            return $this->redirectToRoute('app_admin_seance_list') ;


        } 
        else if ($form->isSubmitted() && !$form->isValid()) {

            //dd($form->getData());
            $this->addFlash('error','check your data');

                $errors = $form->getErrors(true, true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

        return $this->render('admin/seance/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    }


}
