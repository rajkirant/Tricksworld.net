var user;
var hid;
var cid;
$(document).ready(function(){
$('a').click(function(e) {
    e.preventDefault();
});
	getData("l1");
	$("a").hover(function(){
		$(this).css("text-decoration", "underline");
		$(this).css("font-weight", "bold");
		hid = $(this).prop('id');
	}, function(){
		if(cid != hid)
		$(this).css("font-weight", "normal");
		$(this).css("text-decoration", "none");
	});
});
function updateLogin(){
user=getCookie("name");
	if (user != ""){
		document.getElementById("l3").innerHTML = "Log Out("+ user +")";
		document.getElementById("l2").innerHTML = "View Profile";
	}
}
function setBackground(){
	var d = new Date();
	if(d.getHours()<6 || d.getHours()>20)
		document.body.style.backgroundImage = "url('images/background3.jpg')";
	else if (d.getHours()<17)
		document.body.style.backgroundImage = "url('images/background1.jpg')";
	else
		document.body.style.backgroundImage = "url('images/background2.jpg')"; 
}
function getData(page){
	cid=page;
	var x = document.getElementsByTagName("a");
    for (var i = 0; i < x.length; i++) {
        x[i].style.backgroundColor = "transparent";
		x[i].style.textDecoration = "none";
		x[i].style.fontWeight = "normal";
    }
	if(page.charAt(0) == "l"){
	var y = document.getElementById(page);
        y.style.backgroundColor = "#75CE00";
		y.style.fontWeight = "bold";
		}
	user=getCookie("name");
	if(page=="l3" && user != ""){
		logout();
		return;
	}
	$("#data").html("<img style='padding: 80px 0px 0px 80px;' src='images/loading.gif' alt='Loading please wait...'/>");
	var posting =$.post("data.php",{
		pageName:page
	});
	posting.done(function(data){
		if(data.substring(0,cid.length)==cid)
		$("#data").html(data.substring(cid.length));
	});
	posting.fail(function(){
	$("#data").html("<h5>Please Check Your Connection.....</h5>");
	});
}
function submitForm(form){
if(form.elements["email"].value.length !=0 && form.elements["msg"].value.length !=0){
$.post(  // define a post method 
"data.php",
 { email: form.elements["email"].value,
 msg: form.elements["msg"].value,
 pageName:"l4"},
  function(data) {
   $('#data').html(data.substring(2));
   });
   }
   else
   alert("please fill email and message");
}
function logout(){
	deleteCookie("user_id");
	deleteCookie("name");
	deleteCookie("email");
	document.getElementById("l3").innerHTML = "Log In";
	document.getElementById("l2").innerHTML = "Sign Up";
	alert("You are successfully logged out");
	getData("l1");
}
function validateEmail(inputField, helpText){
	if (!validateNonEmpty(inputField, helpText))
		return false;
	return validateRegEx(/^[\w\.-_\+]+@[\w-]+(\.\w{2,3})+$/,inputField.value, helpText,"Please enter a valid email address.");
}
function validateNonEmpty(inputField, helpText){
	return validateRegEx(/.+/,inputField.value, helpText,"Please enter a value.");
}
function validateRegEx(regex, input, helpText, helpMessage){
	if (!regex.test(input)){
		if (helpText != null)
			helpText.innerHTML = helpMessage;
		return false;
	}else{
		if (helpText != null)
			helpText.innerHTML = "";
		return true;
	}
}
function validateEqual(password1,password2,helpText){
	if(password1.value ==password2.value){
		if (helpText != null)
			helpText.innerHTML = "";
		return true;
	}else{
		if (helpText != null)
		helpText.innerHTML = "Password must match.";
		return false;
	}
}
function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(";");
	for(var i=0; i<ca.length; i++){
		var c = ca[i];
		while (c.charAt(0)==" ") c = c.substring(1);
		if (c.indexOf(name) == 0)
			return c.substring(name.length, c.length);
	}
	return "";
}
function deleteCookie(name){
	cookieStr = name + "=;expires=Tue, 23 Jun 2015 06:44:32 GMT;path=/;domain=.tricksworld.net; ";
	document.cookie = cookieStr;
}