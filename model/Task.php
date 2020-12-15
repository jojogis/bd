<?php
declare(strict_types=1);

namespace Model;

use DateTime;

class Task
{
    private ?int $id;
    private DateTime $planFinishDate;
    private ?DateTime $realFinishDate;
    private string $name;
    private ?string $description;
    private int $projectId;

    public function __construct(?int $id,
                                DateTime $planFinishDate,
                                ?DateTime $realFinishDate,
                                string $name,
                                ?string $description,
                                int $projectId)
    {
        $this->id = $id;
        $this->planFinishDate = $planFinishDate;
        $this->realFinishDate = $realFinishDate;
        $this->name = $name;
        $this->description = $description;
        $this->projectId = $projectId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getPlanFinishDate(): DateTime
    {
        return $this->planFinishDate;
    }

    /**
     * @param DateTime $planFinishDate
     */
    public function setPlanFinishDate(DateTime $planFinishDate): void
    {
        $this->planFinishDate = $planFinishDate;
    }

    /**
     * @return DateTime|null
     */
    public function getRealFinishDate(): ?DateTime
    {
        return $this->realFinishDate;
    }

    /**
     * @param DateTime|null $realFinishDate
     */
    public function setRealFinishDate(?DateTime $realFinishDate): void
    {
        $this->realFinishDate = $realFinishDate;
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
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

}