<?php

/**
 * @author Asier Nuñez
 * @license MIT
 * @see https://github.com/Asiern/SARLyrics
 */

require_once "EnvController.php";

/**
 * Savelyrics to database
 * 
 * @param string $tile track title
 * @param string $author author name
 * @param string $album album name
 * @param string $lyrics track lyrics
 * 
 * @return boolean $success true <=> query successful 
 */
function SaveLyrics($title, $author, $album, $lyrics)
{
    // Load credentias to env
    require_once __DIR__ . '/EnvController.php';
    $env = new EnvController(__DIR__ . '/../.env');
    $env->load();

    // Get database credentials from evironment variables
    $servername = getenv("DB_HOST", TRUE);
    $database = getenv("DB_DATABASE", TRUE);
    $username =  getenv("DB_USERNAME", TRUE);
    $password = getenv("DB_PASSWORD", TRUE);

    // Get Cover
    $cover = null;

    // Connect to database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create query
    if ($cover === null) {
        $sql = "INSERT INTO lyrics (title, author, album, lyrics) VALUES ('" . $title . "','" . $author . "','" . $album . "','" . nl2br($lyrics, false) . "')";
    } else {
        $sql = "INSERT INTO lyrics (title, author, album, lyrics, cover) VALUES ('" . $title . "','" . $author . "','" . $album . "','" . nl2br($lyrics, false) . "','" . $cover . "')";
    }

    // Get response form query
    $success = false;
    $success = $connection->query($sql);

    // Close connection to db
    $connection->close();
    return $success;
}

/**
 * Get all lyrics from database
 * 
 * @return Lyrics $result query response
 */
function GetLyrics()
{
    // Load credentias to env
    require_once __DIR__ . '/EnvController.php';
    $env = new EnvController(__DIR__ . '/../.env');
    $env->load();

    // Get database credentials from evironment variables
    $servername = getenv("DB_HOST", TRUE);
    $database = getenv("DB_DATABASE", TRUE);
    $username =  getenv("DB_USERNAME", TRUE);
    $password = getenv("DB_PASSWORD", TRUE);

    // Connect to database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create query
    $sql = "SELECT id,title, author, album, lyrics FROM lyrics";
    $result = $connection->query($sql);

    // Close connection to db
    $connection->close();

    return $result;
}

/**
 * Get Lyrics by ID
 * 
 * @param string id lyric id
 * 
 * @return Lyrics $result query response
 */
function getLyricsById($id)
{
    // Load credentias to env
    require_once __DIR__ . '/EnvController.php';
    $env = new EnvController(__DIR__ . '/../.env');
    $env->load();

    // Get database credentials from evironment variables
    $servername = getenv("DB_HOST", TRUE);
    $database = getenv("DB_DATABASE", TRUE);
    $username =  getenv("DB_USERNAME", TRUE);
    $password = getenv("DB_PASSWORD", TRUE);

    // Connect to database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create query
    $sql = "SELECT id,title, author, album, lyrics FROM lyrics WHERE id=" . $id;
    $result = $connection->query($sql);

    // Close connection to db
    $connection->close();

    return $result;
}

/**
 * Get latest lyrics
 * 
 * @return Lyrics latest lyrics
 */
function getLastLyrics()
{
    // Load credentias to env
    require_once __DIR__ . '/EnvController.php';
    $env = new EnvController(__DIR__ . '/../.env');
    $env->load();

    // Get database credentials from evironment variables
    $servername = getenv("DB_HOST", TRUE);
    $database = getenv("DB_DATABASE", TRUE);
    $username =  getenv("DB_USERNAME", TRUE);
    $password = getenv("DB_PASSWORD", TRUE);

    // Connect to database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create query
    $sql = "SELECT * FROM lyrics ORDER BY ID DESC LIMIT 1";
    $result = $connection->query($sql);

    // Close connection to db
    $connection->close();

    return $result;
}

/**
 * Get Lyrics filtering by title and author
 * 
 * @param string $value filter value
 * 
 * @return Lyrics $result
 */
function GetLyricsFilter($value)
{
    // Load credentias to env
    require_once __DIR__ . '/EnvController.php';
    $env = new EnvController(__DIR__ . '/../.env');
    $env->load();

    // Get database credentials from evironment variables
    $servername = getenv("DB_HOST", TRUE);
    $database = getenv("DB_DATABASE", TRUE);
    $username =  getenv("DB_USERNAME", TRUE);
    $password = getenv("DB_PASSWORD", TRUE);

    // Connect to database
    $connection = new mysqli($servername, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Create query
    $sql = "SELECT * FROM lyrics WHERE LOWER(author)=" . $value;
    $result = $connection->query($sql);

    // Close connection to db
    $connection->close();

    return $result;
}
