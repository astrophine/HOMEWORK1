
<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION["isartista"] == true) {
    header("Location: home.php");
    exit;
    
  }
    

if (isset($_POST["stellaid"]) && isset($_POST["opera"])) {
    
    $conn = mysqli_connect("localhost", "root", "", "progetto_2021");
    $myusername = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $valutazione = mysqli_real_escape_string($conn, $_POST["stellaid"]);
    $opera = mysqli_real_escape_string($conn, $_POST["opera"]);
    $query = "INSERT INTO valutazione(utente,opera,valutazione) values(\"$myusername\",\"$opera\",\"$valutazione\") ON DUPLICATE KEY UPDATE valutazione = \"$valutazione\"";
    $res = mysqli_query($conn, $query);

    mysqli_close($conn);
    echo json_encode($res);
}
?>


