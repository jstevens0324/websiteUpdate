<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 1:53 PM
 */

if (isset($_POST['domain']))
{
    $file = '../../includes/vhosts.conf';
    $url = $_REQUEST['domain'];
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
    echo "Content saved.";
}
else
{
    ?>
    <h1>Please enter the domain name</h1>
    <form action="index.php" method="post">
        Domain: <input type="text" name="domain"> <br/>
        <input type="submit" value="Submit"/>
    </form>
<?
}