<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$data = json_decode ( file_get_contents ( 'php://input' ), true );
// please optimise this page
if (isset ( $data ['dataLoad'] ) && isset ( $data ['date'] ) && isset ( $data ['token'] )) {
	
	require_once ('../data/settings.php');
	header ( "token:" . $data ['token'] );

	$conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	$query = "SELECT sum(value) sum FROM `checkbox_items` WHERE sl_no in ('" . implode ( "','", $data ['dataLoad'] ["selectedChk"] ) . "')";
	$result = $conn->query ( $query );
	$row = $result->fetch_assoc ();
	$score = $row ['sum'];
	$query = "SELECT sl_no,value FROM `number_items` WHERE sl_no in ('" . implode ( "','", array_keys ( $data ['dataLoad'] ["selectedNum"] ) ) . "')";
	
	$result = $conn->query ( $query );
	if ($result->num_rows > 0) {
		while ( $row = $result->fetch_assoc () ) {
			
			$score += $data ['dataLoad'] ["selectedNum"] [$row ['sl_no']] * $row ['value'];
		}
	}
	
	$query = "replace INTO daily  VALUES('" . $data ['date'] . "','" . $score . "')";
	if ($conn->query ( $query ) !== TRUE)
		echo 'fail1';
	
	$query = "replace INTO tempData (`key`,`value`) VALUES('" . $data ['date'] . "' ,'" . json_encode ( $data ['dataLoad'] ) . "')";
	
	if ($conn->query ( $query ) === TRUE)
		echo 'save success ' . $score;
	else
		echo 'fail2';
	
	$conn->close ();
}
else if (isset ( $data ['newItem'] ) && isset ( $data ['date'] ) && isset ( $data ['newValue'] ) && isset ( $data ['token'] )) {
	
	require_once ('../data/settings.php');
	header ( "token:" . $data ['token'] );
	$conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	$query = "replace INTO checkbox_items (`item`,`value`) VALUES('" . $data ['newItem'] . "' ,'" . $data ['newValue'] . "')";
	if ($conn->query ( $query ) === TRUE)
		echo 'add success ' ;
	else
		echo 'fail2';
	
	$conn->close ();
}


else  {
echo $_POST["task"] ;
}
?>