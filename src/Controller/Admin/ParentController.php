<?php

namespace App\Controller\Admin;

use App\Entity\Parents;
use App\Form\Admin\ParentsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParentController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }


    #[Route('/admin/parent', name: 'app_admin_parents_list')]
    public function index(): Response
    {
        //if (!$this->getUser()) {
         // return $this->redirectToRoute('login') ;
        //}

        $parents = $this->em->getRepository(Parents::class)->findAll() ;

        return $this->render('admin/parent/index.html.twig', [
            'parents' => $parents,
        ]);
    }
}
    ?>