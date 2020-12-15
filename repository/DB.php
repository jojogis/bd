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
  public function readQuery(string $query) : array{
    return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
  }

  public function writeQuery(string $query) : bool{
    $res = $this->mysqli->query($query);
    if($res === FALSE){
      return false;
    }else{
      return true;
    }
  }

}



?>
