<?php

namespace App\Controller\Admin;

use App\Entity\Nageur;
use App\Form\Admin\NageurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class NageurController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/nageur', name: 'app_admin_nageur_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    $nageurs = $this->em->getRepository(Nageur::class)->findAll() ;

         return $this->render('admin/nageur/index.html.twig', [
             'nageurs' => $nageurs,
         ]);
     } 

     #[Route('/admin/nageur/create', name: 'app_admin_nageur_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
           return $this->redirectToRoute('login') ;
        }
        $nageur = new Nageur() ;
        $nageur->setRoles([Nageur::ROLE_NAGEUR])  ;
        $nageur->setStatus(Nageur::STATUT_ACTIF);

        $form = $this->createForm(NageurType::class, $nageur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->all() ;

            $dateDebutActiviteSportive = str_replace('/','-',$data['nageur']['dateDebutActiviteSportive']) ;
            $dataTimeDebutActiviteSportive = new \DateTime($dateDebutActiviteSportive);

            $dateLicence = str_replace('/','-',$data['nageur']['dateLicence']) ;
            $dataTimeLicence = new \DateTime($dateLicence);

            $dateNaissance = str_replace('/','-',$data['nageur']['dateNaissance']) ;
            $dataTimeDateNaissance = new \DateTime($dateNaissance);

            

            //dump($dataTime);
            $nageur->setDateDebutActiviteSportive($dataTimeDebutActiviteSportive);
            $nageur->setDateLicence($dataTimeLicence);
            $nageur->setDateNaissance($dataTimeDateNaissance);
            //dd($form->getData());
            $nageur = $form->getData();
            $chekUser = $this->em->getRepository(Nageur::class)->findOneByLogin($nageur->getLogin());
            if($chekUser){
                $this->addFlash('error',$nageur->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_nageur_list');
            }
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($nageur, $password);
            $nageur->setPassword($password);

            $this->em->persist($nageur);
            $this->em->flush();

            $this->addFlash('success','nageur successfully created' );

            return $this->redirectToRoute('app_admin_nageur_list') ;
        } else if ($form->isSubmitted() && !$form->isValid()) {

           // dd($form->getData());
            $this->addFlash('error','check your data');
         }
 
        return $this->render('admin/Nageur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

     #[Route('/admin/nageur/{id}/edit', name: 'app_admin_nageur_edit')]
     public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
     {
         if (!$this->getUser()) {
             return $this->redirectToRoute('login') ;
         }
         $nageur = $this->em->getRepository(Nageur::class)->findOneBy(['id'=>$id]);


         $form = $this->createForm(NageurType::class, $nageur);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $nageur = $form->getData();
             $chekUser = $this->em->getRepository(Nageur::class)->findOneByLogin($nageur->getLogin());
             if( $chekUser and $chekUser->getId() !== $nageur->getId() ){
                 $this->addFlash('error',$nageur->getLogin().' : Login already exists ! ');
                 return $this->redirectToRoute('app_admin_nageur_list');
             }
             $password = $form->get('password')->getData();
             if (isset($password)){
                 $password = $userPasswordHasher->hashPassword($nageur, $password);
                 $nageur->setPassword($password);
             }

             $this->em->persist($nageur);
             $this->em->flush();

             $this->addFlash('success','User successfully updated' );

             return $this->redirectToRoute('app_admin_nageur_list') ;
         }else if ($form->isSubmitted() && !$form->isValid()) {
             $this->addFlash('error',$nageur->getLogin().' : Login already exists ! ');
         }

         return $this->render('admin/Nageur/edit.html.twig', [
             'form' => $form->createView(),
         ]);
    }



}




?>