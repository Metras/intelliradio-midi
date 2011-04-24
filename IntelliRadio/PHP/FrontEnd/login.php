<?php

require_once '../includes/include_user.inc';
//require_once 'facebook.php';
require_once '../includes/include_db.inc';
require_once '../includes/include_links.inc';
require_once '../includes/include_functions.inc';

$user = $_SESSION['iuser'];
$loginParam = $user; 
// Create our Application instance (replace this with your appId and secret).
		/*$facebook = new Facebook(array(
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
		if ($me) {
		  $logoutUrl = $facebook->getLogoutUrl();
		} else {
		  $loginUrl = $facebook->getLoginUrl();
		}
		$data = array('session' => $session, 'me' => $me, 'facebook' => $facebook); */

    if( is_null($loginParam) ) { ?>
    	<!--  <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php //echo $facebook->getAppId(); ?>',
          session : <?php //echo json_encode($session); ?>, // don't refetch the session when PHP already has it
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
    </script>-->
	<center><table border="0" width="100%">
		<form name="chooser" action="index.php?page=login&loginAttempt=true" method="POST">
               <tr><td> Username : </td>
                   <td><input type="text" name="username" width="100" /></td> </tr>
               
                <tr><td>Password : </td>
                    <td><input type="password" name="password" width="100"/></td></tr>

                
                <tr><td colspan="2"><p align="right">
                    <input type="submit" name="submit" id="button1" value="Login" /></td></tr>
                </p>
            </form>
      </table> </center>
            <a href="index.php?page=register">New to IntelliRadio? Register Here.</a><br/>
            <!--<iframe src="fb.php" height="100" width="50%"></iframe>-->
			
		

<?php } else {
		$user = unserialize($_SESSION['iuser']);
		echo '</p>You are already logged in as '.$user->name.'.'.LOGOUT_LINK.'</p>';
		
	}?>

<?php

login();

?>

