<?php

declare(strict_types=1);
namespace Model;
use DateTime;

class ActOfCompletion
{
    private ?int $id;
    private DateTime $date;
    private string $scan;
    public function __construct(?int $id, DateTime $date, string $scan)
    {
        $this->id = $id;
        $this->scan = $scan;
        $this->date = $date;
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
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getScan(): string
    {
        return $this->scan;
    }

    /**
     * @param string $scan
     */
    public function setScan(string $scan): void
    {
        $this->scan = $scan;
    }
}