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
                <div class="flex my-auto">
                    <input class="rounded-md p-2 focus:outline-none font-Poppins w-full ring-2 focus:ring-green-500 ring-gray-200 " type="search" placeholder="Search" id="search"></input>
                    <a class="my-0 flex justify-center" href="javascript:searchLyrics()">
                        <img class="pl-4 cursor-pointer" src="../assets/search.svg"></img>
                    </a>
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
    <div class="flex flex-grow justify-center">
        <?php
        require "../controllers/LyricController.php";

        $lyrics = getLyricsById($_GET["id"]);
        $lyric = $lyrics->fetch_assoc();
        if ($lyrics->num_rows == 0) {
            echo "<div class='my-auto justify-center'>";
            echo "<h1 class='text-green-500 font-Poppins font-bold text-5xl'>404 lyric not found.</h1>";
            echo "</div>";
        } else {
            echo "<div class='w-6/12 bg-white shadow-md rounded-xl my-auto p-8 text-center'>";
            echo "<img class='rounded-xl mx-auto my-8' src='" . $lyric["cover"] . "'></img>";
            echo "<h1 class='font-Poppins text-green-500 text-2xl my-1'>" . $lyric["title"] . "</h1>";
            echo "<h1 class='font-Poppins text-green-500 text-xl my-1'>" . $lyric["author"] . "</h1>";
            echo "<h1 class='font-Poppins text-green-500 text-xl my-1'>" . $lyric["album"] . "</h1>";
            echo "<p class='font-Poppins'>" . $lyric["lyrics"] . "</p>";
            echo "</div>";
        }

        ?>
    </div>
    <div class="py-4"></div>
    <footer>
        <div class="w-screen text-center p-4 bg-green-500">
            <h1 class="text-white font-Poppins">© Copyright 2021 Asier Nuñez</h1>
        </div>
    </footer>
</body>

</html>