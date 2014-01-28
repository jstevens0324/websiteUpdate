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
     * @var PDO
     */
    private $conn;


    /**
     * @var
     */
    protected $_domain;

    /**
     * @param $domain
     * @param PDO $conn
     */
    function __construct($domain, PDO $conn)
    {
        $this->_domain = $domain;
        $this->conn = $conn;
    }


    /**
     * @param $file
     * @return bool
     */
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

    /**
     * @return bool
     */
    function isBlank()
    {
        if ($this->_domain == NULL) return false;
        else return true;
    }

    /**
     * @return bool
     */
    function isValidURL()
    {
        $allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';

        $regex = '/^(' . $allowed . '{1,63}\.)+' . // 1 or several sub domains with a max of 63 chars
            '[a-z]' . '{2,6}/'; // followed by a TLD
        if (preg_match($regex, $this->_domain) == true) return true;
        else return false;
    }


    /**
     * @param $file
     * @param $domain
     * @return string
     */
    function find($file, $domain)
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
            return $domain . " is in use";
        }
        else return $domain . " is NOT in use";
    }


    /**
     * @param $url
     * @param $file
     * @return string
     */
    function update($url, $file)
    {
        if ($this->isValidURL($url))
        {
            if (!$this->search($file, $url))
            {
                $text = "\n\n#" . strtoupper($url) . "\n" .
                    "<VirtualHost *:80>\n" .
                    "\tServerName www.joshstevens.petconnect.me\n" .
                    "\tServerAlias " . $url . " *." . $url . "\n" .
                    "\tDocumentRoot /home/vetlogic/www/petwise/public\n" .
                    "\tServerAdmin webmaster@petwisewebsites.com\n\n" .
                    "\tSetEnv APPLICATION_ENV production\n" .
                    "\tSetEnv VETLOGIC_LIBRARY_PATH /home/vetlogic/lib/vetlogic\n" .
                    "</VirtualHost>";

                $fh = fopen($file, 'a+') or die("Can't open file for writing.");
                fwrite($fh, $text);
                fclose($fh);
                return "Content Saved";
            }
            else return "This domain already exists";

        }
        else return "Not a valid Url";
    }


    /**
     * @param $url
     * @param $file
     */
    function delete($url, $file)
    {
        if ($this->isValidURL($url))
        {
            //$file2 = 'e://wamp/includes/vhosts2.conf';
            $uid = strtoupper($url);
            //$lines = file($file, FILE_IGNORE_NEW_LINES);
            $contents = file_get_contents($file);
            $about = explode('#', $contents);
            if (in_array($uid, $about))
            {
                echo 'this may have worked';
            }

            $strings = array('Apple', 'Banana', 'Orange');
            $substrings = array($uid);

            $results = array_filter($about, function ($item) use ($substrings)
            {
                foreach ($substrings as $substring)
                    if (strpos($item, $substring) !== FALSE) return TRUE;
                return FALSE;
            });
            foreach ($results as $key => $values)
            {
                array_splice($about, $key, 1);
            }
            //print_r($results);

            /*print_r(array_splice($about,2,1));
            echo "<br><br><br><br>";*/
            $again = implode('#', $about);
            //print_r($again);
            $handle = fopen($file, "w+") or die("Can't open file for writing.");
            fwrite($handle, $again);
            fclose($handle);
            /*fopen($file, 'w+') or die("Can't open file for writing.");

            foreach ($lines as $line)
            {
                if (!trim($line) == $uid)
                {
                    fwrite($line, htmlspecialchars($line));
                }
            }

            fclose($file);*/
        }
    }
}