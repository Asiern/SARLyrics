<?php

// Load env variables from .env
require_once __DIR__ . '/EnvController.php';
$env = new EnvController(__DIR__ . '/../.env');
$env->load();

// Get credentials from env
$key = getenv("API_KEY");

/**
 * Get Track cover image from last.fm api
 * 
 * @param string $track track title
 * @param string $artist artist name
 * 
 * @return string|null string <=> request success && has image; null <=> request failed || has no image;
 */
function getTrackCover($track, $artist)
{
    global $key;
    // Encode strings using html url encoding
    $request = "https://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=" . $key . "&artist=" . str_replace(" ", "%20", $artist) . "&track=" . str_replace(" ", "%20", $track);
    $response  = file_get_contents($request);
    $xmlobj  = simplexml_load_string($response);

    if ($xmlobj["status"] == "failed") {
        return null;
    }

    // TODO error control
    // if ($xmlobj->track === null) {
    //     return "";
    // }
    // if ($xmlobj->track->album === null) {
    //     return "";
    // }
    // if ($xmlobj->track->image === null) {
    //     return "";
    // }

    if ($xmlobj->track->album->image[3] == null) {
        return "";
    }
    $album = $xmlobj->track->album->image[3];
    return $album;
}
