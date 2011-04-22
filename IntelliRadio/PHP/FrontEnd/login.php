<?php

require_once('../includes/include_user.inc');
require_once 'facebook.php';
require_once('../includes/include_db.inc');

$user = $_SESSION['user'];
$loginParam = $user; 
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
		if ($me) {
		  $logoutUrl = $facebook->getLogoutUrl();
		} else {
		  $loginUrl = $facebook->getLoginUrl();
		}
		$data = array('session' => $session, 'me' => $me, 'facebook' => $facebook);

    if( is_null($loginParam) ) { ?>
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
		
		

            <form name="chooser" action="index.php?page=login&loginAttempt=true" method="POST">
                Username :
                    <input type="text" name="username" />
               
                Password      :
                    <input type="password" name="password" />

                
                <p align="right">
                    <input type="submit" name="submit" id="button1" value="Login" />
                </p>
            </form>
            <a href="index.php?page=register">New to IntelliRadio? Register Here.</a><br/>
            <!--<iframe src="fb.php" height="100" width="50%"></iframe>-->
			
			<?php if ($me){ ?>
		    <p>You are logged in through Facebook as <?php echo $me['name']; 
		    $user = User::instantiateUser($me['id'], $me['name'], 'default',$_SERVER['REMOTE_ADDR']); 
		    $_SESSION['user'] = $user;
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
	    	<a href="<?php echo $loginUrl; ?>">
			<img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif" />
			</a>
	    <?php } else { ?>
	      	<div>
			<a href="<?php echo $loginUrl; ?>">
			<img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
			</a>
			</div>
	    <?php } ?>
	
	    <div id="fb-root"></div>

<?php } else {
		echo "</p>You are already logged in as ".$user->name."</p>";
	}?>

<?php

if($_GET['loginAttempt']==true) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$db = dbAccess::getInstance();
	$db->setQuery('SELECT id,password,container FROM users WHERE name='.$username);
	if ( is_null($result = $db->loadAssoc()) ) {
		echo "<p>Error: Username does not exist.</p>";
	}
	else {
		if ( $result['password'] != $password ) {
			echo "<p>Error: Incorrect password.</p>";
		}
		else {
			$user = User::instantiateUser($result['id'], $username, $result['container'], $_SERVER['REMOTE_ADDR']);
			$_SESSION['user'] = $user;
			echo "<p>Welcome back, ".$user->name."</p>";
		}
	}
   
}

?>

