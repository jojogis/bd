<?php
declare(strict_types=1);
namespace Model;
use DateTime;

class Project{
  private ?int $id;
  private bool $isByOrder;
  private string $name;
  private DateTime $plannedReleaseDate;
  private ?DateTime $realReleaseDate;
  private string $version;
  private ?int $ordersId;
  private int $categoriesId;

  public function getId() : int {return $this->id;}
  public function getIsByOrder() : bool {return $this->isByOrder;}
  public function getName() : string {return $this->name;}
  public function getPlannedReleaseDate() : DateTime {return $this->plannedReleaseDate;}
  public function getRealReleaseDate() : ?DateTime {return $this->realReleaseDate;}
  public function getVersion() : string {return $this->version;}
  public function getOrdersId() : int {return $this->ordersId;}
  public function getCategoriesId() : int {return $this->categoriesId;}

  //public function setId(int $id){$this->id = $id;}
  public function setIsByOrder(bool $isByOrder){$this->isByOrder = $isByOrder;}
  public function setName(string $name){$this->name = $name;}
  public function setPlannedReleaseDate(DateTime $plannedReleaseDate){$this->plannedReleaseDate = $plannedReleaseDate;}
  public function setRealReleaseDate(DateTime $realReleaseDate){$this->realReleaseDate = $realReleaseDate;}
  public function setVersion(string $version){$this->version = $version;}
  public function setOrdersId(int $ordersId){$this->ordersId = $ordersId;}
  public function setCategoriesId(int $categoriesId){$this->categoriesId = $categoriesId;}

  function __construct(?int $id,
  bool $isByOrder,
  string $name,
  DateTime $plannedReleaseDate,
  ?DateTime $realReleaseDate,
  string $version,
  ?int $ordersId,
  int $categoriesId
){
  $this->id = $id;
  $this->isByOrder = $isByOrder;
  $this->name = $name;
  $this->plannedReleaseDate = $plannedReleaseDate;
  $this->realReleaseDate = $realReleaseDate;
  $this->version = $version;
  $this->ordersId = $ordersId;
  $this->categoriesId = $categoriesId;
  }
}

?>
