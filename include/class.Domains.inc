<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 2:53 PM
 */
class Domains
{

    /**
     * @var
     */
    protected $_domain;

    function __construct($domain)
    {
        $this->_domain = $domain;
    }


    function search($file)
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        $uid = "#" . strtoupper($this->_domain);
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
        else return false;
    }

    function isBlank()
    {
        if ($this->_domain == NULL) return false;
        else return true;
    }

    function isValidURL()
    {
        $allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = '/^(' . $allowed . '{1,63}\.)+' . // 1 or several sub domains with a max of 63 chars
            '[a-z]' . '{2,6}/'; // followed by a TLD
        if (preg_match($regex, $this->_domain) == true) return true;
        else return false;
    }
}