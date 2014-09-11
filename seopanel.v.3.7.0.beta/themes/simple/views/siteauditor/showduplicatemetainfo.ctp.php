<table  width="98%" border="0" cellspacing="0px" cellpadding="0px" align="center" class="report_head">
	<tr>
		<td align="left" valign="bottom">
			<div><b><?=$spTextSA['Project Url']?></b>: <?=$projectInfo['url']?></div>
			<div style="margin-bottom: 0px;"><b><?=$spText['label']['Updated']?></b>: <?=$projectInfo['last_updated']?></div>
			<div style="margin-bottom: 0px;margin-top: 10px;"><b><?=$spText['label']['Total Results']?></b>: <?=$totalResults?></div>
		</td>

<?php
$borderCollapseVal = "";
$hrefAction = 'href="javascript:void(0)"';
$mainLink = SP_WEBPATH."/siteauditor.php?project_id=$projectId&sec=showreport&report_type=$repType&pageno=$pageNo".$filter;
foreach ($headArr as $col => $val) {
    if( ($col == $repType) || ($col == 'count')) {
        $linkName = $col."Link";
        $linkClass = "";
        if ($col == $orderCol) {
            $oVal = ($orderVal == 'DESC') ? "ASC" : "DESC";
            $linkClass .= "sort_".strtolower($orderVal);
        } else {
            $oVal = $orderVal;
        }
        $$linkName = "<a id='sortLink' class='$linkClass' href='javascript:void(0)' onclick=\"scriptDoLoadPost('siteauditor.php', 'search_form', 'subcontent', '&sec=showreport&order_col=$col&order_val=$oVal')\">$val</a>";
    }
}

if(!empty($pdfVersion) || !empty($printVersion)) {

	// if pdf report to be generated
	if ($pdfVersion) {
		showPdfHeader($spTextTools['Auditor Reports']);
		$borderCollapseVal = "border-collapse: collapse;";
		$hrefAction = "";
	} else {
		showPrintHeader($spTextTools['Auditor Reports']);
	}
    	
} else {    
    ?>	
	<td align="right" valign="bottom">
		<a href="<?=$mainLink?>&doc_type=pdf"><img src="<?=SP_IMGPATH?>/icon_pdf.png"></a> &nbsp;
		<a href="<?=$mainLink?>&doc_type=export"><img src="<?=SP_IMGPATH?>/icoExport.gif"></a> &nbsp;
		<a target="_blank" href="<?=$mainLink?>&doc_type=print"><img src="<?=SP_IMGPATH?>/print_button.gif"></a>
		<?=$pagingDiv?>
	</td>
<?php }?>
	</tr>
</table>
<?php $linkLabel = $repType."Link";?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list" style="<?php echo $borderCollapseVal; ?>">
	<tr class="plainHead">
		<td class="left"><?=$spText['common']['No']?></td>
		<td><?=$$linkLabel?></td>
		<td width="30%"><?=$headArr["page_urls"]?></td>
		<td class="right"><?=$countLink?></td>
	</tr>
	<?php
	$colCount = 4; 
	if(count($list) > 0){
		$catCount = count($list);
		foreach($list as $i => $listInfo){
			$class = ($i % 2) ? "blue_row" : "white_row";
            if( !$i || ($catCount != ($i + 1)) ){
                $leftBotClass = "td_left_border td_br_right";
                $rightBotClass = "td_br_right";
            }
            
            $pageUrls = "";
			foreach($listInfo['page_urls'] as $urlInfo) {
				$pageUrls .= "<a target='_blank' href='{$urlInfo['page_url']}'>{$urlInfo['page_url']}</a><br>";
			}              
            ?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?> left"><?=$i+1?></td>
				<td class="td_br_right left"><?=$listInfo[$repType]?></td>
				<td class="td_br_right left"><?=$pageUrls?></td>
				<td class="<?=$rightBotClass?>"><?=$listInfo['count']?></td>
			</tr>
			<?php
		}
	}else{	 
		echo showNoRecordsList($colCount-2, '', true);		
	} 
	?>
	<tr class="listBot">
		<td class="left" colspan="<?=($colCount-1)?>"></td>
		<td class="right"></td>
	</tr>
</table>
<?php
if(!empty($printVersion) || !empty($pdfVersion)) {
	echo $pdfVersion ? showPdfFooter($spText) : showPrintFooter($spText);
}
?>
