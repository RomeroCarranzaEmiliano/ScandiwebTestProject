<?php

namespace core;

use PDO;

class Database
{
    private string $host;
    private string $dbname;
    private string $user;
    private string $pass;

    public function __construct() {
        $this->host = "localhost";
        $this->dbname = "scandiweb";
        $this->user = "root";
        $this->pass = "";
    }

    public function execute(string $query) {

        $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
        $result = $conn->query($query);
        $conn = null;
        return $result;

    }

    public function prepareAndExecute(string $query, array $params) {

        $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt;
        $conn = null;
        return $result;

    }

}