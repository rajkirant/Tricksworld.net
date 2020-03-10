<?php
if(isset($_GET['item'])){
	require_once('../data/settings.php');
$conn =new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT task FROM tasks where item='".$_GET['item']."'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
<title>Tasks</title>
<meta name=viewport content="width=device-width,ucinitial-scale=1"/>
<script>
function myFunction() {
	var item =findGetParameter("item");

	var x = document.getElementById("txt");

      var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	  	if(this.responseText === "success")
		location.reload();
    }
  };
  xhttp.open("GET", "save.php?task="+x.value+"&item="+item, true);
  xhttp.send();
}
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}
</script>
</head>
<body>
<?php
if ($result->num_rows > 0) {
	?>
 <h2>Tasks</h2>
 <table border="1">
   <tr>
    <th>Tasks</th> 
  </tr>
<?php

    while($row = $result->fetch_assoc()) {
  echo '<tr><td>'.$row["task"].'</td>'; 
$lastPrevious=$previous; 
 $previous=$row["value"];

}
    echo "</table>";
} else {
    echo "0 results";
}
 $conn->close();
}
?>


Add a Task:<br>

  <input id="txt" type="text" name="task">
  <br>
<button onclick="myFunction()">Add</button>

</body>
</html>