<?php
declare(strict_types=1);

namespace Repository;
use mysqli;
class DB{
  private mysqli $mysqli;
  function __construct(){
      $this->mysqli = new mysqli(
      DB_SETTINGS['host'],
      DB_SETTINGS['user'],
      DB_SETTINGS['pass'],
      DB_SETTINGS['db']);
      if ($this->mysqli->connect_errno) {
        echo "Не удалось подключиться к MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
      }
      $this->mysqli->query("set names utf8;");
      $this->mysqli->set_charset("utf-8");
  }
  public function readQuery(string $query,?string $types = null,...$params) : array{
    $stmt = $this->mysqli->prepare($query);
    if(!is_null($types))$stmt->bind_param($types,...$params);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function writeQuery(string $query,?string $types = null,...$params) : bool{
      $stmt = $this->mysqli->prepare($query);
      if(!is_null($types))$stmt->bind_param($types,...$params);
      $stmt->execute();
      $res = $stmt->get_result();
      if($res === FALSE){
        return false;
      }else{
        return true;
      }
  }
  public function close(): void{
      $this->mysqli->close();
  }

}



?>
