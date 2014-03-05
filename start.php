<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/20/14
 * Time: 1:53 PM
 */

include './include/header.inc';
?>


    <div class="container">
        <br><br>
        <div class="page-header">
            <h1>Enter Domain Details</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form role="form" action="dns" method="post">
                    <div class="form-group">
                        <label>Domain:</label>
                        <input type="text" class="form-control" id="domain" name="domain"/>
                    </div>
                    <div class="form-group">
                        <label>Name Servers: </label>
                        <select class="form-control" name="nms">
                            <option value="0">rackspace</option>
                            <option value="1">other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hosted: </label>
                        <select class="form-control" name="hosted">
                            <option value="0">With us</option>
                            <option value="1">other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email: </label>
                        <select class="form-control" name="email">
                            <option value="0">With us</option>
                            <option value="1">other</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
<?