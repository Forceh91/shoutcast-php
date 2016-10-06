<?php
// config loader
require_once('inc/config_loader.php');

// shoutcast query
$shoutcastStatsJSON = file_get_contents('http://' . $settings->shoutcast_url . 'stats?sid=' . $settings->shoutcast_stream . '&json=1');
$shoutcastStats = json_decode($shoutcastStatsJSON);
if ($shoutcastStats == null) {
	echo json_encode(array(
		'status' => 'error',
		'message' => 'Unable to communicate with the shoutcast URL'
	));
	
	return;
}

// last.fm cache stuff
require_once('inc/lastfm_funcs.php');

// get the current song title and split
$trackArtist = "";
$trackTitle = "";
$trackArtwork = null;
$currentArtistTrack = $shoutcastStats->songtitle;
$currentArtistTrack = explode(" - ", $currentArtistTrack, 2);

// parse out into artist/track
$splitCount = count($currentArtistTrack);
if ($splitCount == 1) {
	$trackTitle = $currentArtistTrack[0];
} else if ($splitCount == 2) {
	$trackArtist = $currentArtistTrack[0];
	$trackTitle = $currentArtistTrack[1];
}

// first we'll look on last.fm for track artwork
$trackArtwork = getLastFMTrackArtwork($trackArtist, $trackTitle);

// last ditch attempt, lets get the artist artwork instead
if ($trackArtwork == null) {
	$trackArtwork = getLastFMArtistArtwork($trackArtist);
}

$json = array(
	'artist' => $trackArtist,
	'track' => $trackTitle,
	'artwork' => $trackArtwork,
);

echo json_encode($json);
?>
