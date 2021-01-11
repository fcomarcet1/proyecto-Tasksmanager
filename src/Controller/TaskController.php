<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskFormType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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


    //*************** Task create *****************
    /**
     * @param Request $request
     * @param UserInterface $user
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function createTask(
        Request $request,
        UserInterface $user,
        ValidatorInterface $validator): Response
    {

        // Form -> add new task
        $task = new Task();
        $form = $this->createForm(TaskFormType::class, $task);
        $form->handleRequest($request);

        // Check form is submit & valid
        if ($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();
            $task->setUser($user); // Get user
            $task->setCreatedAt(new DateTime('now'));

            //Validate object $user with Validator Service before persist
            $errors = $validator->validate($task);
            if (count($errors) > 0)
            {
                return new Response((string) $errors, 400);
            }

            // Persist data in DB
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            // Flash message
            $this->addFlash('success', 'Tarea añadida correctamente.');

            return $this->redirect($this->generateUrl('task_detail', [
                'id' => $task->getId()
            ]));

            //return $this->redirectToRoute('tasks');
        }

        // Use same form on create task
        return $this->render('task/new_task.html.twig', [
            'taskForm' => $form->createView(),
        ]);
    }


    //*************** My tasks *****************
    /**
     * @param UserInterface $user
     * @return Response
     */
    public function myTasks(UserInterface $user)
    {
        $tasks = $user->getTasks();

        return $this->render('task/my_tasks.html.twig',[
            'tasks' => $tasks,
        ]);
    }


    //*************** Task edit *****************
    /**
     * @param Request $request
     * @param Task $task
     * @param UserInterface $user
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function editTask(
        Request $request,
        Task $task,
        UserInterface $user,
        ValidatorInterface $validator
    ): Response
    {
        //var_dump($task);
        //Validate if user is creator of task (User logued or user_id(task) = user_id(logued))
        if(!$user || ($user->getId() !== $task->getUser()->getId()) )
        {
            return $this->redirectToRoute('tasks');
        }

        // *********** Form -> edit task ****************

        // El formulario se rellena automaticamente ya que le pasamos un objeto task cpn datos
        // y lo vinculamos al formulario
        $form = $this->createForm(TaskFormType::class, $task);
        $form->handleRequest($request);


         // Check form is submit & valid
        if ($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();
            //$task->setUser($user); // Get user
            $task->setUpdatedAt(new DateTime('now'));

            //Validate object $user with Validator Service before persist
            $errors = $validator->validate($task);
            if (count($errors) > 0)
            {
                return new Response((string)$errors, 400);
            }

            // Persist data in DB
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            // Flash message
            $this->addFlash('success', 'Tarea editada correctamente.');

            return $this->redirect($this->generateUrl('task_detail', [
                        'id' => $task->getId()
                    ]));
        }

            //return $this->redirectToRoute('tasks');

        return $this->render('task/edit_task.html.twig', [
            'edit' => true,
            'taskForm' => $form->createView()
        ]);
    }
}
