<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TeamRepository;
use Knp\Component\Pager\PaginatorInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index(TeamRepository $teamRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $teams = $teamRepository->getAllTeams();
        
        $pagination = $paginator->paginate(
            $teams,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('teams.html.twig', [
            'controller_name' => 'IndexController',
            'teams' => $pagination,
        ]);
    }
}