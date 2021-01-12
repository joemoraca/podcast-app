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
curl_setopt($ch, CURLOPT_URL,"https://podcastindex.org/api/search/byterm?q=".urlencode($_GET['squery']));
//curl_setopt($ch, CURLOPT_URL,"https://podcastindex.org/api/search/byterm?q=Roman+history");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//Collect and show the results
$response = curl_exec ($ch);
curl_close ($ch);
$sresult = json_decode($response,true);
//$sresult = array_slice($sresult['items'],0,5);

echo json_encode($sresult);
