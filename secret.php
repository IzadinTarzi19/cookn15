<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: index.php");
        die("Redirecting to index.php");
    }
?>
<!-- Author: Michael Milstead / Mode87.com
     for Untame.net
     Bootstrap Tutorial, 2013
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to Cook N'15</title>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png); }
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
      <a class="brand">Cook N'15</a>
      <a class="brand" href="gallery.php">Gallery</a>
      <a class="brand" href="socialmedia.php">Social Media</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h2>Hello and view our secret video below</h2>
    <p>&nbsp; </p>
    <p><img src="assets/Logo.png" alt="" class="center" /></p>
    <style>
    img {padding: 25px;}
    </style>
</div>

</body>
</html>
