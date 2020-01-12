<?php
$i=false;
if(isset($_POST['e']) && $_POST['e']=="inbox"){
		setcookie('status', 'ok', time() + (60 * 60 * 24 * 30), '/', '.tricksworld.net');
		$i=true;
}?><!DOCTYPE html><html><head><meta name=viewport content="width=device-width,ucinitial-scale=1"/></head><?php
if((isset($_COOKIE['status']) && $_COOKIE['status']=="ok") || $i==true){
?><body>
<a href="http://m.youjizz.com" >Youjizz</a><br/>
<a href="http://wapoz.ru">Wap Oz</a><br/>
<a href="http://redtube.com">Red Tube</a><br/>
<a href="http://thumbzilla.com" >Thumbzilla</a><br/><a href="http://cliphunter.com" >Cliphunter</a><br/><a href="http://eporner.com" >Eporner</a><br/><a href="http://pornhub.com" >Pornhub</a><br/><a href="http://beeg.com" >Beeg</a><br/><a href="http://ruleporn.com" >RulePorn</a><br/><a href="http://porn.com" >Porn.com</a><br/><a href="http://fantasti.cc" >Fantasti</a><br/><a href="http://vid.me" >Vid.me</a><br/><a href="http://pornmaki.com" >Porn Maki</a><br/><a href="http://vporn.com" >VPorn</a><br/><a href="http://m.newsfilter.org" >Newsfilter</a><br/><a href="http://realgfporn.com" >Real GF Porn</a><br/><a href="http://submityourflicks.com" >Submit Your Flicks</a><br/><br/><br/>Recommanded android apps<br/><br/><a href="http://tricksworld.net/files/android/TubeMate(www.tricksworld.net).apk">Tubemate(downloading streaming vids)</a><br/><a href="http://tricksworld.net/files/android/Zerovpn(www.tricksworld.net).apk">Zero VPN(unblock sites)</a><br/>
<?php	include_once("../data/settings.php");$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);$query = "INSERT INTO `status` (`id`, `ip`) VALUES ('2', '".$_SERVER['REMOTE_ADDR']."')";mysqli_query($dbc,$query);mysqli_close($dbc);
}
else{
?>
<body>
<form action="index.php" method="post">
  Password:<br>
  <input type="password" name="e" id="e">
  <br><br>
  <input type="submit" value="Submit">
</form> 

<?php
}
?></body></html>
	