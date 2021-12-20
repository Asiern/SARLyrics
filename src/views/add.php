<?php

/**
 * @author Asier Nuñez
 * @license MIT
 * @see https://github.com/Asiern/SARLyrics
 */

require "../controllers/LyricController.php";
require "../controllers/CoverController.php";


// Get form data from POST
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$album = trim($_POST['album']);
$lyrics = trim($_POST['lyrics']);
$cover = getTrackCover($title, $author);

// TODO validate form data

// Save form data to database
if ($cover != null) { // If cover found
    $result = SaveLyrics($title, $author, $album, $lyrics, $cover);
} else { // If cover not found
    $result = SaveLyrics($title, $author, $album, $lyrics, null);
}

if ($result) {
    // If added correctly => redirect user
    echo '<script type="text/javascript">
        window.location = "/views/lyrics.php"
        </script>';
} else {
    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "    <meta charset='UTF-8'>";
    echo "    <meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "    <title>Bad Request</title>";
    echo "    <link href='../styles/output.css' rel='stylesheet' />";
    echo "    <link rel='icon' type='image/x-icon' href='../assets/favicon.ico'>";
    echo "    <script src='../js/index.js'></script>";
    echo "</head>";
    echo "<body class='flex flex-grow h-screen justify-center text-center'>";
    echo "<div class='my-auto'>";
    echo "<h1 class='text-green-500 font-Poppins font-bold text-5xl'>400 Bad request.</h1>";
    echo "<h1 class='text-green-500 font-Poppins font-bold text-5xl'>" . $result . "</h1>";
    echo "<input class='mt-4 shadow-md rounded-md flex flex-grow justify-center text-center mx-auto p-4 bg-green-500 text-white font-Poppins cursor-pointer transition transform hover:scale-105 text-xl' value='Back Home' type='button' onclick='{redirect(`/`)}'>";
    echo "</input>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}
