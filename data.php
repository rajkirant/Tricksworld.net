<?php
if(isset($_POST['pageName'])){
	echo $_POST['pageName'];
        if($_POST['pageName']=="l1"){
addFile("home.txt");
}
else if($_POST['pageName']=="l6"){
addFile("contactUs.txt");
}
else if($_POST['pageName']=="l7"){
addFile("games.txt");
}
else if($_POST['pageName']=="l8"){
addFile("fun.txt");
}
else if($_POST['pageName']=="l4"){
$email=$_POST['email'];
$msg=$_POST['msg'];
require_once('data/settings.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "INSERT INTO `feedback` (`email`, `message`) VALUES ('$email','$msg')";
if(mysqli_query($dbc,$query))
echo "Your Message has been sent";
else
echo "failed";
mysqli_close($dbc);
}
else if($_POST['pageName']=="l5"){
addFile("aboutMe.txt");}
}
function addFile($pageName){
	$file_handle = fopen("data/".$pageName, "r");
	while (!feof($file_handle))
   echo fgets($file_handle);
}

?>