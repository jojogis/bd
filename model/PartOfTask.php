<?php
declare(strict_types=1);

namespace Model;
use DateTime;

class PartOfTask
{

    private ?int $id;
    private string $name;
    private ?string $description;
    private ?DateTime $finishDate;
    private int $taskId;
    private int $programmersId;
    public function __construct(?int $id, string $name, ?string $description, ?DateTime $finishDate, int $taskId, int $programmersId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->finishDate = $finishDate;
        $this->taskId = $taskId;
        $this->programmersId = $programmersId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return DateTime|null
     */
    public function getFinishDate(): ?DateTime
    {
        return $this->finishDate;
    }

    /**
     * @param DateTime|null $finishDate
     */
    public function setFinishDate(?DateTime $finishDate): void
    {
        $this->finishDate = $finishDate;
    }

    /**
     * @return int
     */
    public function getTaskId(): int
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     */
    public function setTaskId(int $taskId): void
    {
        $this->taskId = $taskId;
    }

    /**
     * @return int
     */
    public function getProgrammersId(): int
    {
        return $this->programmersId;
    }

    /**
     * @param int $programmersId
     */
    public function setProgrammersId(int $programmersId): void
    {
        $this->programmersId = $programmersId;
    }
}