<?php


function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}

$domains = new Domains();
//$devFile = '../../includes/vhosts.conf';

$data = "";

if (isset($_REQUEST['domain']))
{
    //$file = $devFile;
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
            $data = "Content Saved";
        }
        else
        {
            $data = "domain already exists";

        }
    }
    else
    {
        $data = "Invalid Url";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}