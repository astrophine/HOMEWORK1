<?php

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}
if (!isset($_SESSION["isartista"])) {
  header("Location: home.php");
  exit;
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sanat</title>
  <script src="js/create.js" defer> </script>
  <script src="js/menuatendina.js" defer> </script>
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/create.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300&display=swap" rel="stylesheet">

  <script type="text/javascript">
      <?php 
          $conn=mysqli_connect("localhost","root","","progetto_2021");   
          $query="SELECT nome FROM categoria ";
          $res=mysqli_query($conn,$query);
          $js = "const CATEGORIE = [";
          while($row=mysqli_fetch_assoc($res))
            $js .= "'".$row["nome"]."',";
         $js .= "];";
         echo $js;
      ?>
    </script>

</head>

<body>
  <header id="create"> 
    <nav>
      <div id="links">
        <a href="./home.php">Home</a>
        <a href="./gallery.php">Gallery</a>
        <?php if ($_SESSION["isartista"] ?? false) : ?>
          <a href="./create.php">Post</a>
        <?php endif; ?>

        <a href="./search.php">Search</a>
        <?php if (!isset($_SESSION["username"])) : ?>
          <a href="./login.php">Login</a>
        <?php else : ?>
          <a href="./logout.php">Logout</a>
        <?php endif; ?>
      </div>

      <img id="menu_tendina"src="img/menu.png" />

    </nav>

    <h1>
          Do you want to share with us your work of art?
    </h1>
        
  </header>
  <div id="inserimento_opera">
    <button id=add_work>Click here!</button>

    <div id="modale" class="hidden">

    </div>
  </div>
  <h1>These are your works:</h1>
  <div id="opere_utente" class="contents">
        
  </div>
</body>
</html>