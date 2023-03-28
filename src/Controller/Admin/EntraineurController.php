<?php

namespace App\Controller\Admin;

use App\Entity\Entraineur;
use App\Form\Admin\EntraineurType;
use App\Form\Admin\EntraineurTypee;
use App\Entity\Physionomie;
use App\Form\Admin\PhysionomieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
class EntraineurController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/entraineur', name: 'app_admin_entraineur_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    $entraineurs = $this->em->getRepository(Entraineur::class)->findAll() ;

         return $this->render('admin/entraineur/index.html.twig', [
             'entraineurs' => $entraineurs,
         ]);
     } 

    #[Route('/admin/entraineur/create', name: 'app_admin_entraineur_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        if (!$this->getUser()) {
          return $this->redirectToRoute('login') ;
        }
        $entraineur = new Entraineur() ;
        $entraineur->setRoles([Entraineur::ROLE_ENTRAINEUR])  ;
        $entraineur->setStatus(Entraineur::STATUT_ACTIF);

        $form = $this->createForm(EntraineurType::class, $entraineur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->all() ;
            $dateNaissance = str_replace('/','-',$data['entraineur']['dateNaissance']) ;
            $dataTimeDateNaissance = new \DateTime($dateNaissance);
            $entraineur->setDateNaissance($dataTimeDateNaissance);

            $entraineur = $form->getData();
            $chekUser = $this->em->getRepository(Entraineur::class)->findOneByLogin($entraineur->getLogin());
            if($chekUser){
                $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_entraineur_list');
            }
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($entraineur, $password);
            $entraineur->setPassword($password);

            $this->em->persist($entraineur);
            $this->em->flush();

            $this->addFlash('success','Entraineur successfully created' );

            return $this->redirectToRoute('app_admin_entraineur_list') ;
        }else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
        }

        return $this->render('admin/Entraineur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     #[Route('/admin/entraineur/{id}/edit', name: 'app_admin_entraineur_edit')]
     public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
     {
         if (!$this->getUser()) {
             return $this->redirectToRoute('login') ;
         }
         $entraineur = $this->em->getRepository(Entraineur::class)->findOneBy(['id'=>$id]);


         $form = $this->createForm(EntraineurType::class, $entraineur);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             $entraineur = $form->getData();
             $chekUser = $this->em->getRepository(Entraineur::class)->findOneByLogin($entraineur->getLogin());
             if( $chekUser and $chekUser->getId() !== $entraineur->getId() ){
                 $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
                 return $this->redirectToRoute('app_admin_entraineur_list');
             }
             $password = $form->get('password')->getData();
             if (isset($password)){
                 $password = $userPasswordHasher->hashPassword($entraineur, $password);
                 $entraineur->setPassword($password);
             }

             $this->em->persist($entraineur);
             $this->em->flush();

             $this->addFlash('success','User successfully updated' );

             return $this->redirectToRoute('app_admin_entraineur_list') ;
         }else if ($form->isSubmitted() && !$form->isValid()) {
             $this->addFlash('error',$entraineur->getLogin().' : Login already exists ! ');
         }

         return $this->render('admin/Entraineur/edit.html.twig', [
             'form' => $form->createView(),
         ]);
    }
    //page entraineur
    #[Route('/admin/entraineur/{id}/page', name: 'app_admin_entraineur_page')]
    public function pageEntraineur($id, Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        // TODO : create new entraineur : START
        $entraineurs = new Entraineur();
        $form = $this->createForm(EntraineurType::class, $entraineurs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $photo = $form->get('photo')->getData();
            if ($photo) {
                $originalPhoto = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safePhoto = $slugger->slug($originalPhoto);
                $newPhoto = $safePhoto . '-' . uniqid() . '.' . $photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('photos_directory'),
                        $newPhoto
                    );
                } catch (FileException $e) {
                    
                }

                
                $entraineurs->setPhoto($newPhoto);

                $this->em->persist($entraineurs);
                $this->em->flush();
                $this->addFlash('success', 'entraineur successfully created');
                return $this->redirectToRoute('app_admin_entraineur_page');
            }
        }
        else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'check your data');
        }
        // TODO : create entraineur : END

        // TODO : edit entraineur : START

        $entraineurs = $this->em->getRepository(Entraineur::class)->findOneBy(['id' => $id]);
        $formEdit = $this->createForm(EntraineurTypee::class, $entraineurs);
        $formEdit->handleRequest($request);
        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
                $entraineurs = $formEdit->getData();
                $password = $formEdit->get('password')->getData();
                if (isset($password)) {
                    $password = $userPasswordHasher->hashPassword($entraineurs, $password);
                    $entraineurs->setPassword($password);
                }

                $this->em->persist($entraineurs);
                $this->em->flush();

                $this->addFlash('success', 'password successfully updated');

                
                return $this->redirectToRoute('app_admin_entraineur_page', ['id' => $id]);
        }
        else if ($formEdit->isSubmitted() && !$formEdit->isValid()) {
                $this->addFlash('error', $entraineurs->getLogin() . ' : Login already exists ! ');

        }


        // TODO : edit entraineur : END
        //adding physionomie

        $physionomie = new Physionomie();
        $formPhysionomie = $this->createForm(PhysionomieType::class, $physionomie);
        $formPhysionomie->handleRequest($request);
        if ($formPhysionomie->isSubmitted() && $formPhysionomie->isValid()) {

                $data = $request->request->all();

                $date = str_replace('/', '-', $data['physionomie']['date']);
                $dataTimeDate = new \DateTime($date);



                //dump($dataTimeDate);
                //dd($$formPhysionomie->getData());
                $physionomie->setDate($dataTimeDate);



                $this->em->persist($physionomie);
                $this->em->flush();

                $this->addFlash('success', 'physionime successfully created');

                return $this->redirectToRoute('app_admin_nageur_page');
        } 
        else if ($formPhysionomie->isSubmitted() && !$formPhysionomie->isValid()) {
            dd($form->getData());
            $this->addFlash('error', 'check your data');
        }

            //end addind physionomie


            //listing entraineur
        $entraineurs = $this->em->getRepository(Entraineur::class)->findOneBy(['id' => $id]);
        if (!$entraineurs) {
            return $this->redirectToRoute('app_admin_entraineur_page');
         }


        return $this->render('admin/entraineur/pageEntraineur.html.twig', [
        'entraineurs' => $entraineurs,
        'form' => $form->createView(),
        'formEdit' => $formEdit->createView(),
        'formPhysionomie' => $formPhysionomie->createView(),

        ]);

              
    }













    // function setActiveClass(RequestStack $requestStack, $routeName)
    // {
    //     $request = $requestStack->getCurrentRequest();
    //     $route = $request->attributes->get('app_admin_entraineur_list');
    //     if ($route === $routeName) {
    //         return 'active';
    //     }
    //     return '';
    // }


}
?>