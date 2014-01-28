<?php

include './include/header.inc';?>
<div class="container">
    <br><br>

    <div class="page-header"><?


$feature = $_REQUEST['feature'];
if (isset($_REQUEST['domain']))
{
    $domains = new Domains($_REQUEST['domain'], new Db());
    //$file = './../includes/vhosts.conf';  //Use this if running locally
    $file = '/home/vetlogic/includes/vhosts.conf'; // Use this if running on live server
    //$file = '/Applications/conf/vhosts.conf'; // Use this if running on Mac
    $url = $_REQUEST['domain'];

    if ($feature == 1) echo $domains->find($file, $url);
    if ($feature == 2) echo $domains->update($url, $file);
    if ($feature == 3) $domains->delete($url, $file);
    ?>
    <meta http-equiv="refresh" content="4; url=start">

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html><?
}