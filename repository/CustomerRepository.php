<?php
declare(strict_types=1);
namespace Repository;

use Repository\abstract\CustomerRepositoryInterface;
use Model\Customer;


class CustomerRepository implements CustomerRepositoryInterface
{
    private DB $db;

    function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $resArr = array();
        $res = $this->db->readQuery("SELECT * FROM customers");
        foreach ($res as $row) {
            array_push($resArr, $this->fromStringArray($row));
        }
        return $resArr;
    }

    public function findById(int $id): Customer
    {
        $res = $this->db->readQuery(sprintf("SELECT * FROM customers WHERE id = %d", $id))[0];
        return $this->fromStringArray($res);
    }

    public function create(Customer $customer): bool
    {
        $sql = sprintf("INSERT INTO customers VALUES(NULL,%d,'%s','%s','%s');",
            $customer->getName(),
            $customer->getAddress(),
            $customer->getPhone()
        );
        return $this->db->writeQuery($sql);
    }

    public function update(Customer $customer): bool
    {
        $sql = sprintf("UPDATE customers SET name='%s',address='%s',date='%s',phone='%s' WHERE id=%d;",
            $customer->getName(),
            $customer->getAddress(),
            $customer->getPhone(),
            $customer->getId()
        );
        return $this->db->writeQuery($sql);
    }

    public function delete(int $id): bool
    {
        $sql = sprintf("DELETE FROM customers WHERE id=%d;",$id);
        return $this->db->writeQuery($sql);
    }
    private function fromStringArray(array $res) : Customer
    {
        return new Customer(
            intval($res["id"]),
            $res["name"],
            $res["address"],
            $res["phone"]
        );
    }

}