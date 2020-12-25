<?php
declare(strict_types=1);

namespace Repository;

use Model\PartOfTask;
use Repository\abstract\PartOfTaskRepositoryInterface;
use DateTime;
class PartOfTaskRepository implements PartOfTaskRepositoryInterface
{
    private DB $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM parts_of_tasks");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): PartOfTask
    {
        $res = $this->db->readQuery("SELECT * FROM parts_of_tasks WHERE id = ?","i", $id)[0];
        return $this->fromStringArray($res);
    }

    public function create(PartOfTask $partOfTask): bool
    {

        $finishDate = $partOfTask->getFinishDate()->format("Y-m-d");
        return $this->db->writeQuery("INSERT INTO parts_of_tasks VALUES(NULL,'?','?','?',?,?);","sssii",
            $partOfTask->getName(),
            $partOfTask->getDescription(),
            $finishDate,
            $partOfTask->getTaskId(),
            $partOfTask->getProgrammersId()
        );
    }

    public function update(PartOfTask $partOfTask): bool
    {
        $finishDate = $partOfTask->getFinishDate()->format("Y-m-d");
        return $this->db->writeQuery("UPDATE parts_of_tasks SET name='?',description='?',finish_date='?',tasks_id=?,programmers_id=? WHERE id=?;","sssiii",
            $partOfTask->getName(),
            $partOfTask->getDescription(),
            $finishDate,
            $partOfTask->getTaskId(),
            $partOfTask->getProgrammersId(),
            $partOfTask->getId()
        );

    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM parts_of_tasks WHERE id=?;","i",$id);
    }
    private function fromStringArray(array $res) : PartOfTask{
        return new PartOfTask(
            intval($res["id"]),
            $res["name"],
            $res["description"],
            new DateTime($res["finish_date"]),
            intval($res["tasks_id"]),
            intval($res["programmers_id"])
        );
    }
}