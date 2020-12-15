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
        $res = $this->db->readQuery(sprintf("SELECT * FROM parts_of_tasks WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(PartOfTask $partOfTask): bool
    {

        $finishDate = $partOfTask->getFinishDate()->format("Y-m-d");
        $sql = sprintf("INSERT INTO parts_of_tasks VALUES(NULL,'%s','%s','%s',%d,%d);",
            $partOfTask->getName(),
            $partOfTask->getDescription(),
            $finishDate,
            $partOfTask->getTaskId(),
            $partOfTask->getProgrammersId()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(PartOfTask $partOfTask): bool
    {
        $finishDate = $partOfTask->getFinishDate()->format("Y-m-d");
        $sql = sprintf("UPDATE parts_of_tasks SET name='%s',description='%s',finish_date='%s',tasks_id=%d,programmers_id=%d WHERE id=%d;",
            $partOfTask->getName(),
            $partOfTask->getDescription(),
            $finishDate,
            $partOfTask->getTaskId(),
            $partOfTask->getProgrammersId(),
            $partOfTask->getId()
        );

        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM parts_of_tasks WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
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