<?php
    require("config.php");
    $submitted_username = '';
    if(!empty($_POST)){
        $query = "
            SELECT
                id,
                username,
                password,
                salt,
                email
            FROM users
            WHERE
                username = :username
        ";
        $query_params = array(
            ':username' => $_POST['username']
        );

        try{
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
        $login_ok = false;
        $row = $stmt->fetch();
        if($row){
            $check_password = hash('sha256', $_POST['password'] . $row['salt']);
            for($round = 0; $round < 65536; $round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            if($check_password === $row['password']){
                $login_ok = true;
            }
        }

        if($login_ok){
            unset($row['salt']);
            unset($row['password']);
            $_SESSION['user'] = $row;
            header("Location: secret.php");
            die("Redirecting to: secret.php");
        }
        else{
            print("Login Failed.");
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Social Media</title>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background-color: #FFFFFF; }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
</head>

<body>

<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.php">Cook N'15</a>
      <a class="brand" href="gallery.php">Gallery</a>
      <a class="brand">Social Media</a>
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <form action="index.php" method="post">
                    Username:<br />
                    <input type="text" name="username" value="<?php echo $submitted_username; ?>" />
                    <br /><br />
                    Password:<br />
                    <input type="password" name="password" value="" />
                    <br /><br />
                    <input type="submit" class="btn btn-info" value="Login" />
                </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<p>&nbsp;</p>

<img src="assets/Logo.png" alt="" width="350" height="350" class="center" />

<h1>Here are the links to our Social Media pages</h1>

<a href="https://www.facebook.com/CookN15"><img src="assets/Converted_file_e5a9a86e.png" height="250" width="250" class="center"/></a>

<a href="https://www.twitter.com/Cook_N_15"><img src="assets/Converted_file_0ca1a049.png" height="250" width="250" class="center"/></a>

<style>
img {padding: 50px;}
h1 {text-align: center;}
</style>