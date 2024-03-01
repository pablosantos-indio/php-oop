<?php

namespace App\Models;

use PDO;
use App\DB\DBConnection;

class Customer extends Model
{
    private int $customerID;
    private $lastName;
    private $firstName;
    private $address;

    public function __construct(string $lastName = null, string $firstName = null, string $address = null)
    {
        parent::__construct();

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->address = $address;
    }

    // Getters

    public function getID(): int
    {
        return $this->customerID;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    // Setters

    public function setId(int $id): Customer
    {
        $this->customerID = $id;
        return $this;
    }

    public function setLastName(string $lastName): Customer
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setFirstName(string $firstName): Customer
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setAddress(string $address): Customer
    {
        $this->address = $address;
        return $this;
    }

    public function create(): Customer
    {
        $connection = $this->getDBConnection()->getConnection();

        $sql = 'INSERT INTO tblCustomer (lastName, firstName, address) VALUES (:lastName, :firstName, :address)';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('lastName', $this->lastName);
        $stmt->bindValue('firstName', $this->firstName);
        $stmt->bindValue('address', $this->address);
        $stmt->execute();

        $this->customerID = $connection->lastInsertId();

        return $this;
    }

    public function delete(): bool
    {
        $connection = $this->getDBConnection()->getConnection();

        $sql = 'DELETE FROM tblCustomer WHERE customerID = :id';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('id', $this->customerID);

        return $stmt->execute();
    }

    public function update(): bool
    {
        $connection = $this->getDBConnection()->getConnection();

        $sql = 'UPDATE tblCustomer SET lastName = :lastName, firstName = :firstName, address = :address WHERE customerID = :id';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('lastName', $this->lastName);
        $stmt->bindValue('firstName', $this->firstName);
        $stmt->bindValue('address', $this->address);
        $stmt->bindValue('id', $this->customerID);

        return $stmt->execute();
    }

    public static function find(int $id): Customer|bool
    {
        $connection = (new DBConnection())->getConnection();

        $sql = 'SELECT * FROM tblCustomer WHERE customerID = :id';
        $stmt = $connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Customer::class);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        return $customer = $stmt->fetch();
    }

    public static function validate(): array|bool
    {
        $errors = [
            'lastName' => '',
            'firstName' => '',
            'address' => ''
        ];
        $fields = $errors;

        $fields['lastName'] = trim($_POST['lastName']);
        $fields['firstName'] = trim($_POST['firstName']);
        $fields['address'] = trim($_POST['address']);

        if (empty($fields['lastName'])) {
            $errors['lastName'] = 'Last name is required';
        } elseif ($fields['lastName'] < 50) {
            $errors['lastName'] = 'Last name must be 50 characters or less';
        }

        if (empty($fields['firstName'])) {
            $errors['firstName'] = 'First name is required';
        } elseif ($fields['firstName'] < 50) {
            $errors['firstName'] = 'First name must be 50 characters or less';
        }

        if (empty($fields['address'])) {
            $errors['address'] = 'Address is required';
        } elseif ($fields['address'] < 100) {
            $errors['address'] = 'address must be 100 characters or less';
        }

        if (implode('', $errors) !== '') {
            $_SESSION['errors'] = $errors;
            $_SESSION['fields'] = $fields;
            return false;
        }

        return $fields;
    }
}
