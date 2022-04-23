<?php
include "databaseClass.php";

class Api {
    private $conn;


    function __construct()
    {
        
        $this->conn = new Database();
    }

    
    function hashPassword($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash
    }

    function checkPassword($password, $hashInDatabase) {
        $result = password_verify($password, $hashInDatabase);
        if ($result == 1):
            return True
        elseif ($result == 0):
            return False
    }
}