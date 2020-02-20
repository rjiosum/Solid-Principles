<?php declare(strict_types=1);

namespace SingleResponsibility\Violate;
use Exception;

class Customer{
    private $firstName;
    private $lastName;
    private $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /** @throws \Exception */
    public function validateFirstName()
    {
        if(!is_string($this->firstName)){
            throw new Exception('Invalid First Name');
        }
        return true;
    }

    /** @throws \Exception */
    public function validateLastName()
    {
        if(!is_string($this->lastName)){
            throw new Exception('Invalid Last Name');
        }
        return true;
    }

    /** @throws \Exception */
    public function validateEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email address');
        }
        return true;
    }
}

/* In the above class validations methods violate SRP principle */

$customer = new Customer('Raj', 'Verma', 'rjiosum@gmail.com');
try {
    $customer->validateFirstName();
    $customer->validateLastName();
    $customer->validateEmail();
}catch (Exception $e){
    echo $e->getMessage();
}