<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods:["GET"])]
    public function index(ProjectRepository $pr): Response
    {
        $projects = [];
        $data = $pr->findBy(["isActive" => 1],["position" => "ASC"]);
        if ($data) {
            foreach ($data as $project) {
                $projects[] = [
                    "bgColor" => $project->getBgColor(),
                    "textColor" => $project->getTextColor(),
                    "slug" => $project->getSlug(),
                    "description" => $project->getDescription(),
                    "title" => $project->getTitle(),
                    "stack" => $project->getStack(),
                    "position" => $project->getPosition(),
                ];
            }
        }

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
