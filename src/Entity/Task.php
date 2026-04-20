<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    shortName: 'Tasks',
    description: 'Vos tâches à réaliser',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
    ],
    formats: [
        'json',
        'jsonld',
        'html',
    ],
)]
#[GetCollection(paginationMaximumItemsPerPage: 10)]
#[ApiFilter(OrderFilter::class, properties: ["dueDate" => "ASC", "priority" => "DESC"])]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire')]
    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'Votre titre doit faire plus de 10 caractères !',
        maxMessage: 'Votre titre doit faire moins de 255 caractères !'
    )]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
//    #[Assert\DateTime(format: 'Y-m-d', message: 'La date doit être au format YYYY-MM-DD')]
    private ?\DateTimeInterface $dueDate = null;

    #[ORM\Column(enumType: TaskStatus::class)]
    private ?TaskStatus $status = TaskStatus::TODO;

    #[ORM\Column(nullable: true, enumType: TaskPriority::class)]
    private ?TaskPriority $priority = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): Task
    {
        $this->createdAt = new \DateTimeImmutable();

        return $this;
    }

    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): Task
    {
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): static
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function setStatus(TaskStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?TaskPriority
    {
        return $this->priority;
    }

    public function setPriority(?TaskPriority $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Vérifie si la tâche est terminée.
     * @return bool Vrai si la tâche est terminée, faux sinon.
     */
    public function isDone(): bool
    {
        return TaskStatus::DONE === $this->status;
    }

    /**
     * Marque la tâche comme terminée.
     * @param bool $finished Vrai si la tâche est terminée, faux sinon.
     * @return Task
     */
    public function setDone(bool $finished): Task
    {
        $this->status = $finished ? TaskStatus::DONE : TaskStatus::TODO;

        return $this;
    }
}
