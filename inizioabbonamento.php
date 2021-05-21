
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
    

if (isset($_POST["postid"])) {
    $conn = mysqli_connect("localhost", "root", "", "progetto_2021");
    $sala = mysqli_real_escape_string($conn, $_POST["postid"]);
    $myusername=mysqli_real_escape_string($conn,$_SESSION["username"]);
    $query = "INSERT INTO abbonamento(sala,data_inizio,data_fine,abbonato) values(\"$sala\",CURRENT_TIMESTAMP(), NULL ,\"$myusername\")";
    $res = mysqli_query($conn, $query);

    mysqli_close($conn);
    echo json_encode($res);
}
?>