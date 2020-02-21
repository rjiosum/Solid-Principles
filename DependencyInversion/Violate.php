<?php declare(strict_types=1);

namespace DependencyInversion\Violate;

//User class is High Level Module and it depends on low level MysqlDatabase module
class User
{
    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }

    public function add()
    {
        $this->database->persist();
    }
}


//MysqlDatabase class is Low Level Module
class MysqlDatabase
{
    public function persist()
    {
        echo 'Data persisted using Mysql Database';
    }
}

//OracleDatabase class is Low Level Module
class OracleDatabase
{
    public function persist()
    {
        echo 'Data persisted using Oracle Database';
    }
}

$user = new User(new MysqlDatabase);
$user->add();
//The above code will work fine, but if we try to use oracle database it will break i.e
$user = new User(new OracleDatabase); //This will break
$user->add();
