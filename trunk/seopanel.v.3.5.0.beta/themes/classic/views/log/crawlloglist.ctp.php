<form name="listform" id="listform">
<?php 
echo showSectionHead($spTextPanel["Crawl Log Manager"]);
$searchFun = "scriptDoLoadPost('log.php', 'listform', 'content')"; 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>
		<th><?=$spText['common']['Keyword']?>: </th>
		<td><input type="text" name="keyword" value="<?=$keyword?>" onblur="<?=$searchFun?>"></td>
		<th><?=$spText['common']['Status']?>: </th>
		<td>
			<select name="status" onchange="<?=$searchFun?>">
				<option value="">-- <?=$spText['common']['Select']?> --</option>
				<?php				
				$inactCheck = $actCheck = "";
				if ($statVal == 'success') {
				    $actCheck = "selected";
				} elseif($statVal == 'fail') {
				    $inactCheck = "selected";
				}
				?>
				<option value="success" <?=$actCheck?> ><?=$spText['label']["Success"]?></option>
				<option value="fail" <?=$inactCheck?> ><?=$spText['label']["Fail"]?></option>
			</select>
		</td>
		<td>
			<a href="javascript:void(0);" onclick="<?=$searchFun?>" class="actionbut"><?=$spText['button']['Show Records']?></a>
		</td>
	</tr>
</table>
<?=$pagingDiv?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="leftid"><input type="checkbox" id="checkall" onclick="checkList('checkall')"></td>
		<td><?=$spText['common']['Id']?></td>		
		<td><?=$spText['label']['Proxy']?></td>
		<td><?=$spText['label']['Port']?></td>
		<td><?=$spText['common']['Status']?></td>
		<td class="right"><?=$spText['common']['Action']?></td>
	</tr>
	<?php
	$colCount = 7; 
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
            $logLink = scriptAJAXLinkHref('log.php', 'content', "sec=edit&proxyId={$listInfo['id']}", "{$listInfo['proxy']}");
			?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?>"><input type="checkbox" name="ids[]" value="<?=$listInfo['id']?>"></td>
				<td class="td_br_right"><?=$listInfo['id']?></td>
				<td class="td_br_right left"><?=$logLink?></td>
				<td class="td_br_right"><?=$listInfo['port']?></td>
				<td class="td_br_right"><?php echo $listInfo['crawl_status'] ? $spText['label']["Success"] : $spText['label']["Fail"]; ?></td>
				<td class="<?=$rightBotClass?>" width="100px">
					<select name="action" id="action<?=$listInfo['id']?>" onchange="doAction('log.php', 'content', 'proxyId=<?=$listInfo['id']?>&pageno=<?=$pageNo?><?=$urlParams?>', 'action<?=$listInfo['id']?>')">
						<option value="select">-- <?=$spText['common']['Select']?> --</option>
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
if (SP_DEMO) {
    $actFun = $inactFun = $delFun = "alertDemoMsg()";
} else {
    $delFun = "confirmSubmit('log.php', 'listform', 'content', '&sec=deleteall&pageno=$pageNo')";
}   
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="actionSec">
	<tr>
    	<td style="padding-top: 6px;">
         	<a onclick="<?=$delFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spText['common']['Delete']?>
         	</a>
    	</td>
	</tr>
</table>
</form>
