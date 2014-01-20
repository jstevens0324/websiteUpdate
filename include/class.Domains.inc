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

    function isValidURL($domain)
    {
        if ($domain == NULL) return false;

        $allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = '/^(' . $allowed . '{1,63}\.)+' . // 1 or several sub domains with a max of 63 chars
            '[a-z]' . '{2,6}/'; // followed by a TLD
        if (preg_match($regex, $domain) == true) return true;
        else return false;
    }
}