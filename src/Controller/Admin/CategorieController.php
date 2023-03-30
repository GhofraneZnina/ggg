<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\Admin\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/admin/categorie', name: 'app_admin_categorie_list')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        $categorie = $this->em->getRepository(Categorie::class)->findAll();

        return $this->render('admin/categorie/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }
   




















}




?>
