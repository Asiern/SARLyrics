<?php

/**
 * @author Asier Nuñez
 * @license MIT
 * @see https://github.com/Asiern/SARLyrics
 */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyrics</title>
    <link href="../styles/output.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <script src="../js/index.js"></script>
</head>

<body class="bg-green-50 h-screen flex flex-col overflow-x-hidden">
    <header class="w-screen">
        <div class="bg-white px-6 py-2 w-6/12 rounded-xl shadow-md mx-auto my-6">
            <div class="flex flex-row justify-between">
                <img class="pr-4" src="../assets/logo.svg"></img>
                <div class="flex my-auto flex-grow">
                    <input class="rounded-md p-2 focus:outline-none font-Poppins w-full ring-2 focus:ring-green-500 ring-gray-200 " type="search" placeholder="Search"></input>
                </div>
                <div>
                    <ul class="flex flex-row">
                        <li class="mx-2 hover:bg-green-50 p-4 rounded-md">
                            <a class="font-Poppins" href="/">Home</a>
                        </li>
                        <li class="mx-2 hover:bg-green-50 p-4 rounded-md">
                            <a class="font-Poppins" href="./lyrics.php">Lyrics</a>
                        </li>
                        <li class="ml-2 hover:bg-green-50 p-4 rounded-md">
                            <a class="font-Poppins" href="./add.html">Add</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <?php
    require "../controllers/LyricController.php";

    if (isset($_GET["search"])) {
        $lyrics = GetLyricsFilter($_GET["search"]);
    } else {
        $lyrics = GetLyrics();
    }

    if (!$lyrics) {
        echo "<div class='mx-auto flex flex-grow'>";
        echo "<h1 class='font-Poppins font-bold text-xl'>Nothing found.</h1>";
        echo "</div>";
    } else if ($lyrics->num_rows > 0) {
        echo "<div class='mx-auto flex flex-grow'>";
        echo "<div>";
        echo "<div class='mx-20 grid grid-cols-3 md:grid-cols-6 '>";
        while ($row = $lyrics->fetch_assoc()) {
            echo "<div class='bg-white m-4 rounded-xl shadow-sm text-center cursor-pointer transition transform hover:scale-105' onclick='{openLyrics(" . $row["id"] . ")}'  >";
            echo "<img class='rounded-t-xl mb-2 aspect-square h-auto w-auto' src='https://lastfm.freetls.fastly.net/i/u/300x300/b15cbf8c01c43188ffc7a72e800bed0e.png'></img>";
            echo "<div class='p-2'>";
            echo "<h1 class='font-Poppins text-l text-green-500 font-bold'>" . $row["title"] . "</h1>";
            echo "<h1 class='font-Poppins text-l'>" . $row["author"] . "</h1>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    ?>
    <div class="py-4"></div>
    <footer>
        <div class="w-screen text-center p-4 bg-green-500">
            <h1 class="text-white font-Poppins">© Copyright 2021 Asier Nuñez</h1>
        </div>
    </footer>
</body>

</html>