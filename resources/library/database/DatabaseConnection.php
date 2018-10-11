<?php
/**
 * Created by PhpStorm.
 * User: Hunter
 * Date: 5/10/2018
 * Time: 7:46 PM
 */

class DatabaseConnection
{
    var $servername = "localhost";
    var $databaseName = "id3548748_tamucscheduletooldb";
    var $username = "id3548748_hunter";
    var $password = "TamucSchedule2018440";

    function getConnection()
    {

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->databaseName);

        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

}