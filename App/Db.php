<?php

namespace App;

use App\Exception\ExceptionDB;

class Db
{

    protected $dbh;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=php2';
        $user = 'root';
        $password = '';
        $this->dbh = new \PDO($dsn, $user, $password);
    }

    public function query($sql, $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false === $res) {
            throw new ExceptionDB($sql);
            //die('DB error in ' . $sql);
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }

    public function execute($sql, $data = []): bool
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($data);
        if (false === $res) {
            throw new ExceptionDB($sql);
        } else {
            return $res;
        }
    }

    public function findId()
    {
        return $this->dbh->lastInsertId();
    }

}