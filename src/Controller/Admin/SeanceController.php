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
        $data = $request->request->all() ;

       

 
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


    }
    #[Route('/admin/seance/{id}/delete', name: 'app_admin_seance_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $seanceRepository = $this->em->getRepository(Seance::class);
       
        $seance =$seanceRepository->find(['id'=>$id]);
        if (!$seance) {
            return $this->redirectToRoute('app_admin_planning_list');
        }

      
        $this->em->remove($seance);
        $this->em->flush();
        
        
        $this->addFlash('success','seance successfully deleted ' );
        return $this->redirectToRoute('app_admin_seance_list');
    }

    #[Route('/admin/seance/{id}/edit', name: 'app_admin_seance_edit')]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, $id): Response
    {
       
        $seance = $this->em->getRepository(Seance::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $seance = $form->getData();
            $this->em->persist($seance);
            $this->em->flush();

            $this->addFlash('success', 'Seance successfully updated');

            return $this->redirectToRoute('app_admin_seance_list');
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', $seance);
        }

        return $this->render('admin/Nageur/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
