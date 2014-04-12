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
		<td><?=$spText['label']['Updated']?></td>
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
            $logLink = scriptAJAXLinkHrefDialog('log.php', 'content', "sec=crawl_log_details&id=".$listInfo['id'], $listInfo['id']);
            
            // crawl log is for keyword
            if ($listInfo['crawl_type'] == 'keyword') {
				
				// if ref is is integer find keyword name
				if (!empty($listInfo['keyword'])) {
					$listInfo['ref_id'] = $listInfo['keyword'];
				}
				
				// find search engine info
				if (preg_match("/^\d+$/", $listInfo['subject'])) {
					$seCtrler = new SearchEngineController();
					$seInfo = $seCtrler->__getsearchEngineInfo($listInfo['subject']);
					$listInfo['subject'] = $seInfo['domain'];
				}

			}
            
			?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?>"><input type="checkbox" name="ids[]" value="<?=$listInfo['id']?>"></td>
				<td class="td_br_right"><?=$logLink?></td>
				<td class="td_br_right left"><?=$listInfo['crawl_type']?></td>
				<td class="td_br_right left"><?=$listInfo['ref_id']?></td>
				<td class="td_br_right left"><?=$listInfo['subject']?></td>
				<td class="td_br_right left"><?=$listInfo['log_message']?></td>
				<td class="td_br_right">
					<?php 
					if ($listInfo['crawl_status']) {
						echo "<b class='success'>{$spText['label']['Success']}</b>";
					} else {
						echo "<b class='error'>{$spText['label']['Fail']}</b>";
					}
					?>
				</td>
				<td class="td_br_right"><?=$listInfo['crawl_time']?></td>
				<td class="<?=$rightBotClass?>" width="100px">
					<select name="action" id="action<?=$listInfo['id']?>" onchange="doAction('log.php', 'content', 'id=<?=$listInfo['id']?>&pageno=<?=$pageNo?><?=$urlParams?>', 'action<?=$listInfo['id']?>')">
						<option value="select">-- <?=$spText['common']['Select']?> --</option>
						<option value="delete_crawl_log"><?=$spText['common']['Delete']?></option>
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
