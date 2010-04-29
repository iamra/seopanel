<h3>
	<span id="floatright"> 
		<a href="http://help.seopanel.in/" target="_blank" title="seo panel help">Help</a> <span	class="pipe">|</span>
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
