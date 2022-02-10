<?php

//Database Connections
//Feeds Data

$dbname = /* database name */"";
$dbhost = /* database host */"";
$dbun = /* database user */"";
$dbps = /* database pass */"";

$conn = new mysqli($dbhost,$dbun,$dbps,$dbname);

$conn->query("SET session wait_timeout=28800");

echo "<br/>";

// Check connection

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
} else {
  echo "Success...";
}

//Database Connections
//Woo Data

$dbname = /* database name */"";
$dbhost = /* database host */"";
$dbun = /* database user */"";
$dbps = /* database pass */"";

$woo_conn = new mysqli($dbhost,$dbun,$dbps,$dbname);

$woo_conn->query("SET session wait_timeout=28800");

echo "<br/>";

// Check connection

if ($woo_conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $woo_conn -> connect_error;
  exit();
} else {
  echo "Success...";
}


?>