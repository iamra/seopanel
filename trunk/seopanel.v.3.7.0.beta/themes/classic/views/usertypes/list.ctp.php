<form name="listform" id="listform">
<?php echo showSectionHead($spTextPanel['User Type Manager']); ?>
<?=$pagingDiv?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="leftid"><input type="checkbox" id="checkall" onclick="checkList('checkall')"></td>
		<td><?=$spText['common']['Id']?></td>			
		<td><?=$spText['common']['User Type']?></td>
		<td><?=$spText['label']['Description']?></td>
		<td><?=$spText['common']['Keywords Count']?></td>
		<td><?=$spText['common']['Websites Count']?></td>
		<td><?=$spText['common']['Price']?></td>
		<td><?=$spText['common']['Status']?></td>
		<td class="right"><?=$spText['common']['Action']?></td>
	</tr>
	<?php
	$colCount = 9; 
	if(count($list) > 0){
		$catCount = count($list);
		foreach($list as $i => $listInfo){
			$class = ($i % 2) ? "blue_row" : "white_row";
            if($catCount == ($i + 1)){
                $leftBotClass = "tab_left_bot";
                $rightBotClass = "tab_right_bot";
            }else{
                $leftBotClass = "td_left_border td_br_right";
                $rightBotClass = "td_br_right";
            }
            $websiteLink = scriptAJAXLinkHref('user-types-manager.php', 'content', "sec=edit&userTypeId={$listInfo['id']}", "{$listInfo['user_type']}")
			?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?>"><input type="checkbox" name="ids[]" value="<?=$listInfo['id']?>"></td>
				<td class="td_br_right"><?=$listInfo['id']?></td>								
				<td class="td_br_right left"><?=$listInfo['user_type']?></td>		
				<td class="td_br_right left"><?=$listInfo['description']?></td>		
				<td class="td_br_right left"><?=$listInfo['num_keywords']?></td>	
				<td class="td_br_right left"><?=$listInfo['num_websites']?></td>
				<td class="td_br_right left"><?=$listInfo['price']?></td>
				<td class="td_br_right"><?php echo $listInfo['status'] ? $spText['common']["Active"] : $spText['common']["Inactive"];	?></td>
				<td class="<?=$rightBotClass?>" width="100px">
					<?php
						if($listInfo['status']){
							$statVal = "Inactivate";
							$statLabel = $spText['common']["Inactivate"];
						}else{
							$statVal = "Activate";
							$statLabel = $spText['common']["Activate"];
						} 
					?>
					<select name="action" id="action<?=$listInfo['id']?>" onchange="doAction('user-types-manager.php', 'content', 'userTypeId=<?=$listInfo['id']?>', 'action<?=$listInfo['id']?>')">
						<option value="select">-- <?=$spText['common']['Select']?> --</option>
						<option value="<?=$statVal?>"><?=$statLabel?></option>
						<option value="edit"><?=$spText['common']['Edit']?></option>
						<option value="delete"><?=$spText['common']['Delete']?></option>
					</select>
				</td>
			</tr>
			<?php
		}
	}else{	 
		echo showNoRecordsList($colCount-2);		
	} 
	?>
	<tr class="listBot">
		<td class="left" colspan="<?=($colCount-1)?>"></td>
		<td class="right"></td>
	</tr>
</table>
<?php
// Creating the action links
$actFun = "confirmSubmit('user-types-manager.php', 'listform', 'content', '&sec=activateall&pageno=$pageNo')";
$inactFun = "confirmSubmit('user-types-manager.php', 'listform', 'content', '&sec=inactivateall&pageno=$pageNo')";
$delFun = "confirmSubmit('user-types-manager.php', 'listform', 'content', '&sec=deleteall&pageno=$pageNo')";
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="actionSec">
	<tr>
    	<td style="padding-top: 6px;">
         	<a onclick="scriptDoLoad('user-types-manager.php', 'content', 'sec=new')" href="javascript:void(0);" class="actionbut">
         		<?=$spTextPanel['New User Type']?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?=$actFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spText['common']["Activate"]?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?=$inactFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spText['common']["Inactivate"]?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?=$delFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spText['common']['Delete']?>
         	</a>
    	</td>
	</tr>
</table>
</form>