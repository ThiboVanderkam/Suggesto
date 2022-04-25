<?php
class Database {
    private $hostname;
    private $user;
    private $password;
    private $database;
    private $port;
    public $connection;


    function __construct()
    {
        // add data to the props
        //gebeurt wanneer je die megeeft in andere file, ze worde ndan ook globaal aangepast in de klasse
        $this->hostname = "ID362561_suggesto.db.webhosting.be";
        $this->user = "ID362561_suggesto";
        $this->password = "InspirationLab2022"; 
        $this->database = "ID362561_suggesto";
        $this->port = 3306;

        // connection with database 
        $this->connectToDatabase();
    }

    
    function connectToDatabase() {
        // connection maken
        $conn = mysqli_connect($this->hostname, $this->user, $this->password, $this->database, $this->port);
        if ($conn == false) {
            echo "geen database connectie";
            die();
        }

        $this->connection = $conn;
    }

    
    
    function getQuery($query) {
        return mysqli_query($this->connection, $query)->fetch_all(MYSQLI_ASSOC);
    }

    function insertQuery($query) {
        mysqli_query($this->connection, $query);
    }

    //connection sluiten
    function closeConnection() {
        $this->connection->close();
    }
}

?>