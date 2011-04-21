<?php
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
		$data = array('session' => $session, 'me' => $me, 'facebook' => $facebook); ?>
		
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
    <a href="<?php echo $logoutUrl; ?>">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>
    <?php } else { ?>
      	<div>
		<a href="<?php echo $loginUrl; ?>">
		<img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
		</a>
		</div>
    <?php } ?>

    <div id="fb-root"></div>