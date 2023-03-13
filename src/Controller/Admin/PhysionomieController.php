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
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    $physionomies = $this->em->getRepository(Physionomie::class)->findAll() ;

         return $this->render('admin/physionomie/index.html.twig', [
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
        } else if ($form->isSubmitted() && !$form->isValid()) {

           //dd($form->getData());
            $this->addFlash('error','check your data');
         }
 
        return $this->render('admin/physionomie/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }



   /*  public function create(Request $request, EntityManagerInterface $em): Response
    {
        // Create new category here
        $physionomie=new physionomie ();
        // Add $category to createForm method as second argument
        $form=$this->createForm(PhysionomieType::class, $physionomie);
        $form->handleRequest($request);
    
        if($form->isSubmitted()){
            // After form is submitted
            // $category will be filled 
            // with data from $form
            $em->persist($physionomie);
            $em->flush();
            dump($request);
        }
        $formView = $form->createView();
    
        return $this->render('admin/physionomie/create.html.twig', [
                     'form' => $form->createView(),
                 ]);
    }
 */
    




}




?>