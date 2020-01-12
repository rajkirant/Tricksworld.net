<?php
if(isset($_GET['request'])){

	$request=$_GET['request'];

	if($request=="get"){
//$data='http://nodk.ru/en';

//$data='http://aliuser.vcp.ir/';

//$data='http://www.fullprogramlarindir.com/eset-nod32-eset-smart-security-guncel-key-2016.html';

$data='http://www.nod32id.xx.tn/';

$data= file_get_contents($data);

$data=explode("Username",$data);

$op=array();
foreach($data as $id){
if(((strpos($id,"TRIAL")) || strpos($id,"EAV")) && strpos($id,"Password") && strlen($id)<1000){

if(strpos($id,"Expiration"))

$id = strchr($id,"Expiration",true);


$id=strip_tags($id);






$id=str_replace(' ','',$id);

$id=str_replace(':','',$id);

$id=str_replace('&','',$id);

$id=str_replace('#65306;','',$id);

$id=str_replace('nbsp;','',$id);

if(strpos($id,"Password")){

	

	$c=strpos($id,"Password")+13;

	$id=str_replace('Password','***',$id);

	$id= substr($id,0,$c);

	//echo $id;

	array_push($op,$id);

}

}}

//print_r($op);



echo $op[rand(0, count($op)-1)];

include_once("../../data/settings.php");

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "INSERT INTO `status` (`id`, `ip`) VALUES ('1', '".$_SERVER['REMOTE_ADDR']."')";

mysqli_query($dbc,$query);

mysqli_close($dbc);

}

else if($request=="abuse"){

$subject = 'Abuse';

$raj = 'admin@tricksworld.net';

$msg = 'a node abuse has been reported';

$to1 = 'rajkirant@live.com';

mail($to1, $subject, $msg, 'From:' . $raj);

echo 'done';

}}

?>