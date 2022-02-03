<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Tags;
use App\Repository\ProjectRepository;
use App\Repository\TagsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projets", name="project_")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $projects = $managerRegistry->getRepository(Project::class)->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("{tag}", name="tag_")
     */
    public function findByTag(
        ManagerRegistry $managerRegistry,
        Request $request
    ): Response
    {
        $findByTag = $managerRegistry->getRepository(Tags::class)->findOneBy([]);
        return $this->render('project/index.html.twig', [
            'findByTag' => $findByTag,
        ]);
    }

}
