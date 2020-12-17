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
// if(!isset($_GET['fid'])){err('id missing', __LINE__);}
// if(!ctype_digit($_GET['fid'])){err('id not valid', __LINE__);}
//Make the request to an API endpoint
// https://github.com/Podcastindex-org/docs-api
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.podcastindex.org/api/1.0/podcasts/byfeedid?id=".$_GET['id']);
//curl_setopt($ch, CURLOPT_URL,"https://api.podcastindex.org/api/1.0/podcasts/byfeedid?id=664216");
//"https://podcastindex.org/api/search/byterm?q=bastiat");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//Collect and show the results
$response = curl_exec ($ch);
curl_close ($ch);
//echo print_r(json_decode($response), TRUE);
$podcastinfo = json_decode($response,true);
$podcastinfo = array_slice($podcastinfo['feed'],0,50);
//print_r($pods);
//print_r($pods[0]['episodeTitle']);
echo json_encode($podcastinfo);