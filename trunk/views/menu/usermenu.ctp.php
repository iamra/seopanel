<?php
$homeClass = "";
$adminClass = "";
$seoToolsClass = "";
switch($this->menu){
	
	case "support":
		$supportClass = "current";
		break;
		
	case "adminpanel":
		$adminClass = "current";
		break;		
		
	case "seotools":
		$seoToolsClass = "current";
		break;
		
	case "seoplugins":
		$seoPluginsClass = "current";
		break;
		
	case "home":
	default:
		$homeClass = "current";
		break;
} 
?>
<li><a class="<?=$homeClass?>" href="<?=SP_WEBPATH?>/">Seo Panel</a></li>
<li><a class="<?=$seoToolsClass?>" href="<?=SP_WEBPATH?>/seo-tools.php">Seo Tools</a></li>
<li><a class="<?=$seoPluginsClass?>" href="<?=SP_WEBPATH?>/seo-plugins.php?sec=show">Seo Plugins</a></li>
<li><a class="<?=$supportClass?>" href="<?=SP_WEBPATH?>/support.php">Support</a></li>
<li><a href="http://www.seopanel.in/download/" title="download seo panel" target="_blank">Download</a></li>

<li style="float: right; margin-right: 30px;"><a class="<?=$adminClass?>" href="<?=SP_WEBPATH?>/admin-panel.php">User Panel</a></li>
<li style="float: right;"><a title="seo panel contact" href="http://www.seopanel.in/contact/" target="_blank">Contact Us</a></li>
<li style="float: right;"><a title="Donate to seo panel" href="http://www.seopanel.in/donate/" target="_blank">Donate</a></li>