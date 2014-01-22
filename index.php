<?php



function __autoload($class_name)
{
    include './include/class.' . $class_name . '.inc';
}



if (isset($_POST['login']))
{
    $authService = new Auth();
    if ($authService->validateLogin($_POST['username'], $_POST['password']))
    {

        header("Location: http://" . $_SERVER['HTTP_HOST'] . "/start");
        ob_end_flush();
    }
    else
    {
        echo 'Email or Password is Incorrect!';
        echo "<meta http-equiv=\"refresh\" content=\"2;url=index\">";
    }
}
else
{

    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

    <div class="container">

        <form class="form-signin" role="form" action="index" method="POST">
            <h2 class="form-signin-heading">Please sign in</h2>
            <input type="text" class="form-control" placeholder="Email address" name="username" required autofocus>
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
        </form>

    </div>
    <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    </body>
    </html>
<? } ?>

