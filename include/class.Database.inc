<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 2:51 PM
 */


//$host = "mcallister.servers.deltasys.com";
//$host = '172.20.6.125';
//$username = "vetlogic_live";
$username = "warren";
//$password = "?yW13F{*=?";
$password = "mumbojumbo10";
//$db_name = "vetlogic_live";

try
{
    $conn = new PDO('mysql:host=97.65.86.97;dbname=vetlogic_live', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo 'ERROR: ' . $e->getMessage();
}