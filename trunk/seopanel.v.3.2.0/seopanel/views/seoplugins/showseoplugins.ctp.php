<div class="Center" style='width:100%;'>
<div class="col">
<div class="Block">
<table width="100%" border="0" cellspacing="0px" cellpadding="0">
	<tr>
		<td valign="top" class="leftmenu">
			<div class="selectmenu">
				<?php include_once(SP_VIEWPATH."/seoplugins/seopluginleftmenu.ctp.php");?>
			</div>
		</td>
		<td width="8px">&nbsp;</td>
		<td id="content" height="340px" valign="top">
			<script type="text/javascript">
				<?php
				// to pass all get arguments to the selected plugin's action function
				$argString = "";
				foreach ($_GET as $name => $value) {
				    if (!in_array($name, array('sec', 'menu_selected'))) {
				        $argString .= "&$name=$value";    
				    }
				} 
				?>
				scriptDoLoad('seo-plugins.php?pid=<?=$menuSelected?><?=$argString?>', 'content', '');
			</script>
		</td>
	</tr>
</table>

</div>
</div>
</div>
