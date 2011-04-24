<?php session_start(); 
require_once('../includes/include_functions.inc');
require_once '../includes/include_user.inc';
$user = unserialize($_SESSION['iuser']); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>IntelliRadio </title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <div id="art-page-background-gradient"></div>
    <div id="art-page-background-glare">
        <div id="art-page-background-glare-image"></div>
    </div>
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-nav">
                	<div class="l"></div>
                	<div class="r"></div>
                	<ul class="art-menu">
                		<li>
                			<a href="index.php?page=home" class="active"><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
                		</li>
                		<li>
                			<a href="<?php if ( !$user )
                							echo 'index.php?page=login';
                						   else 
                						   	echo 'index.php?page=logout';?>"><span class="l"></span><span class="r"></span><span class="t">
                						   	<?php if ( !$user )
                									echo 'Login';
                						   		  else 
                						   			echo 'Logout';?></span></a>
                			
                		</li>
                		<li>
                			<a href="index.php?page=request&container=all"><span class="l"></span><span class="r"></span><span class="t">Request</span></a>
                		</li>		
                		<li>
                			<a href="index.php?page=about"><span class="l"></span><span class="r"></span><span class="t">About IntelliRadio</span></a>
                		</li>
                	</ul>
                </div>
                <div class="art-header">
                    <div class="art-header-jpeg"></div>
                    
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1">
                            <div class="art-vmenublock">
                                <div class="art-vmenublock-body">
                                            <div class="art-vmenublockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t">IntelliRadio</div>
                                            </div>
                                            <div class="art-vmenublockcontent">
                                                <div class="art-vmenublockcontent-tl"></div>
                                                <div class="art-vmenublockcontent-tr"></div>
                                                <div class="art-vmenublockcontent-bl"></div>
                                                <div class="art-vmenublockcontent-br"></div>
                                                <div class="art-vmenublockcontent-tc"></div>
                                                <div class="art-vmenublockcontent-bc"></div>
                                                <div class="art-vmenublockcontent-cl"></div>
                                                <div class="art-vmenublockcontent-cr"></div>
                                                <div class="art-vmenublockcontent-cc"></div>
                                                <div class="art-vmenublockcontent-body">
                                            <!-- block-content -->
                                                            <ul class="art-vmenu">
                                                            	<li>
                                                            		<a href="index.php?page=home"><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
                                                            	</li>
                                                            	<li class="active">
                                                            		<a class="active" href="index.php?page=request&container=all"><span class="l"></span><span class="r"></span><span class="t">Request a track</span></a>
                                                            	</li>
                                                            </ul>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-block">
                                <div class="art-block-body">
                                            <div class="art-blockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t">Listen To Intelliradio</div>
                                            </div>
                                            <div class="art-blockcontent">
                                                <div class="art-blockcontent-tl"></div>
                                                <div class="art-blockcontent-tr"></div>
                                                <div class="art-blockcontent-bl"></div>
                                                <div class="art-blockcontent-br"></div>
                                                <div class="art-blockcontent-tc"></div>
                                                <div class="art-blockcontent-bc"></div>
                                                <div class="art-blockcontent-cl"></div>
                                                <div class="art-blockcontent-cr"></div>
                                                <div class="art-blockcontent-cc"></div>
                                                <div class="art-blockcontent-body">
                                            <!-- block-content --><center>
 	<object id="myMovie" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="150" height="36">
	<?php if ( is_null($_SESSION['iuser']) ) { ?>
	<param name="src" value="rtsp://192.168.1.6/broadcast/default.3gp">
	<?php } else { 
			$user = unserialize($_SESSION['iuser']);
			$container = $user->container;
	
			echo "<param name=\"src\" value=\"rtsp://192.168.1.6/broadcast/".$user->container.".3gp\">";
			
			}
	 ?>
	<param name="console" value="video2">
	<param name="controls" value="ControlPanel">
	<param name="autostart" value="true">
	<param name="loop" value="false">
	<?php if ( is_null($_SESSION['iuser']) ) { ?>
	<embed name="myMovie" src="http://192.168.1.6/ramgen/broadcast/default.3gp?embed" height="36" width="150" autostart="true" loop="false" nojava="true" console="video2" controls="ControlPanel"></embed>
	<?php } else { 
			$user = unserialize($_SESSION['iuser']);
			$container = $user->container;
	
	echo "<embed name=\"myMovie\" src=\"http://192.168.1.6/ramgen/broadcast/".$user->container.".3gp?embed\" height=\"36\" width=\"150\" autostart=\"true\" loop=\"false\" nojava=\"true\" console=\"video2\" controls=\"ControlPanel\"></embed>";
	} ?> 
</object></center> 
<!--<object id="myMovie" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="150" height="36">
	<param name="src" value="rtsp://localhost/broadcast/default.3gp">
	<param name="console" value="video2">
	<param name="controls" value="ControlPanel">
	<param name="autostart" value="true">
	<param name="loop" value="false">
	<embed name="myMovie" src="http://192.168.1.6/ramgen/broadcast/default.3gp?embed" height="36" width="150" autostart="true" loop="false" nojava="true" console="video2" controls="ControlPanel"></embed>
	<noembed><a href="http://realmedia.uic.edu/ramgen/itltv/bbtips.6feb02.smi">Play second clip</a></noembed>
