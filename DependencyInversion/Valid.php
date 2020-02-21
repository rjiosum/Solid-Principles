<?php declare(strict_types=1);

namespace DependencyInversion\Valid;

//User class is High Level Module and it depends on Database abstraction
class User
{
    private $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function add()
    {
        $this->database->persist();
    }
}

interface DatabaseInterface
{
    public function persist();
}
//MysqlDatabase class is Low Level Module  and it depends on Database abstraction
class MysqlDatabase implements DatabaseInterface
{
    public function persist()
    {
        echo 'Data persisted using Mysql Database';
    }
}
//OracleDatabase class is Low Level Module   and it depends on Database abstraction
class OracleDatabase implements DatabaseInterface
{
    public function persist()
    {
        echo 'Data persisted using Oracle Database';
    }
}

//Now we can easily switch between both low level modules
$user = new User(new MysqlDatabase);
$user->add();

$user = new User(new OracleDatabase);
$user->add();
