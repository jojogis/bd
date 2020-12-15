<?php


namespace Repository;

use DateTime;
use Repository\abstract\ProgrammerRepositoryInterface;
use Model\Programmer;

class ProgrammerRepository implements ProgrammerRepositoryInterface
{
    private DB $db;

    function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM programmers");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): Programmer
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM programmers WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Programmer $programmer): bool
    {
        $birthdate = $programmer->getBirthdate()->format("Y-m-d");
        $sql = sprintf("INSERT INTO programmers VALUES(NULL,'%s','%s','%s','%s');",
            $birthdate,
            $programmer->getName(),
            $programmer->getPhone(),
            $programmer->getSpecialization(),
        );

        return $this->db->writeQuery($sql);
    }

    public function update(Programmer $programmer): bool
    {
        $birthdate = $programmer->getBirthdate()->format("Y-m-d");
        $sql = sprintf("UPDATE programmers SET birthdate='%s',name='%s',phone='%s',specialization ='%s' WHERE id=%d;",
            $birthdate,
            $programmer->getName(),
            $programmer->getPhone(),
            $programmer->getSpecialization(),
            $programmer->getId()
        );
        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM programmers WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }

    private function fromStringArray(array $res) : Programmer{
        return new Programmer(
            intval($res["id"]),
            new DateTime($res["birthdate"]),
            $res["name"],
            $res["phone"],
            $res["specialization"]
        );
    }
}