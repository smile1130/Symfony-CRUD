<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Teams;
use Psr\Log\LoggerInterface;
use Knp\Component\Pager\PaginatorInterface;

class TeamController extends AbstractController
{    
    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function addTeam(Request $request)
    {        
        $team = new Teams();
        $team->setName($request->request->get("name"));
        $team->setCountry($request->request->get("country"));
        $team->setBalance($request->request->get("balance"));
        
        $this->entityManager->persist($team);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('team_index');
    }

    public function editTeam($team_id, Request $request)
    {
        $team = $this->entityManager->getRepository(Teams::class)->find($team_id);
        
        $team->setName($request->request->get("name"));
        $team->setCountry($request->request->get("country"));
        $team->setBalance($request->request->get("balance"));

        $this->entityManager->persist($team);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('team_index');
    }

    public function delTeam($team_id, Request $request)
    {
        $team = $this->entityManager->getRepository(Teams::class)->find($team_id);
        $this->entityManager->remove($team);
        $this->entityManager->flush();

        return $this->redirectToRoute('team_index');
    }

    public function viewPlayers($team_id, PaginatorInterface $paginator, Request $request)
    {
        $team = $this->entityManager->getRepository(Teams::class)->find($team_id);
        $players = $team->getPlayers();

        $pagination = $paginator->paginate(
            $players,
            $request->query->getInt('page', 1),
            1
        );
    
        
        return $this->render('players.html.twig', [
            'team' => $team,
            'players' => $pagination,
        ]);
    }
}