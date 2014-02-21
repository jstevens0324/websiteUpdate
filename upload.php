<?php


function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}

$data = "ERROR - Nothing is defined";
if (isset($_REQUEST['domain']))
{
    $domains = new Domains($_REQUEST['domain']);
    //$file = './../includes/vhosts.conf';  //Use this if running locally
    $file = '/home/vetlogic/includes/vhosts.conf'; // Use this if running on live server
    //$file = '/Applications/conf/vhosts.conf'; // Use this if running on Mac
    $url = $_REQUEST['domain'];

    if (isset($_REQUEST['feature']))
    {
        $feature = $_REQUEST['feature'];
        //if ($feature == 1) $data = $domains->find($file, $url);
        if ($feature == 2) $data = $domains->update($url, $file);
        //if ($feature == 3) $domains->delete($url, $file);
    }
    else
    {
        $data = 'ERROR - You need to define a feature';
    }
}
else $data = "ERROR - You need to define a domain";


header('Content-Type: application/json');
echo json_encode($data);