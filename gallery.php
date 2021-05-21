<?php

session_start();

if (!isset($_SESSION["username"])) {
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

  <?php if ($_SESSION["isartista"] ?? false) : ?>
       <script src="js/galleryartist.js" defer> </script>

    <?php else : ?>
        <script src="js/gallery.js" defer> </script>
 
    <?php endif; ?>
 
  <script src="js/menuatendina.js" defer> </script>
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/gallery.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300&display=swap" rel="stylesheet">
</head>

<body>
  <header id="gallery">
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
      EXHIBITIONS AND DISPLAYS
    </h1>
  </header>
  <article>
   
    <?php if ($_SESSION["isartista"] ?? false) : ?>
      <p>Do you want to create a new gallery?</p>
      <div id="contenuti" class="contents"></div>

    <?php else : ?> 
    
    <img src="https://www.materialui.co/materialIcons/action/search_white_192x192.png" id="search_img" class="search_img">
    <input type="text" id="search" class="search">

      <p class="big_title">THESE ARE OUR FREE EXHIBITIONS AND DISPLAYS:</p>
      <div id="sale" class="contents">
      </div>
    <?php endif; ?>
  

  </article>
</body>
</php>