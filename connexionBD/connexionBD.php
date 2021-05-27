<?php
try
{
	global $PDO;
	global $db;
$db = new PDO('mysql:host=127.0.0.1;dbname=currency_converter;charset=utf8', 'root', '');


$base_de_donnee = "currency_converter" ;
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}



?>