<?php
declare(strict_types=1);
namespace Repository;

use Repository\abstract\OrderRepositoryInterface;
use Model\Order;
use \DateTime;

class OrderRepository implements OrderRepositoryInterface{
    private DB $db;
    function __construct(DB $db){
        $this->db = $db;
    }


    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM orders");
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function filter(?int $customerId) : array{
        $res = $this->db->readQuery("SELECT * FROM orders WHERE customers_id = ?","i", $customerId);
        $resArr = array();
        foreach ($res as $row) {
            array_push($resArr,$this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): ?Order
    {
        $res = $this->db->readQuery("SELECT * FROM orders WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(Order $order): bool
    {
        $deadline = $order->getDeadline()->format("Y-m-d");
        $date = $order->getDate()->format("Y-m-d");
        return $this->db->writeQuery("INSERT INTO orders VALUES(NULL,?,?,?,?,?,?,?);","isssssi",
            $order->getSum(),
            $deadline,
            $date,
            $order->getDescription(),
            !$order->getActOfCompletionId() ? "NULL" : $order->getActOfCompletionId(),
            $order->getScan(),
            !$order->getCustomerId() ? "NULL" : $order->getCustomerId()
        );


    }

    public function update(Order $order): bool
    {
        $deadline = $order->getDeadline()->format("Y-m-d");
        $date = $order->getDate()->format("Y-m-d");
        return $this->db->writeQuery("UPDATE orders SET sum=?,deadline=?,date=?,description=?,
                  acts_of_completion_id=?,scan=?,customers_id=? WHERE id=?;","isssssii",
            $order->getSum(),
            $deadline,
            $date,
            $order->getDescription(),
            !$order->getActOfCompletionId() ? "NULL" : $order->getActOfCompletionId(),
            $order->getScan(),
            !$order->getCustomerId() ? "NULL" : $order->getCustomerId(),
            $order->getId()
        );
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM orders WHERE id=?;","i",$id);
    }

    public function fromStringArray(array $res) : Order{
        return new Order(
            intval($res["id"]),
            intval($res["sum"]),
            is_null($res["deadline"]) ? null : new DateTime($res["deadline"]),
            new DateTime($res["date"]),
            $res["description"],
            intval($res["acts_of_completion_id"]),
            $res["scan"],
            intval($res["customers_id"])
        );
    }
}
