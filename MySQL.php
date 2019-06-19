<?php
require_once(dirname(__FILE__)."/Safe.php");

class MySQL extends Safe
{
    public $connection;
    public $error = array();

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

    protected function CheckConnection(){
        if(! $this->connection){
            $e              = 'DB connection failed';
            echo "Your exception handling".$e;
            return false;
        }
        return true;
    }


    public function Query($query){
        $execute  = mysqli_query($this->connection,$query);
        return $execute;
    }

    public function Execute($query){
        if($this->CheckConnection() === false){
            return false;
        }
        $return             = array();
        $execute = $this->Query($query);
        if($execute === false){
            $e = 'MySQL query error '.mysqli_error($this->connection);
            echo "Your exception handling".$e;
            return false;
        }
        if(!is_bool($execute)){
            while($row = mysqli_fetch_array($execute)){
                $return[]   = $row;
            }
        }
        return $return;
    }

}