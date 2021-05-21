<?php
session_start();

if(!isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}
if(isset($_POST["username"]))
{
    $conn=mysqli_connect("localhost","root","","progetto_2021");
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $myusername=mysqli_real_escape_string($conn,$_SESSION["username"]);
    $query="SELECT username,immagine FROM utente where username like \"$username\" and username!=\"$myusername\" and numero_opere!=-1 "; //in questo caso cerca gli utenti escluso il tuo profilo
    $res=mysqli_query($conn,$query);
    
    
    while($row=mysqli_fetch_assoc($res)){
        $users[]=array('artista'=> $row['username'], 'immagine'=> $row['immagine']);
    }

    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($users);
} 
  
?>



