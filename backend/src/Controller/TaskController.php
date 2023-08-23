<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/task', name: 'list_tasks', methods: ['GET', 'HEAD'])]
    public function index(): JsonResponse
    {
        $tasks = $this->repository->findBy(['task_father' => null]);
        return $this->json($this->serialize($tasks));
    }

    #[Route('/task/{task}', name: 'show_task', methods: ['GET', 'HEAD'])]
    public function show(Task $task): JsonResponse
    {
        return $this->json($this->serialize($task));
    }

    #[Route('/task/{task}', name: 'delete_task', methods: ['DELETE'])]
    public function delete(Task $task): JsonResponse
    {
        $this->repository->remove($task, true);
        return $this->json([
            'status' => true
        ]);
    }

    #[Route('/task/{task}', name: 'update_task', methods: ['UPDATE'])]
    public function update(Task $task, Request $request): JsonResponse
    {
        $body = $request->getContent();
        // $this->repository->save($task, true);
        return $this->json([
            'status' => true
        ]);
    }

    private function serialize($entity){
        return $this->serializer->normalize($entity, null, ['groups' => ['main', 'task_children']]);
    }
}
