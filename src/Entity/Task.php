<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'tasks')]
    private ?self $task_father = null;

    #[ORM\OneToMany(mappedBy: 'task_father', targetEntity: self::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getTaskFather(): ?self
    {
        return $this->task_father;
    }

    public function setTaskFather(?self $task_father): self
    {
        $this->task_father = $task_father;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(self $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setTaskFather($this);
        }

        return $this;
    }

    public function removeTask(self $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getTaskFather() === $this) {
                $task->setTaskFather(null);
            }
        }

        return $this;
    }
}
