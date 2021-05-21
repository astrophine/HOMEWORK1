<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}

if (isset($_POST["ricerca"])) {
    $curl = curl_init();
    $data = http_build_query(
        array("q" => $_POST["ricerca"])
    );
    curl_setopt($curl, CURLOPT_URL, "https://collectionapi.metmuseum.org/public/collection/v1/search?" . $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $album_json = curl_exec($curl);
    curl_close($curl);

    // Converto json in array
    $album = json_decode($album_json, true);
    //var_dump($album);

    $num_results = $album["total"];
    if ($num_results > 5) $num_results = 5;

    $chosen_albums_idx = array_rand($album["objectIDs"], $num_results); //indici random per dare sempre risultati diversi 

    $result = array();
    foreach ($chosen_albums_idx as $idx) {
        $id_opera = $album["objectIDs"][$idx];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://collectionapi.metmuseum.org/public/collection/v1/objects/".$id_opera);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $opera_json = curl_exec($curl);
        curl_close($curl);

        $opera = json_decode($opera_json, true);
        
        $opera_elaborata = array(
            "titolo" => $opera["title"],
            "immagine" => $opera["primaryImageSmall"],
            "autore" => $opera["artistDisplayName"]
        );
        array_push($result, $opera_elaborata);
    }
    echo json_encode($result);
}
