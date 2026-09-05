<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_redirect', methods:["GET"])]
    public function index(Request $request): Response
    {
        $_locale = "it";

        foreach ($request->getLanguages() as $language) {
            $language = strtolower(substr($language, 0, 2));
            if (in_array($language, ['it', 'fr', 'en'], true)) {
                $_locale = $language;
                break;
            }
        }

        $response = $this->redirectToRoute('app_home', ['_locale' => $_locale], 302);
        $response->setVary('Accept-Language');

        return $response;
       
    }

    #[Route('/{_locale}', name: 'app_home', methods:["GET"],requirements:['_locale' => 'it|fr|en'])]
    public function localeHome(ProjectRepository $pr,TagAwareCacheInterface $cache,string $_locale):Response
    {
       
        $cacheKey = "projects_$_locale";
        $data = $cache->get($cacheKey, function(ItemInterface $item) use ($_locale, $pr){
            $item->expiresAfter(86400);
            $projects = [];
            $entities = $pr->findBy(["isActive" => 1],["position" => "ASC"]);
            if ($entities) {
                foreach ($entities as $project) {
                    $projects[] = [
                        "color" => $project->getColor(),
                        "slug" => $project->getSlug(),
                        "description" =>  $project->getDescription($_locale),
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
