<?php

namespace App\Controller\Admin;

use App\Entity\Physionomie;
use App\Form\Admin\PhysionomieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PhysionomieController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/physionomie', name: 'app_admin_physionomie_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $physionomie = new Physionomie() ;
    $form = $this->createForm(PhysionomieType::class, $physionomie);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $data = $request->request->all() ;

        $date = str_replace('/','-',$data['physionomie']['date']) ;
        $dataTimeDate = new \DateTime($date);

        
        
       //dump($dataTimeDate);
        //dd($form->getData());
        $physionomie->setDate($dataTimeDate );
       
        

         $this->em->persist($physionomie);
         $this->em->flush();

        $this->addFlash('success','physionime successfully created' );

        return $this->redirectToRoute('app_admin_physionomie_list') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new group : END 
     
    $physionomies = $this->em->getRepository(Physionomie::class)->findAll() ;
     return $this->render('admin/physionomie/index.html.twig', [
        'form' => $form->createView(),
        'physionomies' => $physionomies,
     ]);

       
     } 





     #[Route('/admin/physionomie/create', name: 'app_admin_physionomie_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
           return $this->redirectToRoute('login') ;
        }
        $physionomie = new Physionomie() ;
        $form = $this->createForm(PhysionomieType::class, $physionomie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->all() ;

            $date = str_replace('/','-',$data['physionomie']['date']) ;
            $dataTimeDate = new \DateTime($date);

            
            
           //dump($dataTimeDate);
            //dd($form->getData());
            $physionomie->setDate($dataTimeDate );
           
            

             $this->em->persist($physionomie);
             $this->em->flush();

            $this->addFlash('success','physionime successfully created' );

            return $this->redirectToRoute('app_admin_physionomie_list') ;
        } else if ($form->isSubmitted() && !$formPhysionomie->isValid()) {

           //dd($form->getData());
            $this->addFlash('error','check your data');
         }
 
        //return $this->render('admin/physionomie/create.html.twig', [
            return $this->render('admin/physionomie/indexModal.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // #[Route('/admin/physionomie/{id}/delete', name: 'app_admin_physionomie_delete')]

    // public function deletePhysionomie($id)
    // {
        
    //     //$entityManager = $this->getDoctrine()->getManager();
    //     $physionomie = $this->em->getRepository(Physionomie::class)->find(['id'=>$id]);
    
    //     if (!$physionomie) {
    //         throw $this->createNotFoundException(
    //             'Aucune physionomie trouvée pour l\'id '.$id
    //         );
    //     }
    
    //     $em->remove($physionomie);
    //     $em->flush();
    
    //     return $this->redirectToRoute('admin/physionomie/index.html.twig');
    // }
    
    // -----------------------------------------------------------------------------------------------------------

    #[Route('/admin/physionomie/{id}/delete', name: 'app_admin_physionomie_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $physionomieRepository = $this->em->getRepository(Physionomie::class);
       
        $physionomie =$physionomieRepository->find(['id'=>$id]);;
        if (!$physionomie) {
            return $this->redirectToRoute('app_admin_physionomie_list');
        }

      
        $this->em->remove($physionomie);
        $this->em->flush();
        
        
        $this->addFlash('success','physionime successfully deleted ' );
        return $this->redirectToRoute('app_admin_physionomie_list');
    }

    // -----------------------------------------------------------------------------------------------------------




















}




?>