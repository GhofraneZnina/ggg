<?php

namespace App\Controller\Admin;
use App\Entity\Groupe;
use App\Form\Admin\GroupeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{



 public function __construct(private EntityManagerInterface $em) {
        ;
    }





#[Route('/admin/groupe', name: 'app_admin_groupe_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
         }

         //  TODO : create new group : START
         $groupe = new Groupe() ;
         $form = $this->createForm(groupeType::class, $groupe);
         $form->handleRequest($request);if ($form->isSubmitted() && $form->isValid()) { 
               $this->em->persist($groupe);
               $this->em->flush();
 
              $this->addFlash('success','groupe  successfully created' ); 
              return $this->redirectToRoute('app_admin_groupe_list') ;
          } else if ($form->isSubmitted() && !$form->isValid()) {
 
           //dd($form->getData());
              $this->addFlash('error','check your data');
           }
         //  TODO : create new group : END 
         $groupes = $this->em->getRepository(Groupe::class)->findAll() ; 
         return $this->render('admin/groupe/index.html.twig', [
            'form' => $form->createView(),
             'groupes' => $groupes,
         ]);
     } 

    #[Route('/admin/groupe/create', name: 'app_admin_groupe_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
            $groupe = new Groupe() ;
         $form = $this->createForm(groupeType::class, $groupe);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

           

            
            
           //dump($dataTimeDate);
            //dd($form->getData());
            
            

              $this->em->persist($groupe);
              $this->em->flush();

           $this->addFlash('success','groupe  successfully created' );

             return $this->redirectToRoute('app_admin_groupe_list') ;
         } else if ($form->isSubmitted() && !$form->isValid()) {

          //dd($form->getData());
             $this->addFlash('error','check your data');
          }
 
         return $this->render('admin/groupe/create.html.twig', [
             'form' => $form->createView(),
       ]);
     }





     #[Route('/admin/groupe/delete/{id}', name: 'app_admin_groupe_delete')]
    public function delete( $id, EntityManagerInterface $em): Response
    {
        $groupe = $this->em->getRepository(groupe::class)->findOneBy(['id'=> $id]) ;
        if(!$groupe){
            $this->addFlash('error','groupe not found.' );
            return $this->redirectToRoute('app_admin_groupe_list') ;
        }
        $em->remove($groupe);
        $em->flush();
        $this->addFlash('success','groupe deleted successfully.' );
        return $this->redirectToRoute('app_admin_groupe_list') ;
    }
}



   /*  public function create(Request $request, EntityManagerInterface $em): Response
    {
        // Create new category here
        $groupe=new groupe ();
        // Add $category to createForm method as second argument
        $form=$this->createForm(groupeType::class, $groupe);
        $form->handleRequest($request);
    
        if($form->isSubmitted()){
            // After form is submitted
            // $category will be filled 
            // with data from $form
            $em->persist($groupe);
            $em->flush();
            dump($request);
        }
        $formView = $form->createView();
    
        return $this->render('admin/groupe/create.html.twig', [
                     'form' => $form->createView(),
                 ]);
    }
 */
    




?>
