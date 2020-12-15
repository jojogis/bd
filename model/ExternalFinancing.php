<?php
declare(strict_types=1);

namespace Model;


class ExternalFinancing
{
    private ?int $id;
    private int $total;
    private int $projectId;
    private int $investorId;
    public function __construct(?int $id, int $total, int $projectId, int $investorId)
    {
        $this->id = $id;
        $this->total = $total;
        $this->projectId = $projectId;
        $this->investorId = $investorId;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
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

    /**
     * @return int
     */
    public function getInvestorId(): int
    {
        return $this->investorId;
    }

    /**
     * @param int $investorId
     */
    public function setInvestorId(int $investorId): void
    {
        $this->investorId = $investorId;
    }
}