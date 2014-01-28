<?php


function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}

if (isset($_REQUEST['domain']))
{
    $domains = new Domains($_REQUEST['domain'], new Db());
    //$file = './../includes/vhosts.conf';  //Use this if running locally
    $file = '/home/vetlogic/includes/vhosts.conf'; // Use this if running on live server
    //$file = '/Applications/conf/vhosts.conf'; // Use this if running on Mac
    $url = $_REQUEST['domain'];

    if (isset($_REQUEST['feature']))
    {
        $feature = $_REQUEST['feature'];
        if ($feature == 1) echo $domains->find($file, $url);
        if ($feature == 2) echo $domains->update($url, $file);
        if ($feature == 3) $domains->delete($url, $file);
    }
    else
    {
        $data = 'ERROR - You need to define a feature';
    }
}
else $data = "ERROR - You need to define a domain";


header('Content-Type: application/json');
echo json_encode($data);
/*$domains = new Domains($_REQUEST['domain'], new Db());
$data = "";

if (isset($_REQUEST['domain']))
{
$file = '/home/vetlogic/includes/vhosts.conf';
$url = $_REQUEST['domain'];
if ($domains->isBlank($url))
{
if ($domains->isValidURL($url))
{
if (!$domains->search($file, $url))
{
$text = "\n\n#" . strtoupper($url) . "\n" .
"
<VirtualHost *:80>\n" .
"\tServerName www.beth2.petwise.me\n" .
"\tServerAlias " . $url . " *." . $url . "\n" .
"\tDocumentRoot /home/vetlogic/www/api/public\n" .
"\tServerAdmin webmaster@petwisewebsites.com\n\n" .
"\tSetEnv APPLICATION_ENV production\n" .
"\tSetEnv VETLOGIC_LIBRARY_PATH /home/vetlogic/lib/vetlogic\n\n" .
"\t
<IfModule mod_suphp.c>\n" .
    "\t\tsuPHP_UserGroup vetlogic vetlogic\n" .
    "\t
</IfModule>\n" .
"\t
<IfModule !mod_disable_suexec.c>\n" .
"\t\tSuexecUserGroup vetlogic vetlogic\n" .
"\t</IfModule>\n" .
"</VirtualHost>";

$fh = fopen($file, 'a+') or die("Can't open file for writing.");
fwrite($fh, $text);
fclose($fh);
$data = "Content Saved";
}
else $data = "domain already exists";
}
else $data = "Invalid Url";
}
else $data = "Url variable can not be blank - a valid URL must be entered";
}
else $data = "Url variable can not be blank - a valid URL must be entered";

header('Content-Type: application/json');
//$message = array('message' => $data);
echo json_encode($data);
*/
//$baseLink = 'http://vetconnect.me/upload';
//$params = sprintf('domain=%s&origin=%s&securityKey=%s', $domain, 'avimark', "KlockWork");
//$output = sprintf('%s?r=%s', $baseLink, base64_encode(urlencode($params)));