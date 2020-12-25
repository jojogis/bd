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
    public function filter(?int $projectId=null,?int $investorId=null) : array{
        if(is_null($projectId) && !is_null($investorId)){
            $res = $this->db->readQuery("SELECT * FROM external_financing WHERE investor_id = ?","i", $investorId);
        }else if(!is_null($projectId) && is_null($investorId)){
            $res = $this->db->readQuery("SELECT * FROM external_financing WHERE project_id = ?","i", $projectId);
        }else{
            $res = $this->db->readQuery("SELECT * FROM external_financing WHERE project_id = ? AND investor_id=?","ii", $projectId,$investorId);
        }

        $resArr = array();
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): ?ExternalFinancing
    {
        $res = $this->db->readQuery("SELECT * FROM external_financing WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(ExternalFinancing $externalFinancing): bool
    {
        return $this->db->writeQuery("INSERT INTO external_financing VALUES(NULL,?,?,?);","iii",
            $externalFinancing->getTotal(),
            $externalFinancing->getProjectId(),
            $externalFinancing->getInvestorId()
        );
    }

    public function update(ExternalFinancing $externalFinancing): bool
    {
        return $this->db->writeQuery("UPDATE external_financing SET total=?,project_id=?,investor_id=? WHERE id=?;","iiii",
            $externalFinancing->getTotal(),
            $externalFinancing->getProjectId(),
            $externalFinancing->getInvestorId(),
            $externalFinancing->getId()
        );
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM external_financing WHERE id=?;","i",$id);

    }
    public function fromStringArray(array $res) : ExternalFinancing{
        return new ExternalFinancing(
            intval($res["id"]),
            intval($res["total"]),
            intval($res["project_id"]),
            intval($res["investor_id"])
        );
    }
}