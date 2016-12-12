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
    <title>Gallery</title>


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
      <a class="brand">Gallery</a>
      <a class="brand" href="socialmedia.php">Social Media</a>
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

<style>
img {padding: 50px;}
</style>

<div class="container">
  <h2>Breakfast</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/223854113_bf2050e366_b.jpg" target="_blank">
          <img src="assets/223854113_bf2050e366_b.jpg" alt="Omelette" style="width:50%">
          <div class="caption">
            <p>Omelette</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/Protein_Pancakes_mit_Beeren_und_Honig_(26364674872).jpg" target="_blank">
          <img src="assets/Protein_Pancakes_mit_Beeren_und_Honig_(26364674872).jpg" alt="Pancakes" style="width:50%">
          <div class="caption">
            <p>Blueberry and Lemon Pancakes</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/Scrambled-Eggs-And-Tuna-On-Toast-2007.jpg" target="_blank">
          <img src="assets/Scrambled-Eggs-And-Tuna-On-Toast-2007.jpg" alt="Topper" style="width:50%">
          <div class="caption">
            <p>Egg Toast Topper</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <h2>Lunch</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/jacket-potato-baked-potato.jpg" target="_blank">
          <img src="assets/jacket-potato-baked-potato.jpg" alt="Jacket Potato" style="width:50%">
          <div class="caption">
            <p>Jacket Potato</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/Resep-Membuat-Mie-Goreng-Telur.jpg" target="_blank">
          <img src="assets/Resep-Membuat-Mie-Goreng-Telur.jpg" alt="Stir Fry" style="width:50%">
          <div class="caption">
            <p>Chicken Stir Fry</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/Pasta_salad_closeup.JPG" target="_blank">
          <img src="assets/Pasta_salad_closeup.JPG" alt="Pasta" style="width:50%">
          <div class="caption">
            <p>Pesto Pasta</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <h2>Dinner</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/1.-قطعة-صغيرة-رفيعة-من-شرائح-البيتزا-الأيطالية.jpg" target="_blank">
          <img src="assets/1.-قطعة-صغيرة-رفيعة-من-شرائح-البيتزا-الأيطالية.jpg" alt="Pizza" style="width:50%">
          <div class="caption">
            <p>Pizza</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/5843391412_c94cdd403f_b.jpg" target="_blank">
          <img src="assets/5843391412_c94cdd403f_b.jpg" alt="Teriyaki" style="width:50%">
          <div class="caption">
            <p>Chicken Teriyaki</p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="assets/Udon_(4680697819).jpg" target="_blank">
          <img src="assets/Udon_(4680697819).jpg" alt="Yuki Udon" style="width:50%">
          <div class="caption">
            <p>Yuki Udon</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

</body>
</html>


