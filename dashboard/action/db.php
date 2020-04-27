<?php

// Database Object
class Database {
    // Connection parameters
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $databaseName = "finworld_consults";
    public $con = "";

    // Connection function
    public function __construct()
    {
        $this->con = new Mysqli($this->servername, $this->username, $this->password, $this->databaseName);
        if (!$this->con) {
            echo "Error Connecting To Database";
        }
    }

}
