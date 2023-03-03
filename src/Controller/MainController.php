<?php

namespace App\Controller;

use App\Entity\Entraineur;
use App\Entity\Nageur;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
        }
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('add', name: 'add_entraineur')]
    public function add(): Response
    {
        $entraineur=new Entraineur();
        $form = $this->createForm(EntraineurFormType::class, $entraineur);
        return $this->render('main/add.html.twig',[
            'form' => $form->createView(),
        ]);  
    }
        #[Route('update', name: 'update_entraineur')]
        public function update(): Response
        {
            $entraineur=new Entraineur();
            $form = $this->createForm(EntraineurFormType::class, $entraineur);
            return $this->render('main/update.html.twig',[
                'form' => $form->createView(),
            ]);  
    } 
        #[Route('delete', name: 'delete_entraineur')]
        public function delete(): Response
        {
            $entraineur=new Entraineur();
            $form = $this->createForm(EntraineurFormType::class, $entraineur);
            return $this->render('main/delete.html.twig',[
                'form' => $form->createView(),
            ]);  
          }
          #[Route('addNageur', name: 'add_nageur')]
          public function addNageur(): Response
          {
              $nageur=new Nageur();
              $form = $this->createForm(NageurFormType::class, $nageur);
              return $this->render('main/addNageur.html.twig',[
                  'form' => $form->createView(),
              ]);  
          }
              #[Route('updateNageur', name: 'update_nageur')]
              public function updateNageur(): Response
              {
                  $nageur=new Nageur();
                  $form = $this->createForm(NageurFormType::class, $nageur);
                  return $this->render('main/updateNageur.html.twig',[
                      'form' => $form->createView(),
                  ]);  
          } 
              #[Route('deleteNageur', name: 'delete_nageur')]
              public function deleteNageur(): Response
              {
                  $nageur=new Nageur();
                  $form = $this->createForm(NageurFormType::class, $nageur);
                  return $this->render('main/deleteNageur.html.twig',[
                      'form' => $form->createView(),
                  ]);  
                }
      } 
      

