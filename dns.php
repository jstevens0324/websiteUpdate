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
        $url = strtolower($domain);
        if (isset($_REQUEST['hosted']))
        {
            $txt1 = "\"v=spf1 a mx include:_spf.elasticemail.com ~all\"";
            $txt2 = "\"k=rsa\\;t=s\\;p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBg
        QCbmGbQMzYeMvxwtNQoXN0waGYaciuKx8mtMh5czguT4EZlJXuCt6V+l56mmt3t68
        FEX5JJ0q4ijG71BGoFRkl87uJi7LrQt1ZZmZCvrEII0YO4mp8sDLXC8g1aUAoi8TJ
        gxq2MJqCaMyj5kAm3Fdy2tzftPCV/lbdiJqmBnWKjtwIDAQAB\\;\"";
            $webmail = $url;
            $target = $url;
            $hosted = $_REQUEST['hosted'];
            $dns = $_REQUEST['nms'];
            $feature = $_REQUEST['email'];
            if ($feature == 0)
            {
                $webmail = "petwisewebsites.mymailsrvr.com";
                $target = "mx1.emailsrvr.com";
            }
            if ($hosted == 0)
            {
                $nms = "<p>NS.RACKSPACE.COM<br>";
                $nms .= "NS2.RACKSPACE.COM<br></p>";
            }
            if ($hosted == 1 && $dns == 0)
            {
                $nms = "<p>NS.RACKSPACE.COM<br>";
                $nms .= "NS2.RACKSPACE.COM<br></p>";

                ?>
                <h2>Name Servers</h2>
                <?= $nms ?>
                <br><br>
                <h2>DNS</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Host</th>
                        <th>TTL</th>
                        <th>Type</th>
                        <th>Target</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $url ?></td>
                        <td>300</td>
                        <td>IN A</td>
                        <td>173.203.172.76</td>
                    </tr>
                    <tr>
                        <td><?= "www." . $url ?></td>
                        <td>300</td>
                        <td>IN CNAME</td>
                        <td><?= $url ?></td>
                    </tr>
                    <tr>
                        <td><?= "mail." . $url ?></td>
                        <td>300</td>
                        <td>IN CNAME</td>
                        <td><?= $url ?></td>
                    </tr>
                    <tr>
                        <td><?= "webmail." . $url ?></td>
                        <td>300</td>
                        <td>IN CNAME</td>
                        <td><?= $webmail ?></td>
                    </tr>
                    </tbody>
                </table><br><br>
                <h2>MX</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Host</th>
                        <th>TTL</th>
                        <th>Type</th>
                        <th>Target</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $url ?></td>
                        <td>300</td>
                        <td>IN MX</td>
                        <td><?= $target ?></td>
                    </tr>
                    </tbody>
                </table><br><br>
                <h2>TXT</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Host</th>
                        <th>TTL</th>
                        <th>Type</th>
                        <th>Text</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $url ?></td>
                        <td>300</td>
                        <td>IN MX</td>
                        <td><?= $txt1 ?></td>
                    </tr>
                    <tr>
                        <td><?= "api._domainkey." . $url ?></td>
                        <td>300</td>
                        <td>IN MX</td>
                        <td><?= $txt2 ?></td>
                    </tr>
                    </tbody>
                </table>
            <?
            }
            if ($hosted == 1 && $dns == 1)
            {
                $nms = "<p>Set A record to 173.203.172.76 at their domain provider<br></p>";
                ?>
                <h2>Name Servers</h2>
                <?= $nms ?>
                <br><br>
                <h2>MX</h2>
                <p>Make sure they use our mx record and have A CNAME record pointing to webmail.(url)</p>
            <?
            }

        }
    }
    ?>


    <!--meta http-equiv="refresh" content="5; url=start"-->

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html><?

}