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

    public function findById(int $id): ?Task
    {
        $res = $this->db->readQuery("SELECT * FROM tasks WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(Task $task): bool
    {
        $plan_finish_date  = $task->getPlanFinishDate()->format("Y-m-d");
        $real_finish_date = is_null($task->getRealFinishDate()) ? null: $task->getRealFinishDate()->format("Y-m-d");
        return $this->db->writeQuery("INSERT INTO tasks VALUES(NULL,?,?,?,?,?);","ssssi",
            $plan_finish_date,
            $real_finish_date,
            $task->getName(),
            $task->getDescription(),
            !$task->getProjectId() ? "NULL" : $task->getProjectId()
        );
    }

    public function update(Task $task): bool
    {
        $plan_finish_date  = $task->getPlanFinishDate()->format("Y-m-d");
        $real_finish_date = is_null($task->getRealFinishDate()) ? null: $task->getRealFinishDate()->format("Y-m-d");
        return $this->db->writeQuery("UPDATE tasks SET plan_finish_date=?,real_finish_date=?,name=?,description=?,project_id=? WHERE id=?",
            "ssssii",
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
        return $this->db->writeQuery("DELETE FROM tasks WHERE id=?;","i",$id);
    }
    public function fromStringArray(array $res) : Task
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