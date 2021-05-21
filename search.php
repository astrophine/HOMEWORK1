<?php

session_start();

if(!isset($_SESSION["username"]))
{
    header("Location: login.php"); 
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"> 
    <title>Sanat</title>
    <script src="js/search.js" defer> </script>
    <script src="js/menuatendina.js" defer> </script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/search.css">
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
    <header id="banner_search">      
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
        What are you looking for?
      </h1>
    </header>
    
    <article> 
      <form id="form_imagine" name="nuovopost" method="post">
      <p class="big_title"> Get inspired by the great masters, search a work of art!</p>
      <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
      <input type="text" class="search">
      </form>
        <div id="opere" class="contents">
        
        </div>
        <form id="form_music">
          <p class="big_title"> Listen to music for ispiration!</p>
          <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
          <input type="text" class="search">
          </form>
          <div id="album" class="contents">
        
          </div>

          <form id="form_users">
          <p class="big_title">Artists who are part of our community</p>
          <input type="image" src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" class="search_img">
          <input type="text" class="search" name="username">
          </form>
          <div id="users" class="contents">
        
          </div>
     
    </article>

    <div id="modale" class="hidden">

    </div>
    </body>
</html>