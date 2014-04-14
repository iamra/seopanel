<?php 
echo showSectionHead($spTextPanel["Proxy Perfomance"]);
$searchFun = "scriptDoLoadPost('proxy.php', 'listform', 'content')";
?>
<form name="listform" id="listform" onsubmit="<?=$searchFun?>">
<input type="hidden" name="sec" value="perfomance">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>
		<th><?=$spText['button']['Search']?>: </th>
		<td><input type="text" name="keyword" value="<?=$keyword?>" onblur="<?=$searchFun?>"></td>
		<th><?=$spText['common']['Period']?>:</th>
    	<td width="236px">
    		<input type="text" style="width: 80px;margin-right:0px;" value="<?=$fromTime?>" name="from_time"/> 
    		<img align="bottom" onclick="displayDatePicker('from_time', false, 'ymd', '-');" src="<?=SP_IMGPATH?>/cal.gif"/> 
    		<input type="text" style="width: 80px;margin-right:0px;" value="<?=$toTime?>" name="to_time"/> 
    		<img align="bottom" onclick="displayDatePicker('to_time', false, 'ymd', '-');" src="<?=SP_IMGPATH?>/cal.gif"/>
    	</td>
		<th><?=$spText['label']['Order By']?>: </th>
		<td>
			<select name="status" onchange="<?=$searchFun?>">
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
		<td width="80px"><?=$spText['label']['Proxy']?></td>
		<td><?=$spText['label']['Count']?></td>
		<td><?=$spText['label']['Success']?></td>
		<td class="right"><?=$spText['label']['Fail']?></td>
	</tr>
	<?php
	$colCount = 5; 
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
            $logLink = scriptAJAXLinkHrefDialog('log.php', 'content', "sec=crawl_log_details&id=".$listInfo['id'], $listInfo['proxy'].":".$listInfo['port']);
            ?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?>"><input type="checkbox" name="ids[]" value="<?=$listInfo['id']?>"></td>
				<td class="td_br_right left"><?=$logLink?></td>
				<td class="td_br_right left"><?=$listInfo['count']?></td>
				<td class="td_br_right left"><?=$listInfo['success']?></td>
				<td class="<?=$rightBotClass?>"><?=$listInfo['fail']?></td>
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
    $delFun = "confirmSubmit('log.php', 'listform', 'content', '&sec=delete_all_crawl_log&pageno=$pageNo')";
    $clearAllFun = "confirmLoad('log.php', 'content', '&sec=clear_all_log')";
}   
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="actionSec">
	<tr>
    	<td style="padding-top: 6px;">
         	<a onclick="<?=$delFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spText['common']['Delete']?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?=$clearAllFun?>" href="javascript:void(0);" class="actionbut">
         		<?=$spTextLog['Clear All Logs']?>
         	</a>
    	</td>
	</tr>
</table>
</form>
