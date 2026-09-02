<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_redirect', methods:["GET"])]
    public function index(): Response
    {
        return $this->redirectToRoute("app_home",['_locale'=>'it'],301);
    }

    #[Route('/{_locale}/', name: 'app_home', methods:["GET"],requirements:['_locale' => 'it|fr|en'])]
    public function localeHome(ProjectRepository $pr,TagAwareCacheInterface $cache):Response
    {
        $cacheKey = "projects";
        $data = $cache->get($cacheKey, function(ItemInterface $item) use ($pr){
            $item->expiresAfter(86400);
            $projects = [];
            $entities = $pr->findBy(["isActive" => 1],["position" => "ASC"]);
            if ($entities) {
                foreach ($entities as $project) {
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
            return $projects;
        });

        return $this->render('home/index.html.twig', [
            'projects' => $data,
        ]);
    }
}
