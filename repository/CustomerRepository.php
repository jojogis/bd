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

    public function findById(int $id): ?Customer
    {
        $res = $this->db->readQuery("SELECT * FROM customers WHERE id = ?","i", $id);
        if(count($res) == 0)return null;
        return $this->fromStringArray($res[0]);
    }

    public function create(Customer $customer): bool
    {
        return $this->db->writeQuery("INSERT INTO customers VALUES(NULL,?,?,?);","sss",
            $customer->getName(),
            $customer->getAddress(),
            $customer->getPhone()
        );
    }

    public function update(Customer $customer): bool
    {
        return $this->db->writeQuery("UPDATE customers SET name=?,address=?,phone=? WHERE id=?;","sssi",
            $customer->getName(),
            $customer->getAddress(),
            $customer->getPhone(),
            $customer->getId()
        );
    }

    public function delete(int $id): bool
    {
        return $this->db->writeQuery("DELETE FROM customers WHERE id=?;","i",$id);
    }
    public function fromStringArray(array $res) : Customer
    {
        return new Customer(
            intval($res["id"]),
            $res["name"],
            $res["address"],
            $res["phone"]
        );
    }

}