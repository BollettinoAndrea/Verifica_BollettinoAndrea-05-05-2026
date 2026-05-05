<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "bollettino_gym";

$istanza = new mysqli($host, $user, $pass, $db);

f ($istanza->connect_error) {
    die("Database non raggiungibile.");
}
