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
  <meta charset="utf-8" />
  <title>SARLyrics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./styles/output.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="./assets/favicon.ico">
  <script src="./js/index.js"></script>
  <script src="./js/last.fm.js"></script>
</head>

<body class="bg-green-50 flex flex-col min-h-screen flex-grow">

  <!-- Header -->
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
              <a class="font-Poppins" href="./views/lyrics.php">Lyrics</a>
            </li>
            <li class="ml-2 hover:bg-green-50 p-4 rounded-md">
              <a class="font-Poppins" href="./views/add.html">Add</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <!-- Content -->
  <div class="flex flex-grow flex-col w-6/12 mx-auto">
    <!-- CARD -->
    <?php
    require "./controllers/LyricController.php";

    $lyric = getLastLyrics()->fetch_assoc();

    echo "<div class='bg-white rounded-xl mb-4 shadow-md flex flex-row cursor-pointer transition transform hover:scale-105' onclick='{openLyrics(" . $lyric["id"] . ")}'>";
    echo "  <img class='rounded-l-xl' src='https://lastfm.freetls.fastly.net/i/u/300x300/b15cbf8c01c43188ffc7a72e800bed0e.png'></img>";
    echo "  <div class='pl-4 flex flex-col flex-grow justify-center text-center'>";
    echo "    <h1 class='font-Poppins text-green-500 font-bold text-2xl'>" . $lyric["author"] . "</h1>";
    echo "    <h1 class='font-Poppins text-green-500 font-bold text-2xl'>" . $lyric["title"] . "</h1>";
    echo "  </div>";
    echo "</div>";
    ?>
    <!-- BUTTONS -->
    <div class="grid grid-cols-2 gap-4">
      <input class="flex flex-row justify-center shadow-md rounded-md
        py-8 bg-green-500 text-white font-Poppins cursor-pointer 
        transition transform hover:scale-105 text-xl" value="View Lyrics" type="button" name="addBtn" onclick="{redirect('/views/lyrics.php')}"></input>

      <input class="shadow-md rounded-md flex flex-grow justify-center text-center 
      py-8 bg-green-500 text-white font-Poppins cursor-pointer 
      transition transform hover:scale-105 text-xl" value="Add Lyrics" type="button" onclick="{redirect('/views/add.html')}"></input>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="w-screen text-center p-4 bg-green-500">
      <h1 class="text-white font-Poppins">© Copyright 2021 Asier Nuñez</h1>
      <!-- <input class="p-2 bg-green-500 rounded-md text-white shadow-md m-4 hover:scale-110 transition transform cursor-pointer font-Poppins" type="button" value="Add Lyrics" onclick="getTrackCover('hundido','belo')"></input><br> -->
    </div>
  </footer>

</body>

</html>