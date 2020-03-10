<?php
	require_once('../data/settings.php');
$conn =new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT date, value FROM daily ORDER BY date";
$result = $conn->query($sql);
$dbdata = array();
$lastPrevious=0;
$previous=0;
    while($row = $result->fetch_assoc()) {
  $dbdata[]=(object)array($row["date"]=>round(($row["value"]+$previous+$lastPrevious)/3));
$lastPrevious=$previous; 
 $previous=$row["value"];

}
header('Content-Type: application/json');
echo json_encode($dbdata);
 $conn->close();
?>