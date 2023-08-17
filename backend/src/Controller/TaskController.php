<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class TaskController extends AbstractController
{
    private TaskRepository $repository;
    private Serializer $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->repository = $entityManager->getRepository(Task::class);
        $this->serializer = $serializer;
    }

    #[Route('/task', name: 'app_task', methods: ['GET', 'HEAD'])]
    public function index(): JsonResponse
    {
        $tasks = $this->repository->findBy([
            'task_father' => null
        ]);

        $serializedTasks = $this->serializer->normalize($tasks, null, ['groups' => ['main', 'task_children']]);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TaskController.php',
            'tasks' => $serializedTasks
        ]);
    }
}
