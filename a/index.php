<?php
$i=false;
if(isset($_POST['e']) && $_POST['e']=="inbox"){
		setcookie('status', 'ok', time() + (60 * 60 * 24 * 30), '/', '.tricksworld.net');
		$i=true;
}
if((isset($_COOKIE['status']) && $_COOKIE['status']=="ok") || $i==true){
?>
<a href="http://m.youjizz.com" >Youjizz</a><br/>
<a href="http://wapoz.ru">Wap Oz</a><br/>
<a href="http://redtube.com">Red Tube</a><br/>
<a href="http://thumbzilla.com" >Thumbzilla</a><br/><a href="http://cliphunter.com" >Cliphunter</a><br/><a href="http://eporner.com" >Eporner</a><br/><a href="http://pornhub.com" >Pornhub</a><br/><a href="http://beeg.com" >Beeg</a><br/><a href="http://ruleporn.com" >RulePorn</a><br/><a href="http://porn.com" >Porn.com</a><br/><a href="http://fantasti.cc" >Fantasti</a><br/><a href="http://vid.me" >Vid.me</a><br/><a href="http://pornmaki.com" >Porn Maki</a><br/><a href="http://vporn.com" >VPorn</a><br/><a href="http://m.newsfilter.org" >Newsfilter</a><br/><a href="http://realgfporn.com" >Real GF Porn</a><br/><a href="http://submityourflicks.com" >Submit Your Flicks</a>
<?php	
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
?>
	