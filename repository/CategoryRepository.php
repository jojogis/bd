<?php

declare(strict_types=1);
namespace Repository;

use Repository\abstract\CategoryRepositoryInterface;
use Model\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    private DB $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM categories");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): Category
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM categories WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Category $category): bool
    {
        $sql = sprintf("INSERT INTO categories VALUES(NULL,'%s',%d);",
            $category->getName(),
            !$category->getParentId() ? "NULL" : $category->getParentId()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(Category $category): bool
    {
        $sql = sprintf("UPDATE categories SET name='%s',parent_id=%d WHERE id=%d;",
            $category->getName(),
            !$category->getParentId() ? "NULL" : $category->getParentId(),
            $category->getId()
        );

        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM categories WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }

    private function fromStringArray(array $res) : Category{
        return new Category(
            intval($res["id"]),
            $res["name"],
            intval($res["parent_id"]),
        );
    }
}