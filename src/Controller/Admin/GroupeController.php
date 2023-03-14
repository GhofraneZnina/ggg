<?php

namespace App\Controller\Admin;
use App\Entity\groupe;
use App\Form\Admin\groupeType;
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
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    $groupes = $this->em->getRepository(groupe::class)->findAll() ;

         return $this->render('admin/groupe/index.html.twig', [
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

            $data = $request->request->all() ;

           

             $this->em->persist($groupe);
             $this->em->flush();

            $this->addFlash('success','physionime successfully created' );

            return $this->redirectToRoute('app_admin_groupe_list') ;
        } else if ($form->isSubmitted() && !$form->isValid()) {

           //dd($form->getData());
            $this->addFlash('error','check your data');
         }
 
        return $this->render('admin/groupe/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // #[Route('/admin/groupe/{id}/delete', name: 'app_admin_groupe_delete')]

    // public function deletegroupe($id)
    // {
        
    //     //$entityManager = $this->getDoctrine()->getManager();
    //     $groupe = $this->em->getRepository(groupe::class)->find(['id'=>$id]);
    
    //     if (!$groupe) {
    //         throw $this->createNotFoundException(
    //             'Aucune groupe trouvée pour l\'id '.$id
    //         );
    //     }
    
    //     $em->remove($groupe);
    //     $em->flush();
    
    //     return $this->redirectToRoute('admin/groupe/index.html.twig');
    // }
    
    // -----------------------------------------------------------------------------------------------------------

    #[Route('/admin/groupe/{id}/delete', name: 'app_admin_groupe_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $groupeRepository = $this->em->getRepository(groupe::class);
       
        $groupe =$groupeRepository->find(['id'=>$id]);;
        if (!$groupe) {
            return $this->redirectToRoute('app_admin_groupe_list');
        }

      
        $this->em->remove($groupe);
        $this->em->flush();
        
        
        $this->addFlash('success','physionime successfully deleted ' );
        return $this->redirectToRoute('app_admin_groupe_list');
    }

    // -----------------------------------------------------------------------------------------------------------
    




}




?>

