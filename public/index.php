<?php

require_once(__DIR__ . '/start.php');

$GLOBALS['jdunk_index_loaded'] = true;

file_put_contents(__DIR__ . '/../index.php.log', $_SERVER['REMOTE_ADDR'] . ' [' . date('c') . '] ' . $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);

require_once 'class.user.php';
$user_login = new USER;

if (!isset($_SERVER['HTTPS'])) {
    $_SERVER['HTTP_HTTPS'] = 0;
}

if($user_login->is_logged_in())
{
    return redirect('home');
}

if(isset($_POST['txtupass']))
{
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);

    $loginResult = $user_login->login($email,$upass);
    
    if ($loginResult === true)
    {
        return redirect('/home');
    }

    return redirect('/?' . $loginResult);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login | Cue Count</title>
    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Muli:300,300italic' rel='stylesheet' type='text/css'>
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    <link href="assets/animation.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width">
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/styles.js"></script>
    <script src="assets/scripts.js"></script>
    <script src="assets/animation.js"></script>
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login" class="login_bk">
    <div class="">
        <?php
        if(isset($_GET['inactive']))
        {
            ?>
            <div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
            </div>
            <?php
        }
        ?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
        {
            ?>
            <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong>
            </div>
            <?php
        }
        ?>
        <h2 class="form-signin-heading">Sign In</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
        <button class="cc_button" type="submit" name="btn-login">Sign in</button>
        <a href="signup.php" style="float:right;" class="cc_button">Sign Up</a>
      <hr/>
        <a href="fpass.php" style="font-size:14px;">Lost your Password ? </a>
      </form>

    </div> <!-- /container -->
  </body>
</html>
