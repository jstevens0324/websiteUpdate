<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 8:51 PM
 */
class Delete
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
            $file2 = 'e://wamp/includes/vhosts2.conf';
            $uid = strtoupper($url);
            //$lines = file($file, FILE_IGNORE_NEW_LINES);
            $contents = file_get_contents($file);
            $about = explode('#', $contents);
            if (in_array($uid, $about))
            {
                echo 'this may have worked';
            }
            //$uid = "#" . strtoupper($url);
            //$handle = fopen($file, "w+") or die("Can't open file for writing.");
            //$text = str_replace($uid, "", $contents);
            //$size = filesize($file);
            //$contents = fread($handle,filesize($file));
            //fclose($handle);
            // $fp = fopen($file, "r+") or die("Can't open file for writing.");
            // $file = str_replace($uid, "", $file);
            //fwrite($handle, $text);
            //fclose($handle);

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
                array_splice($about,$key,1);
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