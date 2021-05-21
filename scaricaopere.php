<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
} else {
    $conn = mysqli_connect("localhost", "root", "", "progetto_2021");
    $myusername = mysqli_real_escape_string($conn, $_SESSION["username"]);
    if ($_SESSION["isartista"] ?? false) {
        $query = "SELECT id, titolo, immagine, descrizione FROM opera WHERE autore = \"$myusername\"";
        $res = mysqli_query($conn, $query);

        $opere = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $opere[] = array('id' => $row['id'], 'titolo' => $row['titolo'], 'immagine' => $row['immagine'], 'descrizione' => $row['descrizione']);
        }

        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($opere);
        exit;

    } else if (!isset($_GET['sala'])) {
        $query = "SELECT opera.id AS id, titolo, immagine, descrizione, valutazione FROM abbonamento ";
        $query .= "JOIN creazione ON abbonamento.abbonato = \"$myusername\" AND abbonamento.sala = creazione.sala ";
        $query .= "JOIN opera ON creazione.opera = opera.id ";
        $query .= "LEFT JOIN valutazione ON opera.id = valutazione.opera AND valutazione.utente = \"$myusername\"";
    } else {
        $sala = mysqli_real_escape_string($conn, $_GET["sala"]);
        $query = "SELECT id, titolo, immagine, descrizione, valutazione FROM creazione JOIN opera ON creazione.opera = opera.id AND creazione.sala = \"$sala\"";
        $query .= "LEFT JOIN valutazione ON opera.id = valutazione.opera AND valutazione.utente = \"$myusername\"";
    }
    $res = mysqli_query($conn, $query);

    $opere = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $opere[] = array('id' => $row['id'], 'titolo' => $row['titolo'], 'immagine' => $row['immagine'], 'descrizione' => $row['descrizione'], "valutazione" => $row['valutazione']);
    }

    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($opere);
}
