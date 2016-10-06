<?php
function getLastFMTrackArtwork($trackArtist, $trackTitle) {
	global $settings;

	// form the url
	$trackArtist = urlencode($trackArtist);
	$trackTitle = urlencode($trackTitle);
	$lastFMUrl = sprintf("https://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=%s&artist=%s&track=%s&autocorrect=1&format=json", $settings->last_fm_api_key, $trackArtist, $trackTitle);

	// poke and parse last.fm
	$lastFMResponse = file_get_contents($lastFMUrl);
	$lastFMResponse = json_decode($lastFMResponse);

	// see if image data is available
	$imageInfo = $lastFMResponse->track->album->image;
	if ($imageInfo == null || count($imageInfo) == 0) {
		return;
	}

	// figure out the biggest image available
	$largestImage = (count($imageInfo) - 1);
	$trackImage = $imageInfo[$largestImage]->{'#text'};

	// return it
	return (strlen($trackImage) > 4 ? $trackImage : null);
}

function getLastFMArtistArtwork($trackArtist) {
	global $settings;

	// form the url
	$trackArtist = urlencode($trackArtist);
	$lastFMUrl = sprintf("https://ws.audioscrobbler.com/2.0/?method=artist.getInfo&api_key=%s&artist=%s&autocorrect=1&format=json", $settings->last_fm_api_key, $trackArtist);

	// poke and parse last.fm
	$lastFMResponse = file_get_contents($lastFMUrl);
	$lastFMResponse = json_decode($lastFMResponse);

	// see if image data is available
	$imageInfo = $lastFMResponse->artist->image;
	if ($imageInfo == null || count($imageInfo) == 0) {
		return;
	}

	// figure out the biggest image available
	$largestImage = (count($imageInfo) - 1);
	for ($a = $largestImage; $a >= 0; $a--) {
		if (strlen($imageInfo[$a]->{'size'}) == 0) {
			continue;
		}
		
		$artistImage = $imageInfo[$a]->{'#text'};
		break;
	}

	// return it
	return (strlen($artistImage) > 4 ? $artistImage : null);
}
?>
