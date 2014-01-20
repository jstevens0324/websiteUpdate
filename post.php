<?php


function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}

$domains = new Domains();


if (isset($_REQUEST['domain']))
{
    $file = '/home/vetlogic/includes/vhosts.conf';
    $url = $_REQUEST['domain'];
    if ($domains->isValidURL($url))
    {


        if (!$domains->search($file, $url))
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
            echo "<h2>Content Saved</h2>";
        }
        else
        {
            echo "<h2>This domain already exists</h2>";

        }
    }
    else
    {
        echo "<h2>Not a valid Url</h2>";
    }
    ?>
    <meta http-equiv="refresh" content="2; url=index"><?
}