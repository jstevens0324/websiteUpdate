<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 8:52 PM
 */
class Search
{

    function __construct()
    {
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
            return "<h2>" . $domain . " is in use.</h2>";
        }
        else return "<h2>" . $domain . " is NOT in use</h2>";
    }
}