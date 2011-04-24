<?php
require_once '../includes/include_db.inc';
?>

<html><head><title>Registration</title>

<script type="text/javascript">
function checkUsr(str)
{
	/*var usernameField = document.getElementById("usr");
	var str = usernameField.value;*/
	if (str=="")
	  {
	  document.getElementById("user").innerHTML="";
	  return;
	  } 
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("user").innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET","router.php?do=newuser&name="+str,true);
	xmlhttp.send();
}
function chekPwd(form) {
	with(form) {
		if(pwd1.value != pwd2.value) {
			document.getElementById("pwd").innerHTML = "<div><p>Passwords do not match!</p></div>";
			return false;
		}
		else {
			return true;
		}
	}	
}
</script>

<LINK href="style.css" rel="stylesheet" type="text/css">

</head>
<body>
<form name="newUserForm" method="post" action="index.php?page=register&submitted=true" onsubmit="return chekPwd(this)">
<table width="80%" style="cell-padding:5px" >

	<tr>
		<td>Username:</td>
		<td><input type="text" size="30" name="userName" id="usr" onblur="checkUsr(this.value)"/>
			<div id="user"></div>
		</td>
	</tr>
	<!--<tr>
		<td></td><td><a href="" onclick="checkUsr()">Check Availability</a></td>
	</tr>-->
	
	<tr>
		<td>Password:</td>
		<td><input type="password" size="30" name="pwd1"  id="pwd1"/></td>
	</tr>
	<tr>
		<td>Re-type password:</td>
		<td><input type="password" size="30" name="pwd2" id="pwd2" />
			<div id="pwd"></div>
		</td>
	</tr>
	
	<tr>
		<td></td><td><input type="submit" value="Submit" style="padding:4px"/></td>
	</tr>
	
</table>
</form>
<?php 
if ( $_GET['submitted'] ) {
	$pwd = md5($_POST['pwd1']);
	$db = dbAccess::getInstance();
	$insertUser = new stdClass();
	$insertUser->id = '';
	$insertUser->name = $_POST['userName'];
	$insertUser->password = $pwd;
	$insertUser->container = 'default';
	$insertUser->user_ip = $_SERVER['REMOTE_ADDR'];
	$inserted = $db->insertObject('users',$insertUser,'id');
	//$inserted = mysql_query("INSERT INTO users VALUES('{$_POST['userName']}','$pwd')");
	if ( $inserted ) {
		echo '<div class="gt-success"><p>New user entered successfully</p></div>';
	}
}
?>

</body>
</html>
