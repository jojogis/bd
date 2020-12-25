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

  public function filter(?int $categoryId = null) : array{
    $res = $this->db->readQuery("SELECT * FROM projects WHERE categories_id = ?","i", $categoryId);
    $resArr = array();
    foreach ($res as $row) {
      array_push($resArr,$this->fromStringArray($row));
    }
    return $resArr;
  }

  public function findAll() : array{
    $resArr = array();
    $res = $this->db->readQuery("SELECT * FROM projects");
      foreach ($res as $row) {
          array_push($resArr,$this->fromStringArray($row));
      }
    return $resArr;
  }

  public function findById(int $id) : ?Project{
    $res = $this->db->readQuery("SELECT * FROM projects WHERE id = ?;","i", $id);
    if(count($res) == 0)return null;
    return $this->fromStringArray($res[0]);
  }

  public function findByOrdersId(int $orders_id) : ?Project{
    $res = $this->db->readQuery("SELECT * FROM projects WHERE orders_id = ?;","i", $orders_id);
    if(count($res) == 0)return null;
    return $this->fromStringArray($res[0]);
  }

  public function create(Project $p) : bool{
    $plannedReleaseDate = $p->getPlannedReleaseDate()->format("Y-m-d");
    $realReleaseDate = is_null($p->getRealReleaseDate()) ? null: $p->getRealReleaseDate()->format("Y-m-d");
    return $this->db->writeQuery("INSERT INTO projects VALUES(NULL,?,?,?,?,?,?,?);","isssssi",
      (int)$p->getIsByOrder(),
      $p->getName(),
      $plannedReleaseDate,
      $realReleaseDate,
      $p->getVersion(),
      !$p->getOrdersId() ? "NULL" : $p->getOrdersId(),
      $p->getCategoriesId()
    );


  }

  public function update(Project $p) : bool{
    $plannedReleaseDate = $p->getPlannedReleaseDate()->format("Y-m-d");
    $realReleaseDate = is_null($p->getRealReleaseDate()) ? null: $p->getRealReleaseDate()->format("Y-m-d");
    return $this->db->writeQuery("UPDATE projects SET is_by_order=?,name=?,planned_release_date=?,
      real_release_date=?,version=?,orders_id=?,categories_id=? WHERE id=?;","issssiii",
      (int)$p->getIsByOrder(),
      $p->getName(),
      $plannedReleaseDate,
      $realReleaseDate,
      $p->getVersion(),
      !$p->getOrdersId() ? NULL : $p->getOrdersId(),
      $p->getCategoriesId(),
      $p->getId(),
    );

  }

  public function delete(int $id) : bool{
    return $this->db->writeQuery("DELETE FROM projects WHERE id=?;","i",$id);
  }

  public function getBreadcrumbs(int $id) : String{
    return $this->db->readQuery("SELECT get_category(?) AS res;","i",$id)[0]["res"];
  }

  public function fromStringArray(array $res) : Project{
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
