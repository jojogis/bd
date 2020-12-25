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

    public function findById(int $id): ?Programmer
    {
        $res = $this->db->readQuery("SELECT * FROM programmers WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(Programmer $programmer): bool
    {
        $birthdate = $programmer->getBirthdate()->format("Y-m-d");
        return $this->db->writeQuery("INSERT INTO programmers VALUES(NULL,?,?,?,?);","ssss",
            $birthdate,
            $programmer->getName(),
            $programmer->getPhone(),
            $programmer->getSpecialization(),
        );

    }

    public function update(Programmer $programmer): bool
    {
        $birthdate = $programmer->getBirthdate()->format("Y-m-d");
        return $this->db->writeQuery("UPDATE programmers SET birthdate=?,name=?,phone=?,specialization =? WHERE id=?;","ssssi",
            $birthdate,
            $programmer->getName(),
            $programmer->getPhone(),
            $programmer->getSpecialization(),
            $programmer->getId()
        );

    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM programmers WHERE id=?;","i",$id);
    }

    public function fromStringArray(array $res) : Programmer{
        return new Programmer(
            intval($res["id"]),
            new DateTime($res["birthdate"]),
            $res["name"],
            $res["phone"],
            $res["specialization"]
        );
    }
}