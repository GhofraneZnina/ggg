<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeCompetitionController extends AbstractController
{
    #[Route('/programme/competition', name: 'app_programme_competition')]
    public function index(): Response
    {
        return $this->render('programme_competition/index.html.twig', [
            'controller_name' => 'ProgrammeCompetitionController',
        ]);
    }
}
