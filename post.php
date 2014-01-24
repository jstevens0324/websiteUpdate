<?php

include './include/header.inc';?>
<div class="container">
    <br><br>

    <div class="page-header"><?

$database = new Db();
$pdo = $database->connect();
$update = new Update($pdo);
$search = new Search();
$delete = new Delete($pdo);
$feature = $_REQUEST['feature'];
if (isset($_REQUEST['domain']))
{
    $domains = new Domains($_REQUEST['domain']);
    //$file = '/home/vetlogic/includes/vhosts.conf';
    $file = 'e://wamp/includes/vhosts.conf';
    $url = $_REQUEST['domain'];

    if ($feature == 1) echo $search->search($file, $url);
    if ($feature == 2) echo $update->update($url, $file);
    if ($feature == 3) $delete->update($url, $file);
    ?>
    <!--meta http-equiv="refresh" content="4; url=start"-->

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html><?
}