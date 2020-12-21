<?php

namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController
 * @package App\Controller
 */
class TaskController extends AbstractController
{
    //************** Task list ********************
    /**
     * @return Response
     */
    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        //$tasks = $task_repo->findAll();
        $tasks = $task_repo->findBy([], ['id' => 'DESC']);


        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'tasks' => $tasks,
        ]);
    }

    //*************** Task detail *****************
    /**
     * @param Task $task
     * @return Response
     */
    public function taskDetail (Task $task): Response
    {
        // Check if not exists task obj
        if(!$task || empty($task) )
        {
            // throw new Exception ('Not exist task');
            $this->addFlash('error', 'No existe la tarea seleccionada');
            return $this->redirectToRoute('tasks');
        }

        return $this->render('task/detail.html.twig', [
            'task' => $task,
        ]);
    }

}
