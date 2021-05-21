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
    

if (isset($_POST["descrizione"]) && isset($_FILES["immagine"]) && isset($_POST["titolo"]) && isset($_POST["categoria"])) {
    $uploaddir ="img/opere/";
    $uploadfile = $uploaddir . basename($_FILES["immagine"]["name"]);
    move_uploaded_file($_FILES["immagine"]["tmp_name"], $uploadfile);

    $conn = mysqli_connect("localhost", "root", "", "progetto_2021");
    $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);
    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
    $autore = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $immagine = mysqli_real_escape_string($conn, $uploadfile);
    $categoria = mysqli_real_escape_string($conn, $_POST["categoria"]);
    $query = "INSERT INTO opera(titolo,immagine,autore,descrizione,categoria) values(\"$titolo\",\"$immagine\",\"$autore\",\"$descrizione\",\"$categoria\")";
    $res = mysqli_query($conn, $query);

    mysqli_close($conn);
    echo json_encode($res);
}
?>