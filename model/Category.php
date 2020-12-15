<?php
declare(strict_types=1);
namespace Model;

class Category
{
    private ?int $id;
    private ?string $name;
    private ?int $parentId;
    public function __construct(?int $id, ?string $name, ?int $parentId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @param int|null $parentId
     */
    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

}