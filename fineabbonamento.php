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
    $id = mysqli_real_escape_string($conn, $_POST["postid"]);
    $myusername=mysqli_real_escape_string($conn,$_SESSION["username"]);

    $query = "UPDATE abbonamento SET data_fine = CURRENT_TIMESTAMP()  WHERE sala =\"$id\" and abbonato=\"$myusername\" and data_fine is null";
    $res = mysqli_query($conn, $query);

    mysqli_close($conn);
    echo json_encode($res);
}
?>