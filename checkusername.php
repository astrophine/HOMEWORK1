<?php
session_start();

if(isset($_GET["username"]))
{
    $conn=mysqli_connect("localhost","root","","progetto_2021") or die ("Errore".mysqli_connect_error());

    $username=mysqli_real_escape_string($conn, $_GET["username"]);

    $query="SELECT username FROM utente WHERE username=\"$username\"";

    $res=mysqli_query($conn,$query);

    mysqli_close($conn);

    echo json_encode(mysqli_num_rows($res));
}
?>