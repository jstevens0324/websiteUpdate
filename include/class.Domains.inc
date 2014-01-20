<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 2:53 PM
 */

include 'class.Database.inc';

class Domains
{

    private $conn;

    function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    function search($file, $domain)
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        $uid = "#" . strtoupper($domain);
        $found = false;


        foreach ($lines as $line)
        {
            if (trim($line) == $uid)
            {
                $found = true;
            }
        }

        if ($found)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function validateFormat($domain)
    {
        if (filter_var($domain, FILTER_VALIDATE_URL) === FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}