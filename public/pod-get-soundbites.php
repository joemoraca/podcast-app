<?php

//Required values
require_once 'keys.php';
$apiHeaderTime = time();

//Hash them to get the Authorization token
$hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

//Set the required headers
$headers = [
    "User-Agent: SuperPodcastPlayer/1.3",
    "X-Auth-Key: $apiKey",
    "X-Auth-Date: $apiHeaderTime",
    "Authorization: $hash"
];

//Make the request to an API endpoint
// https://github.com/Podcastindex-org/docs-api
$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL,"https://api.podcastindex.org/api/1.0/recent/soundbites?pretty");
curl_setopt($ch, CURLOPT_URL,"https://api.podcastindex.org/api/1.0/recent/soundbites");
//"https://podcastindex.org/api/search/byterm?q=bastiat");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//Collect and show the results
$response = curl_exec ($ch);
curl_close ($ch);
//echo print_r(json_decode($response), TRUE);
$pods = json_decode($response,true);
$pods = array_slice($pods['items'],0,15);

//print_r($pods[0]['episodeTitle']);
echo json_encode($pods);
