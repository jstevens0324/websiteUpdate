<?php

include './include/header.inc';?>
<div class="container">
    <br><br>

    <div class="page-header"><?

if (isset($_REQUEST['domain']))
{
    $domains = explode(PHP_EOL, $_REQUEST['domain']);
    foreach ($domains as $domain)
    {
        $dom = new Domains($domain);
        //$file = './../includes/vhosts.conf';  //Use this if running locally
        $file = '/home/vetlogic/includes/vhosts.conf'; // Use this if running on live server
        //$file = '/Applications/conf/vhosts.conf'; // Use this if running on Mac
        $url = $domain;

        if (isset($_REQUEST['feature']))
        {
            $feature = $_REQUEST['feature'];
            //if ($feature == 1) echo $dom->find($file, $url);
            if ($feature == 2) echo $dom->update($url, $file);
            //if ($feature == 3) $domains->delete($url, $file);
        }
        else
        {
            echo '<h1>You need to define a feature</h1>';
        }
    }
    ?>
    <meta http-equiv="refresh" content="5; url=start">

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html><?

}