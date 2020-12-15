<?php
declare(strict_types=1);

namespace Model;

class Investor
{

    private ?int $id;
    private string $name;
    private ?string $address;
    private ?string $phone;

    public function __construct(?int $id,
                         string $name,
                         ?string $address,
                         ?string $phone
    ){
        $this->address = $address;
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
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
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


}