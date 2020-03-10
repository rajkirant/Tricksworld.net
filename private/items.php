<?php
$data = json_decode ( file_get_contents ( 'php://input' ), true );
if ($data ["date"]) {
	require_once ('../data/settings.php');
	$conn = new mysqli ( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	$timestamp = strtotime ( $data ["date"] );
	$hour = date ( 'H', $timestamp ) - 1;
	$sql = "SELECT sl_no,item, value,time_hour FROM checkbox_items where time_hour <" . $hour . " order by item ASC";
	$result = $conn->query ( $sql );
	
	$final = new StdClass ();
	$dbdata = new StdClass ();
	if ($result->num_rows > 0) {
		while ( $row = $result->fetch_assoc () ) {
			$item=$row ["item"];
			$dbdata->  $item =( int ) $row ["sl_no"];
		}
		
		$sql = "SELECT value FROM tempData where `key`='" . date ( 'Y', $timestamp ) . "-" . date ( 'm', $timestamp ) . "-" . date ( 'd', $timestamp ) . "'";
		
		$result = $conn->query ( $sql );
		
		if ($result->num_rows == 1 && $row = $result->fetch_assoc ()) {
			
			// echo $row ["value"];
			$select = json_decode ( $row ["value"], true );
			if(isset($select ["selectedNum"]))
					$final->selectedNum= $select ["selectedNum"];
					if(isset($select ["selectedChk"]))
			$final->selectedChk = $select ["selectedChk"];
		}
		
		$final->dataChk = $dbdata;
	} else {
		echo "0 results";
	}
	$sql = "SELECT sl_no,item, value FROM number_items order by item ASC";
	$result = $conn->query ( $sql );
	
	if ($result->num_rows > 0) {
		$dbdata = new StdClass ();
		while ( $row = $result->fetch_assoc () ){
			$item=$row ["item"] ;
			$dbdata->$item= ( int ) $row ["sl_no"];
		}
		
		$final->dataNum = $dbdata;
		
		header ( 'Content-Type: application/json' );
		echo json_encode ( $final );
	} else {
		echo "0 sresults";
	}
	$conn->close ();
}
?>