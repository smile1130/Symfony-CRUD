<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Players;
use App\Entity\Teams;
use Psr\Log\LoggerInterface;

class PlayerController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    private $entityManager;
    private $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function addPlayer($team_id, Request $request): Response
    {
        $team = $this->entityManager->getRepository(Teams::class)->find($team_id);
        $player = new Players();
        $player->setName($request->request->get("name"));
        $player->setSurname($request->request->get("surname"));
        $player->setTeam($team);
        
        $this->entityManager->persist($player);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('team_players', ['team_id' => $team_id]);
    }

}