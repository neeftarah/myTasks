<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Task;
use App\Enum\TaskPriority;
use App\Enum\TaskStatus;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testSetGetValues(): void
    {
        $dtCreation = new \DateTimeImmutable('2023-09-16');
        $dtUpdate = new \DateTimeImmutable('2023-09-17');
        $dueDate = new \DateTimeImmutable('2023-09-25');
        $title = 'Tâche de test';
        $description = 'Une description courte pour la tâche...';

        $task = (new Task())
            ->setTitle($title)
            ->setDescription($description)
            ->setPriority(TaskPriority::MEDIUM)
            ->setDueDate($dueDate)
            ->setCreatedAtValue()
            ->setUpdatedAtValue()
            ->setStatus(TaskStatus::IN_PROGRESS);

        $this->assertSame($title, $task->getTitle());
        $this->assertSame($description, $task->getDescription());
        $this->assertSame(TaskPriority::MEDIUM, $task->getPriority());
        $this->assertEquals($dueDate, $task->getDueDate());
        $this->assertEquals(TaskStatus::IN_PROGRESS, $task->getStatus());
        $this->assertFalse($task->isDone());

        // Vérification des dates de création et de mise à jour automatiques
        $this->assertNotEmpty($task->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getCreatedAt());
        $this->assertNotEmpty($task->getUpdatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getUpdatedAt());

        // Vérification avec des dates pré-définies
        $task->setCreatedAt($dtCreation)
             ->setUpdatedAt($dtUpdate);
        $this->assertEquals($dtCreation, $task->getCreatedAt());
        $this->assertEquals($dtUpdate, $task->getUpdatedAt());

        $task->setDone(true);
        $this->assertTrue($task->isDone());

        // Test private ID
        $reflection = new \ReflectionClass($task);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($task, 13);
        $this->assertSame(13, $task->getId());
    }
}
