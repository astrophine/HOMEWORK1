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
    

if (isset($_POST["descrizione"]) && isset($_FILES["immagine"]) && isset($_POST["titolo"]) && $_POST["id_opere"]) {
    $id_opere=json_decode($_POST["id_opere"],true);
    
    if(count($id_opere)==0)
    {
        exit;
    }
    $uploaddir ="img/opere/";
    $uploadfile = $uploaddir . basename($_FILES["immagine"]["name"]);
    move_uploaded_file($_FILES["immagine"]["tmp_name"], $uploadfile);

    
    $conn = mysqli_connect("localhost", "root", "", "progetto_2021");
    $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);
    $titolo = mysqli_real_escape_string($conn, $_POST["titolo"]);
    $autore = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $immagine = mysqli_real_escape_string($conn, $uploadfile);
    

    $query = "INSERT INTO sala(nome,immagine,descrizione) VALUES(\" $titolo\",\" $immagine\",\" $descrizione\")";
    $res = mysqli_query($conn, $query);
    $sala = mysqli_insert_id($conn);

    foreach ($id_opere as $id)
    {
        $id=mysqli_real_escape_string($conn, $id);
        $query = "INSERT INTO creazione VALUES(\"$autore\", \"$sala\",\"$id\")";
        $res = mysqli_query($conn, $query);
    }
   

    mysqli_close($conn);
    echo json_encode($res);
}
?>