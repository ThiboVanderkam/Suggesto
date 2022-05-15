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

    function getInterests($parameters) {
        $email = $parameters["email"];
        $idQuery = "SELECT u_id FROM user WHERE u_email =\"" . $email . "\";";
        $id = $this->conn->getQuery($idQuery)[0]["u_id"];
        $interestsQuery = "SELECT keyword FROM interests WHERE u_id = \"" . $id . "\";";
        $interests = $this->conn->getQuery($interestsQuery)[0];
        return $interests;
    }

    function storeInterests($parameters) {
        $email = $parameters["email"];
        $interests = $parameters["interests"];
        $interestsArray = explode(",", $interests);
        $idQuery = "SELECT u_id FROM user WHERE u_email =\"" . $email . "\";";
        $id = $this->conn->getQuery($idQuery)[0]["u_id"];
        foreach ($interestsArray as $interest) {
            $query = "INSERT INTO `interests` (`u_id`, `keyword`) VALUES ('$id', '$interest');";
            $this->conn->insertQuery($query);
        }
        return "done";
    }

    function storeLocalInterests($parameters){
        $firstname = $parameters["firstname"];
        $lastname = $parameters["lastname"];
        $birthday = $parameters["birthday"];
        $l_id = $this->conn->getQuery("SELECT local_id FROM local_friend WHERE l_firstname = '$firstname' AND l_lastname = '$lastname' AND l_birthday = '$birthday';")[0]["local_id"];
        $interests = $parameters["interests"];
        $interestsArray = explode(",", $interests);
        foreach ($interestsArray as $interest) {
            if(strlen($interest) > 0){
                $query = "INSERT INTO `interests` (`u_id`, `keyword`) VALUES ('$l_id', '$interest');";
                $this->conn->insertQuery($query);
            }
        }
    }

    function storeUserInterests($parameters){
        $u_id = $parameters["u_id"];
        $interests = $parameters["interests"];
        $interestsArray = explode(",", $interests);
        foreach ($interestsArray as $interest) {
            if(strlen($interest) > 0){
                $query = "INSERT INTO `interests` (`u_id`, `keyword`) VALUES ('$u_id', '$interest');";
                $this->conn->insertQuery($query);
            }
        }
    }

    function addLocalFriend($parameters){
        $firstname = $parameters["firstname"];
        $lastname = $parameters["lastname"];
        $birthday = $parameters["birthday"];
        $query = "INSERT INTO local_friend (local_id, l_firstname, l_lastname, l_birthday) VALUES (NULL, '$firstname', '$lastname', '$birthday');";
        $result = $this->conn->insertQuery($query);
        if($result){
            $u_id = $parameters["u_id"];
            $f_id = $this->conn->getQuery("SELECT local_id FROM local_friend WHERE l_firstname = '$firstname' AND l_lastname = '$lastname' AND l_birthday = '$birthday';")[0]["local_id"];
            $result = $this->conn->insertQuery("INSERT INTO isFriendsWith (u_id, f_id) VALUES ('$u_id', '$f_id');");
            return true;
        }
        else {
            return false;
        }
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


    function getFriendsData($parameters){
        $email = $parameters["email"];
        $userIdQuery = "SELECT u_id FROM user WHERE u_email =\"" . $email . "\";";
        $userId = $this->conn->getQuery($userIdQuery)[0]["u_id"];
        $friendsIdQuery = "SELECT f_id FROM isFriendsWith WHERE u_id ='".$userId."';";
        $friendsId = $this->conn->getQuery($friendsIdQuery);
        $friendsDataQuery = "SELECT local_id, l_firstname, l_lastname, l_birthday FROM local_friend WHERE local_id ='";
        $friendsData = array(count($friendsId));
        for ($i = 0; $i < count($friendsId); $i++){
            $friendsData[$i] = $this->conn->getQuery($friendsDataQuery . $friendsId[$i]["f_id"] . "';")[0];
        }
        return $friendsData;
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
        elseif ($parameters["call"] == "getInterests") {
            $output = $this->getInterests($parameters);
            return $output;
        }
        elseif($parameters["call"] == "getFriendsData"){
            $output = $this->getFriendsData($parameters);
            return $output;
        }
        elseif($parameters["call"] == "storeInterests") {
            $output = $this->storeInterests($parameters);
            return $output;
        }
        else {
            return "Wrong call!";
        }
    }
}