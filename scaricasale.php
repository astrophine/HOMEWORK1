<?php
session_start();

if(!isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}
else if (!$_SESSION["isartista"])
{
    $conn=mysqli_connect("localhost","root","","progetto_2021");
    $myusername=mysqli_real_escape_string($conn,$_SESSION["username"]);

    if(!isset($_GET["q"]))
    {
    $query = "SELECT id, nome, immagine, descrizione, (abbonamento.sala IS NOT NULL) AS isabbonato FROM sala LEFT JOIN abbonamento ON sala.id = abbonamento.sala AND abbonato = \"$myusername\" AND data_fine IS NULL";
    }else
    {
        $nomesala=mysqli_real_escape_string($conn,$_GET["q"]);
        $query = "SELECT id, nome, immagine, descrizione, (abbonamento.sala IS NOT NULL) AS isabbonato FROM sala LEFT JOIN abbonamento ON sala.id = abbonamento.sala AND abbonato = \"$myusername\" AND data_fine IS NULL WHERE sala.nome LIKE \"%".$nomesala."%\" ";
    }

    $res=mysqli_query($conn,$query);
    
    $sala=array();
    while($row=mysqli_fetch_assoc($res)){
        $sala[]=array('id' => $row['id'], 'nome'=> $row['nome'], 'immagine'=> $row['immagine'], 'descrizione'=> $row['descrizione'], 'isabbonato'=>$row['isabbonato']);
    }
    
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($sala);

    
}
