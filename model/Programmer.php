<?php


namespace Model;


use DateTime;

class Programmer
{
    private ?int $id;
    private DateTime $birthdate;
    private string $name;
    private string $phone;
    private ?string $specialization;

    public function __construct(?int $id,
                                DateTime $birthdate,
                                string $name,
                                string $phone,
                                ?string $specialization)
    {
        $this->id = $id;
        $this->birthdate = $birthdate;
        $this->name = $name;
        $this->phone = $phone;
        $this->specialization = $specialization;
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
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param DateTime $birthdate
     */
    public function setBirthdate(DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
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
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    /**
     * @param string|null $specialization
     */
    public function setSpecialization(?string $specialization): void
    {
        $this->specialization = $specialization;
    }


}