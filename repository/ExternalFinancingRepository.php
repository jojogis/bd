<?php
declare(strict_types=1);

namespace Repository;
use Model\ExternalFinancing;
use Repository\abstract\ExternalFinancingRepositoryInterface;

class ExternalFinancingRepository implements ExternalFinancingRepositoryInterface
{
    private DB $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM external_financing");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): ExternalFinancing
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM external_financing WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(ExternalFinancing $externalFinancing): bool
    {
        $sql = sprintf("INSERT INTO external_financing VALUES(NULL,%d,%d,%d);",
            $externalFinancing->getTotal(),
            $externalFinancing->getProjectId(),
            $externalFinancing->getInvestorId()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(ExternalFinancing $externalFinancing): bool
    {
        $sql = sprintf("UPDATE external_financing SET total=%d,project_id=%d,investor_id=%d WHERE id=%d;",
            $externalFinancing->getTotal(),
            $externalFinancing->getProjectId(),
            $externalFinancing->getInvestorId(),
            $externalFinancing->getId()
        );

        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM external_financing WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }
    private function fromStringArray(array $res) : ExternalFinancing{
        return new ExternalFinancing(
            intval($res["id"]),
            intval($res["total"]),
            intval($res["project_id"]),
            intval($res["investor_id"])
        );
    }
}