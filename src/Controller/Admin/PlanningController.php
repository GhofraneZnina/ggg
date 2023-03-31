<?php

namespace App\Controller\Admin;

use App\Entity\Planning;
use App\Form\Admin\PlanningType;
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

class PlanningController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, )
    {
        ;
    }

    #[Route('/admin/planning/{id}/page', name: 'app_admin_planning_page')]
    public function pagePlanning($id, Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        // TODO : create new nageur : START
        $planning = new Planning();
        $form= $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $request->request->all();

            $date = str_replace('/', '-', $data['planning']['date']);
            $dataTimeDate = new \DateTime($date);



            //dump($dataTimeDate);
            //dd($$formPhysionomie->getData());
            $planning->setDate($dataTimeDate);
            
            //dump($dataTime);
           
            //dd($form->getData());
            $planning = $form->getData();
           
            $this->em->persist($planning);
            $this->em->flush();

            $this->addFlash('success','planning successfully created' );

            return $this->redirectToRoute('app_admin_planning_page') ;
        } else if ($form->isSubmitted() && !$form->isValid()) {
            dump($form);
           dd($form->getData());

            $this->addFlash('error','check your data');
         }
      
        // TODO : create nageur : END

        // TODO : edit nageur : START

        $planning = $this->em->getRepository(Planning::class)->findOneBy(['id' => $id]);
        $formEdit = $this->createForm(PlanningTypee::class, $planning);
        $formEdit->handleRequest($request);
        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
                $planning = $formEdit->getData();
               

                $this->em->persist($planning);
                $this->em->flush();

                $this->addFlash('success', 'password successfully updated');

                return $this->redirectToRoute('app_admin_planning_page', ['id' => $id]);
        }
        else if ($formEdit->isSubmitted() && !$formEdit->isValid()) {
                $this->addFlash('error', ' : Planning already exists ! ');

        }


        // TODO : edit nageur : END
        //adding physionomie


            //listing nageur
        $plannings = $this->em->getRepository(Planning::class)->findOneBy(['id' => $id]);
        if (!$plannings) {
            return $this->redirectToRoute('app_admin_planning_page');
         }


        return $this->render('admin/nageur/pagePlanning.html.twig', [
        'plannings' => $planning,
        'form' => $form->createView(),
        'formEdit' => $formEdit->createView(),
        
        ]);

              
    }


    


}




?>