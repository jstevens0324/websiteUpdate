<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 8:51 PM
 */
class Update
{


    /**$pd
     * @var PDO
     */
    protected $_db; // stores the database handler


    function __construct(PDO $db)
    {
        $this->_db = $db;
    }


    function update($url, $file)
    {
        if ($this->isValidURL($url))
        {
            if (!$this->search($file, $url))
            {
                $text = "\n\n#" . strtoupper($url) . "\n" .
                    "<VirtualHost *:80>\n" .
                    "\tServerName www.beth2.petwise.me\n" .
                    "\tServerAlias " . $url . " *." . $url . "\n" .
                    "\tDocumentRoot /home/vetlogic/www/api/public\n" .
                    "\tServerAdmin webmaster@petwisewebsites.com\n\n" .
                    "\tSetEnv APPLICATION_ENV production\n" .
                    "\tSetEnv VETLOGIC_LIBRARY_PATH /home/vetlogic/lib/vetlogic\n\n" .
                    "\t<IfModule mod_suphp.c>\n" .
                    "\t\tsuPHP_UserGroup vetlogic vetlogic\n" .
                    "\t</IfModule>\n" .
                    "\t<IfModule !mod_disable_suexec.c>\n" .
                    "\t\tSuexecUserGroup vetlogic vetlogic\n" .
                    "\t</IfModule>\n" .
                    "</VirtualHost>";

                $fh = fopen($file, 'a+') or die("Can't open file for writing.");
                fwrite($fh, $text);
                fclose($fh);
                return "<h2>Content Saved</h2>";
            }
            else return "<h2>This domain already exists</h2>";

        }
        else return "<h2>Not a valid Url</h2>";
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
                unset($line);
                $found = true;
            }
        }

        if ($found)
        {
            return true;
        }
        else return false;
    }

    function isBlank($domain)
    {
        if ($domain == NULL) return false;
        else return true;
    }

    function isValidURL($domain)
    {
        $allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = '/^(' . $allowed . '{1,63}\.)+' . // 1 or several sub domains with a max of 63 chars
            '[a-z]' . '{2,6}/'; // followed by a TLD
        if (preg_match($regex, $domain) == true) return true;
        else return false;
    }


}