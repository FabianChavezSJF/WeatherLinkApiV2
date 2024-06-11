<?php

$apiKey = "bzdgstlzquphtkkgmlbn3uuesnaqdt6d";
$url = "https://api.weatherlink.com/v2/stations?api-key=" . $apiKey;
// and include a header named X-Api-Secret
$secretKey ="flvykv2p8ah3lix7uzmmqkmwpnkrak4s";
$headers = array();
$headers[] = "X-Api-Secret: " . $secretKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
curl_close($ch);

// Ahora puedes procesar el resultado
$stations = json_decode($result, true);

// imprimo la data mediciones
echo "<pre>";
print_r($stations);
echo "</pre>";
