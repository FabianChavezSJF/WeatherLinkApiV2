<!-- creo la coneccion a la bd con IP

http://162.214.97.208:2082/

BD

Vdnsjf_dropcontrol

Usuario

Vdnsjf_desarrollo2

Clave:

FarmsDes.2023 -->

<?php
$servername = "162.214.97.208:3306";
$username ="vdnsjf_desarrollo2";
$password ="FarmsDes.2023";
$dbname = "vdnsjf_dropcontrol";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $currentDateTime = date('Y-m-d H:i:s');
    error_log($currentDateTime . " - Connection ERROR: " . $conn->connect_error . "\n", 3, dirname(__FILE__) . "/error.log.txt");
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
