<?php
$dbhost = "w00fcbe9.kasserver.com";
$dbname = "d01bb553";
$dbuser = "d01bb553";
$dbpass = "rphATaqtd3xQqykq";
try { $connection = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass); } catch (PDOException $e) { die($e->getMessage()); }
	$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$statement = $connection->query('SELECT strasse, latitide, longitude, url FROM data ');
	echo 'window.data = '.json_encode($statement->fetchAll());
 ?>