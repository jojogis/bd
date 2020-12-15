<?php
declare(strict_types=1);
namespace Repository;

use Repository\abstract\InvestorRepositoryInterface;
use Model\Investor;


class InvestorRepository implements InvestorRepositoryInterface
{
    private DB $db;

    function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM investors");
        foreach ($res as $row) {
            array_push($resArr, $this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): Investor
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM investors WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Investor $investor): bool
    {
        $sql = sprintf("INSERT INTO investors VALUES(NULL,%d,'%s','%s','%s');",
            $investor->getName(),
            $investor->getAddress(),
            $investor->getPhone()
        );
        return $this->db->writeQuery($sql);
    }

    public function update(Investor $investor): bool
    {
        $sql = sprintf("UPDATE investors SET name='%s',address='%s',date='%s',phone='%s' WHERE id=%d;",
            $investor->getName(),
            $investor->getAddress(),
            $investor->getPhone(),
            $investor->getId()
        );
        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM investors WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }
    private function fromStringArray(array $res) : Investor
    {
        return new Investor(
            intval($res["id"]),
            $res["name"],
            is_null($res["address"]) ? "" : $res["address"],
            $res["phone"]
        );
    }

}