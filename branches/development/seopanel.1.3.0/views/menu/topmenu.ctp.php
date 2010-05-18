<h3>
	<span id="floatright"> 
		<a href="<?=SP_HELP_LINK?>" target="_blank" title="Seo Panel Help Guide">Help</a> <span class="pipe">|</span>
		<a href="<?=SP_FORUM_LINK?>" target="_blank" title="Seo Panel Forum">Forum</a> <span class="pipe">|</span>
		<?php 
		$userInfo = Session::readSession('userInfo');
		if(empty($userInfo['userId'])){	
		?> 			
			<a href="<?=SP_WEBPATH?>/login.php">Login</a>
		<?php }else{ ?>
			<a href="admin-panel.php?sec=myprofile">My Profile</a> <span class="pipe">|</span>
			<a href="<?=SP_WEBPATH?>/login.php?sec=logout">Logout</a>
		<?php }?>
	</span>
</h3>
