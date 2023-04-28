<?php

namespace App\Controller\Admin;
use App\Entity\Performance;
use App\Form\Admin\PerformanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PerformanceController extends AbstractController
{
     public function __construct(private EntityManagerInterface $em) {
        ;
    }

    #[Route('/admin/performance', name: 'app_admin_performance')]
    public function index(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login') ;
     }

    //create 
    $performance = new Performance() ;
    $form = $this->createForm(PerformanceType::class, $performance);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $data = $request->request->all();

        $date = str_replace('/', '-', $data['performance']['date']);
        $dataTime = new \DateTime($date);
        $performance->setDate($dataTime);
        
       
 
         $this->em->persist($performance);
         $this->em->flush();

        $this->addFlash('success','performance successfully created' );

        return $this->redirectToRoute('app_admin_performance') ;
    } else if ($form->isSubmitted() && !$form->isValid()) {

       //dd($form->getData());
        $this->addFlash('error','check your data');
     }
     //  TODO : create new competition : END 
     
    $performance = $this->em->getRepository(Performance::class)->findAll() ;
     return $this->render('admin/performance/index.html.twig', [
        'form' => $form->createView(),
        'performance' => $performance,
     ]);
    }
    #[Route('/admin/performance/{id}/delete', name: 'app_admin_performance_delete')]
    public function delete(Request $request, UserPasswordHasherInterface $userPasswordHasher,$id): Response
    {
        
        $user = $this->getUser();

        
        $performanceRepository = $this->em->getRepository(Performance::class);
       
        $performance =$performanceRepository->find(['id'=>$id]);;
        if (!$performance) {
            return $this->redirectToRoute('app_admin_performance');
        }

      
        $this->em->remove($performance);
        $this->em->flush();
        
        
        $this->addFlash('success','performance successfully deleted ' );
        return $this->redirectToRoute('app_admin_performance');
    }
}
