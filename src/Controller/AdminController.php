<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function showAdminIndex(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/add_project", name="add_project")
     */
    public function createProject(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($project);
            $entityManager->flush();
            $this->addFlash('success', 'Le projet a bien été ajouté');
            return $this->redirectToRoute('admin_dashboard');
        }
        return $this->render('admin/add_project.html.twig', [
            'form'    => $form->createView(),
            'project' => $project,
        ]);
    }

}
