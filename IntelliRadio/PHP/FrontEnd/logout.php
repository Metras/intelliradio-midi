<?php
require_once '../includes/include_links.inc';
$_SESSION['iuser'] = null;
echo '<p>You have logged out. To log back in, go to '.LOGIN_LINK.'</p>';
echo "<script type=\"text/javascript\">"
		 			."self.location='index.php';"
		 				."</script>";