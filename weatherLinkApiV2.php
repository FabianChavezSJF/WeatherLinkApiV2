<?php

// usa la conexión a la base de datos
require_once 'conexion.php';

// obtiene la información de la estación meteorológica

$query1 = "SELECT * FROM `weatherLink_estacionMeteorologica`";
$result1 = $conn->query($query1);
// transformo el resultado en un array
$estacionesMeteorologicas = $result1->fetch_all(MYSQLI_ASSOC);



foreach ($estacionesMeteorologicas as $e) {
    $api_key = $e['weatherLinkApiToken'];
    $api_sec = $e['weatherLinkApiSecret'];
    $id_station = $e['weatherLinkStationId'];

    // imprimo los datos de la estación meteorológica
//     echo "<pre>";
//    print_r($e['weatherLinkApiToken']);
//     echo "</pre>";

    // obtengo los datos actuales de la estación meteorológica
    request_current_station_data($api_key, $id_station, $api_sec);

};

function request_current_station_data($key, $stationId,$secretKey){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.weatherlink.com/v2/current/{$stationId}?api-key={$key}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    // $headers = array();
    // $headers[] = "X-Api-Secret: {$secretKey}";
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    curl_close($ch);

    // Ahora puedes procesar el resultado
    $current_data = json_decode($result, true);

    echo "<pre>";
    echo "Current Data:";
    print_r($current_data);
    echo "</pre>";

    // guardo el error en     error_log($currentDateTime . " - request_current_station_data error: " . $conn->connect_error . "\n", 3, dirname(__FILE__) . "/error.log.txt");
    if (isset($current_data['code']) && $current_data['code'] != 200) {
        $currentDateTime = date('Y-m-d H:i:s');
        error_log($currentDateTime . " - request_current_station_data ERROR: " . $current_data['message'] . "\n", 3, dirname(__FILE__) . "/error.log.txt");
    }

}

