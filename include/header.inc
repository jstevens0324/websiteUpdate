<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/21/14
 * Time: 10:40 AM
 */
function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}

session_start();
session_regenerate_id();

$authService = new Auth();
$authService->authInfo($_SESSION['user']);
$user = $authService->getUser();
$name = $user['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Domain CRUD</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Domain CRUD</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="start">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><? echo $name ?></a></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>