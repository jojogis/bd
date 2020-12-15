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

    public function findById(int $id): Order
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM orders WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Order $order): bool
    {
        $deadline = $order->getDeadline()->format("Y-m-d");
        $date = $order->getDate()->format("Y-m-d");
        $sql = sprintf("INSERT INTO orders VALUES(NULL,%d,'%s','%s','%s','%s',%s,%d);",
            $order->getSum(),
            $deadline,
            $date,
            $order->getDescription(),
            !$order->getActOfCompletionId() ? "NULL" : $order->getActOfCompletionId(),
            $order->getScan(),
            !$order->getCustomerId() ? "NULL" : $order->getCustomerId()
        );

        return $this->db->writeQuery($sql);
    }

    public function update(Order $order): bool
    {
        $deadline = $order->getDeadline()->format("Y-m-d");
        $date = $order->getDate()->format("Y-m-d");
        $sql = sprintf("UPDATE orders SET sum=%d,deadline='%s',date='%s',description='%s',
                  acts_of_completion_id=%d,scan=%s,customers_id=%d WHERE id=%d;",
            $order->getSum(),
            $deadline,
            $date,
            $order->getDescription(),
            !$order->getActOfCompletionId() ? "NULL" : $order->getActOfCompletionId(),
            $order->getScan(),
            !$order->getCustomerId() ? "NULL" : $order->getCustomerId(),
            $order->getId()
        );
        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM orders WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }

    private function fromStringArray(array $res) : Order{
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
