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
   
    #[Route('/admin/categorie/{id}/delete', name: 'app_admin_categorie_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $categorieRepository = $this->em->getRepository(Categorie::class);
       
        $categorie =$categorieRepository->find(['id'=>$id]);;
        if (!$categorie) {
            return $this->redirectToRoute('app_admin_categorie_list');
        }

      
        $this->em->remove($categorie);
        $this->em->flush();
        
        
        $this->addFlash('success','category successfully deleted ' );
        return $this->redirectToRoute('app_admin_categorielist');
    }



















}




?>