</object></center> -->
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-block">
                                <div class="art-block-body">
                                            <div class="art-blockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t">Containers</div>
                                            </div>
                                            <div class="art-blockcontent">
                                                <div class="art-blockcontent-tl"></div>
                                                <div class="art-blockcontent-tr"></div>
                                                <div class="art-blockcontent-bl"></div>
                                                <div class="art-blockcontent-br"></div>
                                                <div class="art-blockcontent-tc"></div>
                                                <div class="art-blockcontent-bc"></div>
                                                <div class="art-blockcontent-cl"></div>
                                                <div class="art-blockcontent-cr"></div>
                                                <div class="art-blockcontent-cc"></div>
                                                <div class="art-blockcontent-body">
                                            <!-- block-content -->
                                                            <div>
                                                                              <ul>
                                                                              	<li><a href="index.php?page=request&container=all">All</a></li>
                                                                               <li><a href="index.php?page=request&container=rock">Rock</a></li>
                                                                               <li><a href="index.php?page=request&container=classical">Classical</a></li>
                                   
                                                                               </ul>
                                                                              
                                                                                                                                                            </div>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-block">
                                <div class="art-block-body">
                                            <div class="art-blockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t">Contact Info</div>
                                            </div>
                                            <div class="art-blockcontent">
                                                <div class="art-blockcontent-tl"></div>
                                                <div class="art-blockcontent-tr"></div>
                                                <div class="art-blockcontent-bl"></div>
                                                <div class="art-blockcontent-br"></div>
                                                <div class="art-blockcontent-tc"></div>
                                                <div class="art-blockcontent-bc"></div>
                                                <div class="art-blockcontent-cl"></div>
                                                <div class="art-blockcontent-cr"></div>
                                                <div class="art-blockcontent-cc"></div>
                                                <div class="art-blockcontent-body">
                                            <!-- block-content -->
                                                            <div>
                                                                  <img src="images/contact.jpg" alt="an image" style="margin: 0 auto;display:block;width:95%" />
                                                            <br />
                                                            <b>MiDi</b><br />
                                                            University of Moratuwa<br />
                                                            Email: <a href="mailto:info@company.com">intelliradio-midi@googlecode.com</a><br />
                                                            <br />
                                                            Phone: 0779439733<br />
                                                            
                                                            </div>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                        </div>
                        <div class="art-layout-cell art-content">
                            <div class="art-post">
                                <div class="art-post-body">
                            <div class="art-post-inner art-article">
                                            <div class="art-postmetadataheader">
                                                <h2 class="art-postheader">
                                                    <img src="images/postheadericon.png" width="26" height="26" alt="postheadericon" />
                                                    <?php echo 'Welcome!'; ?>
                                                </h2>
                                                <?php if ( $user ) {
                                                	echo '<p>You are currently listening to the '.strtoupper($user->container).' container</p>';
                                                }
                                                ?>
                                            </div>
                                            <div class="art-postcontent">
                                                <?php 
                                                	if ( $_GET['page'] != '' ) {
                                                		$namesAndPages = array('login' 	=> 'login.php',
                                                						   'about' 	=> 'about.php',
                                                						   'fb'    	=> 'fb.php',
                                                						   'home'  	=> 'dummy.php',
                                                						   'logout'	=> 'logout.php',
                                                						   'request'=> 'request.php',
                                                						   'register'=> 'register.php');
                                                		midiInclude($_GET['page'], $namesAndPages);
                                                	}
                                                	
                                                	$user = unserialize($_SESSION['iuser']);
                                                	
                                                	
                                                ?>
                                                
                                                
                                                
                                            <div class="cleared"></div>
                            </div>
                            
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-post">
                                <div class="art-post-body">
                            <!-- <div class="art-post-inner art-article">
                                            <div class="art-postmetadataheader">
                                                <h2 class="art-postheader">
                                                    <img src="images/postheadericon.png" width="26" height="26" alt="postheadericon" />
                                                    Search 
                                                </h2>
                                            </div>
                                            <div class="art-postcontent">-->
                                                
                                                    
                                                <!-- /article-content -->
                                            </div>
                                            <div class="cleared"></div>
                            </div>
                            
                            		<div class="cleared"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cleared"></div><div class="art-footer">
                    <div class="art-footer-t"></div>
                    <div class="art-footer-l"></div>
                    <div class="art-footer-b"></div>
                    <div class="art-footer-r"></div>
                    <div class="art-footer-body">
                         <a href="#" class="art-rss-tag-icon" title="RSS"></a>
                        <div class="art-footer-text">
                            <p><a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a>
                                | <a href="#">Privacy Statement</a><br />
                                Copyright &copy; 2010 MiDi. All Rights Reserved.</p>
                        </div>
                		<div class="cleared"></div>
                    </div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        
    </div>
    
</body>
</html>
