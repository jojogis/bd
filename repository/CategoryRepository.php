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
        $res = $this->db->readQuery("SELECT * FROM categories WHERE id = ?","i", $id)[0];
        return $this->fromStringArray($res);
    }

    public function create(Category $category): bool
    {
        return $this->db->writeQuery("INSERT INTO categories VALUES(NULL,?,?);","si",
            $category->getName(),
            !$category->getParentId() ? "NULL" : $category->getParentId()
        );
    }

    public function update(Category $category): bool
    {
        return $this->db->writeQuery("UPDATE categories SET name=?,parent_id=? WHERE id=?;","sii",
            $category->getName(),
            !$category->getParentId() ? "NULL" : $category->getParentId(),
            $category->getId()
        );

    }

    public function getCatPath(int $id) : String{
        return $this->db->readQuery("SELECT get_category(?) AS res;","i",$id)[0]["res"];
    }

    public function getCategoryCount(int $id) : int{
        return $this->db->readQuery("SELECT COUNT(*) FROM projects WHERE categories_id=?;","i",$id)[0]["COUNT(*)"];
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM categories WHERE id=?;","i",$id);
    }

    public function fromStringArray(array $res) : Category{
        return new Category(
            intval($res["id"]),
            $res["name"],
            intval($res["parent_id"]),
        );
    }
}