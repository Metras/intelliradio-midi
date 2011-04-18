<?php
session_start();
require_once('../includes/include_user.inc');
require_once('../includes/include_db.inc');
$loginParam = $_SESSION['user']->loggedIn;
    if($loginParam != true) { ?>

<table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#3366FF">
    <tr>

        <td>
		

            <form name="chooser" action="index.php?page=login&loginAttempt=true" method="POST">
                <p align="center" class="main_nav">&nbsp;</p>
                <p align="center"><span class="style3">Username</span> :
                    <input type="text" name="username" />
                </p>
                <p align="center"><br/>
                    <span class="style3">Password</span>       :
                    <input type="password" name="password" />

                </p>
                <p align="right">
                    <input type="submit" name="submit" id="button1" value="Login" />
                </p>
            </form>

        </td>
    </tr>
</table>

<?php } else {?>
		<p>You are logged in</p>
<?php } ?>

<?php

if($_GET['loginAttempt']==true) {

   
}

?>

