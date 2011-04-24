<?php 
if ( is_null($_SESSION['user']) ) {
	//header('Location:index.php');
	echo "<script type=\"text/javascript\">"
		 ."alert('You have not logged in!');"
		 ."self.location='index.php';"
		 ."</script>";
}
?>