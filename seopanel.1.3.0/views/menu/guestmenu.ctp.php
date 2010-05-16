<?php
	$homeClass = "";
	$supportClass = "";
	$loginClass = "";
	switch($this->menu){
		case "support":
			$supportClass = "current";
			break;
			
		case "login":
			$loginClass = "current";
			break;
			
		case "home":
		default:
			$homeClass = "current";
			break;
	} 
?>
<li><a class="<?=$homeClass?>" href="<?=SP_WEBPATH?>/">Seo Panel</a></li>
<li><a class="" href="<?=SP_WEBPATH?>/seo-tools.php">Seo Tools</a></li>
<li><a class="" href="<?=SP_WEBPATH?>/seo-plugins.php">Seo Plugins</a></li>
<li><a class="<?=$supportClass?>" href="<?=SP_WEBPATH?>/support.php">Support</a></li>

<li style="float: right; margin-right: 30px;"><a class="<?=$loginClass?>" href="<?=SP_WEBPATH?>/login.php">My Account</a></li>
