<?php

declare(strict_types=1);
namespace Repository;


use Repository\abstract\TaskRepositoryInterface;
use Model\Task;
use DateTime;

class TaskRepository implements TaskRepositoryInterface
{
    private DB $db;
    function __construct(DB $db){
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM tasks");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): Task
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM tasks WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Task $task): bool
    {
        $plan_finish_date  = $task->getPlanFinishDate()->format("Y-m-d");
        $real_finish_date   = $task->getRealFinishDate()->format("Y-m-d");
        $sql = sprintf("INSERT INTO tasks VALUES(NULL,'%s','%s','%s','%s',%d);",
            $plan_finish_date,
            $real_finish_date,
            $task->getName(),
            $task->getDescription(),
            !$task->getProjectId() ? "NULL" : $task->getProjectId()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(Task $task): bool
    {
        $plan_finish_date  = $task->getPlanFinishDate()->format("Y-m-d");
        $real_finish_date   = $task->getRealFinishDate()->format("Y-m-d");
        $sql = sprintf("UPDATE tasks SET plan_finish_date='%s',real_finish_date='%s',name='%s',description='%s',project_id=%d WHERE id=%d",
            $plan_finish_date,
            $real_finish_date,
            $task->getName(),
            $task->getDescription(),
            !$task->getProjectId() ? "NULL" : $task->getProjectId(),
            $task->getId()
        );
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM tasks WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }
    private function fromStringArray(array $res) : Task
    {
        return new Task(
            intval($res["id"]),
            new DateTime($res["plan_finish_date"]),
            is_null($res["real_finish_date"]) ? null : new DateTime($res["real_finish_date"]),
            $res["name"],
            $res["description"],
            intval($res["project_id"]),
        );
    }
}