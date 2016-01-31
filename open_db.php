<?php
$conn = mysql_connect("localhost", "root", "");
if (!$conn) {
    $log->error('No se ha podido conectar: ' . mysql_error());
    die('No se ha podido conectar: ' . mysql_error());
}
mysql_select_db("jbalmes", $conn) or die('No se ha podido seleccionar la base de datos "jbalmes".');
?>