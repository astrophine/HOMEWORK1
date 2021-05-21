<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sanat</title>
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i|Open+Sans:400,700" rel="stylesheet">
  <?php if (isset($_SESSION["username"]) && !($_SESSION["isartista"] ?? false)) : ?>
    <script src="js/home.js" defer> </script>
  <?php endif; ?>
  <script src="js/menuatendina.js" defer> </script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300&display=swap" rel="stylesheet">
</head>

<?php if (isset($_GET["sala"])) : ?>
          <body data-sala="<?php echo $_GET['sala'] ?>">
        <?php else : ?>
          <body>
        <?php endif; ?>
  <header>
    <nav>
      <div id="logo">
        SANAT-Art in one click!
      </div>
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
      <em>Recent events have made us lose the pleasure of immersing ourselves in art.</em><br />
      Now you can do it from home in complete safety.<br />
      <?php if (!isset($_SESSION["username"])) : ?>
        <a href="./login.php">Let's get started</a>
      <?php endif; ?>

    </h1>
  </header>

  <?php if (!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && ($_SESSION["isartista"] ?? false))) : ?>
    <section>
      <div id="main">
        <h1>WELCOME TO SANAT!</h1>
        <p>
          Here is the first online art gallery where artists can show their works without the limit of today's restrictions due to Covid-19.
        </p>
      </div>

      <div id="details">
        <div id="flex-container-sculpture">
          <img src="img/immagine.jpg" />

          <h1>Sculpture:</h1><br />
          <p>is the branch of the visual arts that operates in three dimensions. It is one of the plastic arts.<br />
            Durable sculptural processes originally used carving (the removal of material) <br />
            and modelling (the addition of material, as clay), in stone, metal, ceramics, wood and other materials. <br />
          </p>

        </div>
        <div id="flex-container-painting">
          <img src="img/immagine3.jpg" />

          <h1>Painting:</h1>
          <p>is the practice of applying paint, pigment, color or other medium to a solid.</p>

        </div>
        <div id="flex-container-architecture">
          <img src="img/immagine5.jpg" />

          <h1>Architecture:</h1>
          <p>(Latin architectura, from the Greek ἀρχιτέκτων arkhitekton "architect", from ἀρχι- "chief" and τέκτων "creator")<br />
            is both the process and the product of planning, designing, and constructing buildings or other structures.<br />
            Architectural works, in the material form of buildings, are often perceived as cultural symbols and as works of art.</br></p>

        </div>
      </div>
    </section>
  <?php else : ?>
    <section>
    
      <div id="container">
      
      </div>
    </section>
  <?php endif; ?>

  <footer>
    <address>From my tiny room</address>
    <p>Powered by Josephine Migliore O46001207</p>
  </footer>
</body>

</html>