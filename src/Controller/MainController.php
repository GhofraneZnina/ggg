<?php

namespace App\Controller;

use App\Entity\Entraineur;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    
    #[Route('/', name: 'main')]
    public function index(): Response
    {
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
}
