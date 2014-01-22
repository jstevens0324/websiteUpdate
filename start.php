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
                <form role="form" action="post" method="post">
                    <div class="form-group">
                        <label>Domain:</label>
                        <input type="text" class="form-control" id="domain" name="domain">
                    </div>
                    <div class="form-group">
                        <label>Feature: </label>
                        <select class="form-control" name="feature">
                            <option value="search">Search</option>
                            <option value="update">Update</option>
                            <option value="delete">Delete</option>
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