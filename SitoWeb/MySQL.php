<?php
require_once("./Safe.php");

class MySQL extends Safe
{
    public $connection;
    public $error           = array();

    protected $host, $user, $password, $database;

    public function __construct(){
        parent::__construct();
        try{
            $this->host         = "localhost";
            $this->user         = "web";
            $this->password     = "socialweb";
            $this->database     = "SocialBook";

            $this->MySQLConnect();

        }catch(Exception $e){
            echo "Your exception handling".$e;
        }
    }

    public function MySQLConnect(){
        $this->connection = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        if(! $this->connection){
            $e = 'Failed to connect to DB';
            echo "Your exception handling".$e;
            return false;
        }
        return $this->connection;
    }

    public function Query($query){
        return $this->Execute($query);
    }

}