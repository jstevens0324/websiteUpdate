<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/22/14
 * Time: 11:30 AM
 */
class Db extends PDO
{
    public function __construct()
    {
        parent::__construct("mysql:host=97.65.86.97;dbname=vetlogic_live", "warren", "mumbojumbo10");
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// always disable emulated prepared statement when using the MySQL driver
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
 /*   var $Host = "172.20.6.125"; // Hostname of our MySQL server.
    var $Database = "vetlogic_live"; // Logical database name on that server.
    var $User = "warren"; // User and Password for login.
    var $Password = "mumbojumbo10";

//-------------------------------------------
//    Connects to the database
//-------------------------------------------
    function connect()
    {
        try
        {
            $conn = new PDO('mysql:host=172.20.6.125;dbname=vetlogic_live', $this->User, $this->Password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo 'ERROR: ' . $e->getMessage();
        }
        return $conn;
    } // end function connect*/
}

