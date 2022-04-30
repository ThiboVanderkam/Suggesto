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
        return $hash;
    }

    function checkPassword($password, $hashInDatabase) {
        $result = password_verify($password, $hashInDatabase);
        if ($result == 1) {
            return True;
        }
        elseif ($result == 0) {
            return False;
        }
    }

    function login($parameters) {
        $email = $parameters["email"];
        $password = $parameters["password"];

        $query = "SELECT u_password FROM user WHERE u_email =\"" . $email . "\";";
        $hashInDatabase = $this->conn->getQuery($query)[0]["u_password"];
        $correct = $this->checkPassword($password, $hashInDatabase);
        return $correct;
    }

    function signUp($parameters) {
        $name= $parameters["name"];
        $surname = $parameters["surname"];
        $birthday = $parameters["birthday"];
        $email = $parameters["email"];
        $password = $parameters["password"];
        $hash = $this->hashPassword($password);
        $query = "INSERT INTO `user` (`u_isverified`, `u_firstname`, `u_lastname`, `u_dob`, `u_email`, `u_password`, `u_id`) VALUES ('1', '$name', '$surname', '$birthday', '$email', '$hash', NULL);";
        $this->conn->insertQuery($query);
        return "done";
    }

    
    function selectCall($parameters) {
        if ($parameters["call"] == "login") {
            $output = $this->login($parameters);
            return $output;
        }
        elseif ($parameters["call"] == "signUp") {
            $output = $this->signUp($parameters);
            return $output;
        }
        
    }
}