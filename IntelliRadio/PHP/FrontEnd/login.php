<?php
session_start();
require_once('../includes/include_user.inc');
require_once('../includes/include_db.inc');
$loginParam = $_SESSION['user']->loggedIn;
require_once(dirname(__FILE__).DS.'facebook.php');

		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
  										'appId'  => '195495487137724',
  										'secret' => '5cfac41ccd9679c8e03eaaa387b01cd8',
  										'cookie' => true,
										));

		$session = $facebook->getSession();

		$me = null;
		// Session based API call.
		if ($session) {
			try {
				$uid = $facebook->getUser();
				$me = $facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}
		$data = array('session' => $session, 'me' => $me, 'facebook' => $facebook);
    if($loginParam != true) { ?>
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<body>
<table border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#3366FF">
    <tr>

        <td>
		

            <form name="chooser" action="index.php?page=login&loginAttempt=true" method="POST">
                Username :
                    <input type="text" name="username" />
                </p>
                Password      :
                    <input type="password" name="password" />

                </p>
                <p align="right">
                    <input type="submit" name="submit" id="button1" value="Login" />
                </p>
            </form>
            
  

    <?php if ($me){ ?>
    <p>You are logged in through Facebook as <?php echo $me['name']; 
    $user = User::instantiateUser($me['id'], $me['name'], 'default',$_SERVER['REMOTE_ADDR']); 
    $db = &dbAccess::getInstance();
    $db->setQuery('SELECT name FROM users WHERE userId = '.$user->id);
    if ( !($container = $db->loadResult()) ) {
    	$dbUser = new stdClass();
    	$dbUser->id = $user->id;
    	$dbUser->name = $user->name;
    	$dbUser->password  = md5(rand());
    	$dbUser->container = 'default';
    	$dbUser->user_ip = $user->user_ip;
    	$db->insertObject('users',$dbUser,'userId');
    } else {
    	$user->container = $container;
    }?>.</p>
    <a href="<?php echo $logoutUrl; ?>">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
    <?php } else { ?>
      <fb:login-button></fb:login-button>
    <?php } ?>

    <div id="fb-root"></div>
    
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $facebook->getAppId(); ?>',
          session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>

        </td>
    </tr>
</table>

<?php } else {
		echo "</p>You are already logged in as ".$user->name."</p>";
	}?>

<?php

if($_GET['loginAttempt']==true) {
	
   
}

?>
</body></html>

