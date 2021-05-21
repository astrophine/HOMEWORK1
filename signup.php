<?php
session_start();

if(isset($_SESSION["username"]))
{
    header("Location: home.php"); 
    exit;
}

if(isset($_POST["username"]) && isset($_POST["password"]) && isset ($_POST["nome"]) 
&& isset ($_POST["cognome"]) && isset ($_POST["email"]) && isset($_FILES["immagine"]))
{
    $uploaddir ="img/profile_pic/";
    $uploadfile = $uploaddir . basename($_FILES["immagine"]["name"]);
    move_uploaded_file($_FILES["immagine"]["tmp_name"], $uploadfile);
    
 $conn=mysqli_connect("localhost","root","","progetto_2021") or die ("Errore".mysqli_connect_error());
 $username=mysqli_real_escape_string($conn,$_POST["username"]);
 $nome=mysqli_real_escape_string($conn,$_POST["nome"]);
 $cognome=mysqli_real_escape_string($conn,$_POST["cognome"]);
 $email=mysqli_real_escape_string($conn,$_POST["email"]);
 $password=mysqli_real_escape_string($conn,$_POST["password"]);
 $password_hash= password_hash("$password", PASSWORD_DEFAULT);

 $artista_visitatore=mysqli_real_escape_string($conn,$_POST["artista_visitatore"]);
if($artista_visitatore!="-1" && $artista_visitatore!="0")
{
    mysqli_close($conn);
    exit;
}
 $immagine=mysqli_real_escape_string($conn,$uploadfile);
 $query="INSERT INTO utente values(\"$username\",\"$password_hash\",\"$nome\",\"$cognome\",\"$email\",\"$immagine\",\"$artista_visitatore\")";
 $res=mysqli_query($conn,$query);  
 if(!$res)
 {
     $errore= true;
     mysqli_close($conn);    
 }else
 {
     $errore= false;
     $_SESSION["username"]=$username;
     $_SESSION["isartista"] = $artista_visitatore!="-1";
     header("Location: home.php");
     mysqli_close($conn);
     exit;
 }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIGN UP</title>
        <script src= "js/signup.js" defer > </script>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/signup.css">

        
    </head>
    
    <body>
      
        <h1>Welcome, fill in the fields to register!</h1>
        <div>
            <form name="signup" method="post" enctype="multipart/form-data">
            <p>
                <label>Name:<input type="text" name="nome"></label>

            </p>
            <p>
                <label>Surname:<input type="text" name="cognome"></label>

            </p>
            <p>
                <label>Username:<input type="text" name="username"></label>

            </p>
            <p>
                <label>Email:<input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></label>

            </p>
            <p>
                <label>Password:<input type="password" name="password"></label>

            </p>
            <p>
                <label>Confirm Password:<input type="password" name="conferma"></label>

            </p>
            <p>
                <label>Profile Pic:<input type="file" name="immagine" accept="image/jpeg, image/png"></label>

            </p>
            <p>
                <label>Are you an artist or a visitor?</label>
                <input type="radio" name="artista_visitatore" value="-1" id="visitatore" checked >
                <label for="visitatore">visitor</label>
                <input type="radio" name="artista_visitatore" value="0" id="artista">
                <label for="artista">artist</label>
            </p>
            
            <p>
                <label>&nbsp;<input type="submit"></label>

            </p>
            </form>
            <p class="tap">
            Do you already have an account? <a href="login.php">Click here!</a>
            </p>
        </div>
    </body>
</html>


