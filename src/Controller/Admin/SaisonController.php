<?php

namespace App\Controller\Admin;
use App\Entity\Saison;
use App\Entity\Seance;
use App\Form\Admin\SaisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SaisonController extends AbstractController
{



 public function __construct(private EntityManagerInterface $em) {
        ;
    }





#[Route('/admin/saison', name: 'app_admin_saison_list')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
         }

         //  TODO : create new saison : START
         $saison = new Saison() ;
         $form = $this->createForm(SaisonType::class, $saison);
         $form->handleRequest($request);if ($form->isSubmitted() && $form->isValid()) { 
            $data = $request->request->all() ;

            $dateDebut = str_replace('/','-',$data['saison']['dateDebut']) ;
            $dataTimeDateDebut = new \DateTime($dateDebut);
            $saison->setDateDebut($dataTimeDateDebut);


            $dateFin = str_replace('/','-',$data['saison']['dateFin']) ;
            $dataTimeDateFin = new \DateTime($dateFin);
            $saison->setDateFin($dataTimeDateFin);
               $this->em->persist($saison);
               $this->em->flush();
 
              $this->addFlash('success','saison successfully created' ); 
              return $this->redirectToRoute('app_admin_saison_list') ;
          } else if ($form->isSubmitted() && !$form->isValid()) {
 
           //dd($form->getData());
              $this->addFlash('error','check your data');
           }
         //  TODO : create new saison : END 
         $saison = $this->em->getRepository(Saison::class)->findAll() ; 
         return $this->render('admin/saison/index.html.twig', [
            'form' => $form->createView(),
             'saison' => $saison,
         ]);
     } 

    #[Route('/admin/saison/create', name: 'app_admin_saison_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
            $saison = new Saison() ;
         $form = $this->createForm(SaisonType::class, $saison);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {

           //dump($dataTimeDate);
            //dd($form->getData());
            $data = $request->request->all() ;

            $dateDebut = str_replace('/','-',$data['saison']['dateDebut']) ;
            $dataTimeDateDebut = new \DateTime($dateDebut);
            $saison->setDateDebut($dataTimeDateDebut);


            $dateFin = str_replace('/','-',$data['saison']['dateFin']) ;
            $dataTimeDateFin = new \DateTime($dateFin);
            $saison->setDateFin($dataTimeDateFin);


            

              $this->em->persist($saison);
              $this->em->flush();

           $this->addFlash('success','saison successfully created' );

             return $this->redirectToRoute('app_admin_saison_list') ;
         }
          else if ($form->isSubmitted() && !$form->isValid()) {

          //dd($form->getData());
             $this->addFlash('error','check your data');
          }
 
         return $this->render('admin/saison/create.html.twig', [
             'form' => $form->createView(),
       ]);
     }





     #[Route('/admin/saison/delete/{id}', name: 'app_admin_saison_delete')]
    public function delete( $id, EntityManagerInterface $em): Response
    {
        $saison = $this->em->getRepository(Saison::class)->findOneBy(['id'=> $id]) ;
        if(!$saison){
            $this->addFlash('error','saison not found.' );
            return $this->redirectToRoute('app_admin_saison_list') ;
        }
        $em->remove($saison);
        $em->flush();
        $this->addFlash('success','saison deleted successfully.' );
        return $this->redirectToRoute('app_admin_saison_list') ;
    }
    /////////////////////////////////////////
   
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
