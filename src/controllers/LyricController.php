<?php

/**
 * @author Asier Nuñez
 * @license MIT
 * @see https://github.com/Asiern/SARLyrics
 */

// Load env variables from .env
require_once __DIR__ . '/EnvController.php';
$env = new EnvController(__DIR__ . '/../.env');
$env->load();

// Get credentials from env
$servername = getenv("DB_HOST", TRUE);
$database = getenv("DB_DATABASE", TRUE);
$username =  getenv("DB_USERNAME", TRUE);
$password = getenv("DB_PASSWORD", TRUE);

// Connect to database using credentials
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

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
function SaveLyrics($title, $author, $album, $lyrics, $cover)
{
    global $connection;

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
    global $connection;

    // Create query
    $sql = "SELECT id, title, author, cover FROM lyrics";
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
    global $connection;

    // Create query
    $sql = "SELECT id, title, author, album, lyrics, cover FROM lyrics WHERE id=" . $id;
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
    global $connection;

    // Create query
    $sql = "SELECT id, title, author, cover FROM lyrics ORDER BY ID DESC LIMIT 1";
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
    global $connection;

    // Create query
    $sql = "SELECT id, title, author, cover FROM lyrics WHERE LOWER(author)='" . $value . "' OR LOWER(title)='" . $value . "'";
    $result = $connection->query($sql);

    // Close connection to db
    $connection->close();

    return $result;
}
