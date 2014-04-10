<?php 
echo showSectionHead($spTextLog['Crawl Log Details']);

// crawl log is for keyword
if ($logInfo['crawl_type'] == 'keyword') {

	// if ref is is integer find keyword name
	if (preg_match("/^\d+$/", $logInfo['ref_id'])) {
		$keywordCtrler = new KeywordController();
		$keyInfo = $keywordCtrler->__getKeywordInfo($logInfo['ref_id']);
		$logInfo['ref_id'] = $keyInfo['name'];
	}

	// find search engine info
	if (preg_match("/^\d+$/", $logInfo['subject'])) {
		$seCtrler = new SearchEngineController();
		$seInfo = $seCtrler->__getsearchEngineInfo($logInfo['subject']);
		$logInfo['subject'] = $seInfo['domain'];
	}

}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="left" width='30%'><?=$spTextLog['Crawl Log Details']?></td>
		<td class="right">&nbsp;</td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col"><?=$spText['label']['Report Type']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_type']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Reference']?>:</td>
		<td class="td_right_col"><?=$logInfo['ref_id']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Subject']?>:</td>
		<td class="td_right_col"><?=$logInfo['subject']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['common']['Url']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_link']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Referer']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_referer']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Cookie']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_cookie']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spTextLog['Post Fields']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_post_fields']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['User agent']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_useragent']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Proxy']?>:</td>
		<td class="td_right_col"><?=$logInfo['proxy_id']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['common']['Details']?>:</td>
		<td class="td_right_col"><?=$logInfo['log_message']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['common']['Status']?>:</td>
		<td class="td_right_col">
			<?php 
			if ($listInfo['crawl_status']) {
				echo "<span class='success'>{$spText['label']['Success']}</span>";
			} else {
				echo "<span class='error'>{$spText['label']['Fail']}</span>";
			}
			?>
		</td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spText['label']['Updated']?>:</td>
		<td class="td_right_col"><?=$logInfo['crawl_time']?></td>
	</tr>
	<tr class="blue_row">
		<td class="tab_left_bot_noborder"></td>
		<td class="tab_right_bot"></td>
	</tr>
	<tr class="listBot">
		<td class="left" colspan="1"></td>
		<td class="right"></td>
	</tr>
</table>