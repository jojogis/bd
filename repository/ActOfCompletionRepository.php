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
        $res = $this->db->readQuery("SELECT * FROM acts_of_completion WHERE id = ?","i", $id)[0];
        return $this->fromStringArray($res);
    }

    public function create(ActOfCompletion $actOfCompletion): bool
    {
        $date = $actOfCompletion->getDate()->format("Y-m-d");
        return $this->db->writeQuery("INSERT INTO acts_of_completion VALUES(NULL,'?','?');","ss",
            $date,
            $actOfCompletion->getScan()
        );
    }

    public function update(ActOfCompletion $actOfCompletion): bool
    {
        $date = $actOfCompletion->getDate()->format("Y-m-d");
        $this->db->writeQuery("UPDATE acts_of_completion SET date='?',scan='?' WHERE id=?;","ssi",
            $date,
            $actOfCompletion->getScan(),
            $actOfCompletion->getId()
        );
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM acts_of_completion WHERE id=?;","i",$id);
    }
    private function fromStringArray(array $res) : ActOfCompletion{
        return new ActOfCompletion(
            intval($res["id"]),
            new DateTime($res["date"]),
            $res["scan"]
        );
    }
}