<?php
declare(strict_types=1);
namespace Repository;

use Repository\abstract\ProjectRepositoryInterface;
use Model\Project;
use \DateTime;

class ProjectRepository implements ProjectRepositoryInterface{
  private DB $db;
  function __construct(DB $db){
    $this->db = $db;
  }


  public function findAll() : array{
    $resArr = array();
    $res = $this->db->readQuery("SELECT * FROM projects");
      foreach ($res as $row) {
          array_push($resArr,$this->fromStringArray($row));
      }
    return $resArr;
  }

  public function findById(int $id) : Project{
    $res = $this->db->readQuery(sprintf("SELECT * FROM projects WHERE id = %d", $id))[0];
    return $this->fromStringArray($res);
  }

  public function create(Project $p) : bool{
    $plannedReleaseDate = $p->getPlannedReleaseDate()->format("Y-m-d");
    $realReleaseDate = $p->getRealReleaseDate()->format("Y-m-d");
    $sql = sprintf("INSERT INTO projects VALUES(NULL,%d,'%s','%s','%s','%s',%s,%d);",
      (int)$p->getIsByOrder(),
      $p->getName(),
      $plannedReleaseDate,
      $realReleaseDate,
      $p->getVersion(),
      !$p->getOrdersId() ? "NULL" : $p->getOrdersId(),
      $p->getCategoriesId()
    );

    return $this->db->writeQuery($sql);
  }

  public function update(Project $p) : bool{
    $plannedReleaseDate = $p->getPlannedReleaseDate()->format("Y-m-d");
    $realReleaseDate = $p->getRealReleaseDate()->format("Y-m-d");
    $sql = sprintf("UPDATE projects SET is_by_order=%d,name='%s',planned_release_date='%s',
      real_release_date='%s',version='%s',orders_id=%s,categories_id=%d WHERE id=%d;",
      (int)$p->getIsByOrder(),
      $p->getName(),
      $plannedReleaseDate,
      $realReleaseDate,
      $p->getVersion(),
      !$p->getOrdersId() ? "NULL" : $p->getOrdersId(),
      $p->getCategoriesId(),
      $p->getId()
    );

    return $this->db->writeQuery($sql);
  }

  public function delete(int $id) : bool{
    $sql = sprintf("DELETE FROM projects WHERE id=%d;",$id);
    return $this->db->writeQuery($sql);
  }

  public function getBreadcrumbs(int $id) : String{
    return $this->db->readQuery(sprintf("SELECT get_category(%d) AS res;",$id))[0]["res"];
  }

  private function fromStringArray(array $res) : Project{
    return new Project(
      intval($res["id"]),
      boolval($res["is_by_order"]),
      $res["name"],
      is_null($res["planned_release_date"]) ? null : new DateTime($res["planned_release_date"]),
      is_null($res["real_release_date"]) ? null : new DateTime($res["real_release_date"]),
      $res["version"],
      intval($res["orders_id"]),
      intval($res["categories_id"])
    );
  }



}

?>
