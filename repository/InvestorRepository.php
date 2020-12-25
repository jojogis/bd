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

    public function findById(int $id): ?Investor
    {
        $res = $this->db->readQuery("SELECT * FROM investors WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(Investor $investor): bool
    {
        return $this->db->writeQuery("INSERT INTO investors VALUES(NULL,?,?,?);","sss",
            $investor->getName(),
            $investor->getAddress(),
            $investor->getPhone()
        );
    }

    public function update(Investor $investor): bool
    {
        return $this->db->writeQuery("UPDATE investors SET name=?,address=?,phone=? WHERE id=?;","sssi",
            $investor->getName(),
            $investor->getAddress(),
            $investor->getPhone(),
            $investor->getId()
        );
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM investors WHERE id=?;","i",$id);
    }
    public function fromStringArray(array $res) : Investor
    {
        return new Investor(
            intval($res["id"]),
            $res["name"],
            is_null($res["address"]) ? "" : $res["address"],
            $res["phone"]
        );
    }

}