<?php
//include_once('admin_functions.php');
//include_once('localDB.php');

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("intelliradio", $con);


if ( $_GET['do'] == 'newuser' ) {
	checkAvail( $_GET['name'] );
}


function checkAvail($username) {
	
	$userExists = mysql_fetch_assoc(mysql_query("SELECT id FROM users WHERE name='$username'"));
	if ( $userExists['id'] == '' ) {
		echo '<div id=\"usename\" class=\"available\"><p>Username '.$username.' is available</p></div>';
	}
	else {
		echo '<div id=\"usename\" class=\"notavailable\"><p>Username '.$username.' is already being used. Please choose another</p></div>';
	}
}


?>