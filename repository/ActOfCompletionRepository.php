<?php
declare(strict_types=1);

namespace Repository;


use Repository\abstract\ActOfCompletionRepositoryInterface;
use Model\ActOfCompletion;
use DateTime;

class ActOfCompletionRepository implements ActOfCompletionRepositoryInterface
{
    private DB $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM acts_of_completion");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): ActOfCompletion
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM acts_of_completion WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(ActOfCompletion $actOfCompletion): bool
    {
        $date = $actOfCompletion->getDate()->format("Y-m-d");
        $sql = sprintf("INSERT INTO acts_of_completion VALUES(NULL,'%s','%s');",
            $date,
            $actOfCompletion->getScan()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(ActOfCompletion $actOfCompletion): bool
    {
        $date = $actOfCompletion->getDate()->format("Y-m-d");
        $sql = sprintf("UPDATE acts_of_completion SET date='%s',scan='%s' WHERE id=%d;",
            $date,
            $actOfCompletion->getScan(),
            $actOfCompletion->getId()
        );

        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM acts_of_completion WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }
    private function fromStringArray(array $res) : ActOfCompletion{
        return new ActOfCompletion(
            intval($res["id"]),
            new DateTime($res["date"]),
            $res["scan"]
        );
    }
}