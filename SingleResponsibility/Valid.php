<?php declare(strict_types=1);

namespace SingleResponsibility\Valid;
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
}

interface ValidatorInterface
{
    public function validate($input);
}

class StringValidator implements ValidatorInterface
{
    /**  @throws Exception */
    public function validate($input)
    {
        if (!is_string($input)) {
            throw new Exception("The input value seems to be invalid.");
        }
        return true;
    }
}

class EmailValidator implements ValidatorInterface
{
    /**  @throws Exception */
    public function validate($input)
    {
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("The input value seems to be invalid.");
        }
        return true;
    }
}

class CustomerValidator
{
    /** @var Customer $customer */
    protected $customer;
    protected $stringValidator;
    protected $emailValidator;

    public function __construct(StringValidator $stringValidator, EmailValidator $emailValidator)
    {
        $this->stringValidator = $stringValidator;
        $this->emailValidator = $emailValidator;
    }

    /**
     * @param Customer $customer
     * @return boolean
     * @throws Exception
    */
    public function validate(Customer $customer)
    {
        $this->customer = $customer;
        $this->validateFirstName()->validateLastName()->validateEmail();
        return true;
    }
    /**  @throws Exception */
    private function validateFirstName()
    {
        $this->stringValidator->validate($this->customer->getFirstName());
        return $this;
    }
    /**  @throws Exception */
    private function validateLastName()
    {
        $this->stringValidator->validate($this->customer->getLastName());
        return $this;
    }
    /**  @throws Exception */
    private function validateEmail()
    {
        $this->stringValidator->validate($this->customer->getEmail());
        return $this;
    }
}


$customer = new Customer('Raj', 'Verma', 'rjiosum@gmail.com');
try {
    $validator = new CustomerValidator(new StringValidator, new EmailValidator);
    $validator->validate($customer);
}catch (Exception $e){
    echo $e->getMessage();
}