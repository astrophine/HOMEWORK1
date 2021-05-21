<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $conn = mysqli_connect("localhost", "root", "", "progetto_2021") or die(mysqli_connect_error());
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $query = "SELECT username,password,numero_opere FROM utente WHERE username=\"$username\"";

    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($_POST["password"], $row["password"])) {
            if (isset($_POST["ricordami"])) {
                setcookie("username", $username, time() + 3600);
                setcookie("password", $password, time() + 3600);
            }
            $error = false;
            $_SESSION["username"] = $username;
            $_SESSION["isartista"] = $row["numero_opere"] != -1;
            mysqli_close($conn);
            header("Location: home.php");
            exit();
        } else {
            $error = true;
            mysqli_close($conn);
        }
    } else {
        $error = true;
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/login.js" defer> </script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <title>LOGIN</title>
</head>

<body>

    <h1>Welcome to the login page</h1>
    <div>
        <form name="login" method="POST">
            <p>
                <label>Username:<input type="text" name="username" value=<?php if (isset($_COOKIE["username"])) echo $_COOKIE["username"] ?>></label>
            </p>
            <p>
                <label>Password:<input type="password" name="password" value=<?php if (isset($_COOKIE["password"])) echo $_COOKIE["password"] ?>></label>
            </p>
            <p>
                <label>Remember me:<input type="checkbox" name="ricordami"></label>
            </p>
            <p>
                <label>&nbsp;<input type="submit"></label>
            </p>
        </form>
        <p class="tap">
            You don't have an account? <a href="signup.php">Click here!</a>
        </p>

        <?php
        if (isset($error)) {
            echo "Utente non valido";
        }
        ?>
    </div>

</body>

</html>