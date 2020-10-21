<?php

class DB_Creator
{
    private $Con;
    private $Pass;
    private $Server;
    private $Username;
    private $DBName;
    private $TableName;

    private function CreateCon()
    {
        try
        {
            $this->Con = new mysqli($this->Server, $this->Username, $this->Pass);

            $Query = "CREATE DATABASE IF NOT EXISTS $this->DBName;"; 
            $this->Con->query($Query);

            $this->Con->select_db($this->DBName);

            $Query = "CREATE TABLE IF NOT EXISTS $this->TableName (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                pname VARCHAR(50) NOT NULL,
                pprice FLOAT,
                pdescription VARCHAR(300) NOT NULL,
                pimage VARCHAR(100) NOT NULL
                );";

            $this->Con->query($Query);
        }   // try
        catch(Exception $E)
        {
            echo $E->getMessage();
        }   // Catch
    }   // CreateCon

    public function __construct($newPass, 
        $newServer, $newUsername, 
        $newDBName, $newTableName)
    {
        $this->Pass = $newPass;
        $this->Server = $newServer;
        $this->Username = $newUsername;
        $this->DBName = $newDBName;
        $this->TableName = $newTableName;

        $this->CreateCon();
    }   // Constructor

    public function __destruct()
    {
        unset($this->Pass);    
        unset($this->Server);
        unset($this->Username);
        unset($this->DBName);
        unset($this->TableName);
        $this->Con->close();
        unset($this->Con);
    }   // Destructor

    public function SetCon($newCon){ $this->Con = $newCon; }    // SetCon
    public function GetCon(){ return $this->Con; }  // GetCon

    public function SetPass($newPass){ $this->Pass = $newPass; }    // SetPass
    public function GetPass(){ return $this->Pass; }    // GetPass

    public function SetServer($newServer){ $this->Server= $newServer; } // SetServer
    public function GetServer(){ return $this->Server; }    // GetServer

    public function SetUsername($newUsername){ $this->Username = $newUsername; }    // SetUsername
    public function GetUsername(){ return $this->Username; }    // GetUsername

    public function SetDBName($newDBName){ $this->DBName = $newDBName; }    // SetDBName
    public function GetDBName(){ return $this->DBName; }    // GetDBName

    public function SetTableName($newTableName){ $this->TableName = $newTableName; }    // SetTableName
    public function GetTableName(){ return $this->TableName; }  // GetTableName

    public function GetData()
    {
        try
        {
            $Query = "SELECT * FROM $this->TableName;";
            $Result = $this->Con->query($Query);
        }
        catch(Exception $E)
        {
            echo $E->getMessage();
        }   // echo

        return $Result;
    }   // GetData()
}   // DB_Creator