<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {

        $task = new Task();

        $task->setTitle('No se');
        $task->setDescription('lorem ipsum');
        $task->setPriority(1);

        //$entityManager->getRepository(Task::class)->save($task, true);
        $tasks = $entityManager->getRepository(Product::class)->findAll();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TaskController.php',
            'tasks' => $tasks
        ]);
    }
}
