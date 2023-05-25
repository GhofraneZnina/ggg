<?php

namespace App\Controller\Admin;

use App\Entity\Nageur;
use App\Entity\Groupe;
use App\Entity\Seance;
use App\Form\Admin\NageurType;
use App\Form\Admin\NageurTypee;
use App\Entity\Physionomie;
use App\Form\Admin\PhysionomieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class NageurController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, )
    {
        ;
    }


    #[Route('/admin/nageur', name: 'app_admin_nageur_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        $nageurs = $this->em->getRepository(Nageur::class)->findAll();

        return $this->render('admin/nageur/index.html.twig', [
            'nageurs' => $nageurs,
        ]);
    }
    

    #[Route('/admin/nageur/create', name: 'app_admin_nageur_create')]
    public function create(Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        $nageur = new Nageur();
        $nageur->setRoles([Nageur::ROLE_NAGEUR]);
        $nageur->setStatus(Nageur::STATUT_ACTIF);

        $form = $this->createForm(NageurType::class, $nageur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $request->request->all();

            $dateDebutActiviteSportive = str_replace('/', '-', $data['nageur']['dateDebutActiviteSportive']);
            $dataTimeDebutActiviteSportive = new \DateTime($dateDebutActiviteSportive);

            $dateLicence = str_replace('/', '-', $data['nageur']['dateLicence']);
            $dataTimeLicence = new \DateTime($dateLicence);

            $dateNaissance = str_replace('/', '-', $data['nageur']['dateNaissance']);
            $dataTimeDateNaissance = new \DateTime($dateNaissance);
            //dump($dataTime);
            $nageur->setDateDebutActiviteSportive($dataTimeDebutActiviteSportive);
            $nageur->setDateLicence($dataTimeLicence);
            $nageur->setDateNaissance($dataTimeDateNaissance);
            //dd($form->getData());
            $nageur = $form->getData();
            $chekUser = $this->em->getRepository(Nageur::class)->findOneByLogin($nageur->getLogin());
            if ($chekUser) {
                $this->addFlash('error', $nageur->getLogin() . ' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_nageur_list');
            }
            // dd($form->getData());
            $password = $form->get('password')->getData();
            $password = $userPasswordHasher->hashPassword($nageur, $password);
            $nageur->setPassword($password);
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
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $nageur->setPhoto($newPhoto);

            }
            $this->em->persist($nageur);
            $this->em->flush();

            $this->addFlash('success', 'nageur successfully created');

            return $this->redirectToRoute('app_admin_nageur_list');


        } else if ($form->isSubmitted() && !$form->isValid()) {

            dd($form->getData());
            $this->addFlash('error', 'check your data');

            $errors = $form->getErrors(true, true);
            foreach ($errors as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }


        return $this->render('admin/nageur/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    // end function create 


    #[Route('/admin/nageur/{id}/edit', name: 'app_admin_nageur_edit')]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        $nageur = $this->em->getRepository(Nageur::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(NageurType::class, $nageur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $nageur = $form->getData();
            $chekUser = $this->em->getRepository(Nageur::class)->findOneByLogin($nageur->getLogin());
            if ($chekUser and $chekUser->getId() !== $nageur->getId()) {
                $this->addFlash('error', $nageur->getLogin() . ' : Login already exists ! ');
                return $this->redirectToRoute('app_admin_nageur_list');
            }
            $password = $form->get('password')->getData();
            if (isset($password)) {
                $password = $userPasswordHasher->hashPassword($nageur, $password);
                $nageur->setPassword($password);
            }

            $this->em->persist($nageur);
            $this->em->flush();

            $this->addFlash('success', 'User successfully updated');

            return $this->redirectToRoute('app_admin_nageur_list');
        } else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', $nageur->getLogin() . ' : Login already exists ! ');
        }

        return $this->render('admin/Nageur/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    //     #[Route('/admin/nageur/{id}/page', name: 'app_admin_nageur_page')]
//     public function page(): Response
//     {

    //        return $this->render('admin/nageur/pageNageur.html.twig', [
//            'controller_name' => 'NageurController',
//        ]);
//    }








    #[Route('/admin/nageur/{id}/page', name: 'app_admin_nageur_page')]
    public function pageNageur($id, Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
    {
        // TODO : create new nageur : START
        $nageur = new Nageur();
        $form = $this->createForm(NageurType::class, $nageur);
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

                
                $nageur->setPhoto($newPhoto);

                $this->em->persist($nageur);
                $this->em->flush();
                $this->addFlash('success', 'nageur successfully created');
                return $this->redirectToRoute('app_admin_nageur_page', ['id' => $id]);
            }
        }
        else if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'check your data');
        }
        // TODO : create nageur : END

        // TODO : edit nageur : START

        $nageur = $this->em->getRepository(Nageur::class)->findOneBy(['id' => $id]);
        $formEdit = $this->createForm(NageurTypee::class, $nageur);
        $formEdit->handleRequest($request);
        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
                $nageur = $formEdit->getData();
                $password = $formEdit->get('password')->getData();
                if (isset($password)) {
                    $password = $userPasswordHasher->hashPassword($nageur, $password);
                    $nageur->setPassword($password);
                }

                $this->em->persist($nageur);
                $this->em->flush();

                $this->addFlash('success', 'password successfully updated');

                return $this->redirectToRoute('app_admin_nageur_page', ['id' => $id]);
        }
        else if ($formEdit->isSubmitted() && !$formEdit->isValid()) {
                $this->addFlash('error', $nageur->getLogin() . ' : Login already exists ! ');

        }


        // TODO : edit nageur : END
        //adding physionomie

        $physionomie = new Physionomie();
        $physionomie->setNageur($nageur);
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

                return $this->redirectToRoute('app_admin_nageur_page',['id'=>$nageur->getId()]);
        } 
        else if ($formPhysionomie->isSubmitted() && !$formPhysionomie->isValid()) {
            dd($form->getData());
            $this->addFlash('error', 'check your data');
        }

            //end addind physionomie


            //listing nageur
            $nageurs = $this->em->getRepository(Nageur::class)->findOneBy(['id' => $id]);
    
            // Retrieve all the Seance entities associated with the given Nageur entity
            $seances = $this->em->createQueryBuilder()
                ->select('s')
                ->from('App\Entity\Seance', 's')
                ->join('s.groupe', 'g')
                ->join('g.nageur', 'e')
                ->join('s.planning', 'p')
                ->where('e.id = :nageurId')
                ->andWhere('s.planning IS NOT NULL')
                ->andWhere('p.status = 1')
                ->andWhere('g.id = :groupeId')
                ->setParameter('nageurId', $nageurs->getId())
                ->setParameter('groupeId', $nageurs->getGroupe()->getId())
                ->getQuery()
                ->getResult();
        
            // Check if the Nageur is assigned to a Groupe
            $seancesByDay = [];
            if ($nageurs->getGroupe() !== null) {
                // Get the Seances for the Groupe
                foreach ($nageurs->getGroupe()->getSeances() as $seance) {
                    $dayOfWeek = $seance->getJour();
                    if (!isset($seancesByDay[$dayOfWeek])) {
                        $seancesByDay[$dayOfWeek] = [];
                    }
                    $seancesByDay[$dayOfWeek][] = $seance;
                }
            }
        
            return $this->render('admin/nageur/pageNageur.html.twig', [
                'nageurs' => $nageurs,
                'form' => $form->createView(),
                'formEdit' => $formEdit->createView(),
                'formPhysionomie' => $formPhysionomie->createView(),
                'seanceByDay' => $seancesByDay,
                'seance' => $seances,
            ]);
        }

        #[Route('/admin/nageur/{id}/profil', name: 'app_admin_nageur_profil')]
        public function profilNageur($id, Request $request, UserPasswordHasherInterface $userPasswordHasher, SluggerInterface $slugger): Response
        {
    
            // TODO : edit nageur : START
    
            $nageur = $this->em->getRepository(Nageur::class)->findOneBy(['id' => $id]);
            $formEdit = $this->createForm(NageurTypee::class, $nageur);
            $formEdit->handleRequest($request);
            if ($formEdit->isSubmitted() && $formEdit->isValid()) {
                    $nageur = $formEdit->getData();
                    $password = $formEdit->get('password')->getData();
                    if (isset($password)) {
                        $password = $userPasswordHasher->hashPassword($nageur, $password);
                        $nageur->setPassword($password);
                    }
    
                    $this->em->persist($nageur);
                    $this->em->flush();
    
                    $this->addFlash('success', 'password successfully updated');
    
                    return $this->redirectToRoute('app_admin_nageur_page', ['id' => $id]);
            }
            else if ($formEdit->isSubmitted() && !$formEdit->isValid()) {
                    $this->addFlash('error', $nageur->getLogin() . ' : Login already exists ! ');
    
            }
    
    
            // TODO : edit nageur : END
            //adding physionomie
    
            $physionomie = new Physionomie();
            $physionomie->setNageur($nageur);
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
    
                    return $this->redirectToRoute('app_admin_nageur_page',['id'=>$nageur->getId()]);
            } 
            else if ($formPhysionomie->isSubmitted() && !$formPhysionomie->isValid()) {
               
                $this->addFlash('error', 'check your data');
            }
    
                //end addind physionomie
    
    
                //listing nageur
                $nageurs = $this->em->getRepository(Nageur::class)->findOneBy(['id' => $id]);
        
                // Retrieve all the Seance entities associated with the given Nageur entity
                $seances = $this->em->createQueryBuilder()
                    ->select('s')
                    ->from('App\Entity\Seance', 's')
                    ->join('s.groupe', 'g')
                    ->join('g.nageur', 'e')
                    ->join('s.planning', 'p')
                    ->where('e.id = :nageurId')
                    ->andWhere('s.planning IS NOT NULL')
                    ->andWhere('p.status = 1')
                    ->andWhere('g.id = :groupeId')
                    ->setParameter('nageurId', $nageurs->getId())
                    ->setParameter('groupeId', $nageurs->getGroupe()->getId())
                    ->getQuery()
                    ->getResult();
            
                // Check if the Nageur is assigned to a Groupe
                $seancesByDay = [];
                if ($nageurs->getGroupe() !== null) {
                    // Get the Seances for the Groupe
                    foreach ($nageurs->getGroupe()->getSeances() as $seance) {
                        $dayOfWeek = $seance->getJour();
                        if (!isset($seancesByDay[$dayOfWeek])) {
                            $seancesByDay[$dayOfWeek] = [];
                        }
                        $seancesByDay[$dayOfWeek][] = $seance;
                    }
                }
            
                return $this->render('admin/nageur/profilNageur.html.twig', [
                    'nageurs' => $nageurs,
                    'formEdit' => $formEdit->createView(),
                    'formPhysionomie' => $formPhysionomie->createView(),
                    'seanceByDay' => $seancesByDay,
                    'seance' => $seances,
                ]);
            }
    


}




?>
