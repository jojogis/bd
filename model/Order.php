<?php

declare(strict_types=1);
namespace Model;
use DateTime;
class Order{
    private ?int $id;
    private int $sum;
    private ?DateTime $deadline;
    private DateTime $date;
    private string $description;
    private ?int $actOfCompletionId;
    private ?string $scan;
    private int $customerId;

    public function __construct(?int $id,
                         int $sum,
                         DateTime $deadline,
                         DateTime $date,
                         string $description,
                         int $actOfCompletionId,
                         string $scan,
                         int $customerId)
    {
        $this->id = $id;
        $this->sum = $sum;
        $this->deadline = $deadline;
        $this->date = $date;
        $this->description = $description;
        $this->actOfCompletionId = $actOfCompletionId;
        $this->scan = $scan;
        $this->customerId = $customerId;
    }

    /**
     * @return int|null
     */
    public function getActOfCompletionId(): ?int
    {
        return $this->actOfCompletionId;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return DateTime|null
     */
    public function getDeadline(): ?DateTime
    {
        return $this->deadline;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getScan(): ?string
    {
        return $this->scan;
    }

    /**
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * @param int|null $actOfCompletionId
     */
    public function setActOfCompletionId(?int $actOfCompletionId): void
    {
        $this->actOfCompletionId = $actOfCompletionId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @param DateTime|null $deadline
     */
    public function setDeadline(?DateTime $deadline): void
    {
        $this->deadline = $deadline;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param int|null $id
     */
    //public function setId(?int $id): void
    //{
    //    $this->id = $id;
    //}

    /**
     * @param string|null $scan
     */
    public function setScan(?string $scan): void
    {
        $this->scan = $scan;
    }

    /**
     * @param int $sum
     */
    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }




}

?>
