<?php

if(isset($_GET['score'])){
	require_once('data/settings.php');
$conn =new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "insert INTO tempData (value) VALUES('".$_GET['score']."')";
if ($conn->query($query) !== TRUE)
echo 'fail';

  $conn->close();
}
?>