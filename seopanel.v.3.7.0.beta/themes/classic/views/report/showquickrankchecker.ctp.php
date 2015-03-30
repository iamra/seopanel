<table width="100%" border="0" cellspacing="0" cellpadding="2px;" class="list">
	<tr>
	<td width='33%'>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="left"><?php echo $spText['common']['Rank']?></td>
		<td class="right" colspan="2"><?php echo $spText['common']['Details']?></td>
	</tr>
	<?php
	$colCount = 2; 
	if(count($list) > 0){
		$catCount = count($list);
		$i = 0;
		foreach($list as $listInfo){
			
			$class = ($i % 2) ? "blue_row" : "white_row";
            if($catCount == ($i + 1)){
                $leftBotClass = "tab_left_bot";
                $rightBotClass = "tab_right_bot";
            }else{
                $leftBotClass = "td_left_border td_br_right";
                $rightBotClass = "td_br_right";
            }
            $foundStyle = empty($listInfo['found']) ? "" : "background-color: #ffff00;";            
			?>
			<tr class="<?php echo $class?>" style="<?php echo $foundStyle?>">
				<td class="<?php echo $leftBotClass?>" width='100px;'><b><?php echo $listInfo['rank']; ?></b></td>
				<td class='td_br_right' id='seresult' colspan="2">
					<a href='<?php echo $listInfo['url']?>' target='_blank'><? echo stripslashes($listInfo['title']);?></a>
					<p><? echo stripslashes($listInfo['description']);?><p>
					<label><?php echo $listInfo['url']?></label>
				</td>
			</tr>
			<?php
			$i++;
		}
	}else{
		?>				
		<tr class="blue_row">
			<td class="tab_left_bot_noborder"></td>
			<td class="tab_right_bot" colspan="2" style="text-align: left;"><?php echo $spText['common']['No Records Found']?>!</td>
		</tr>
		<?		
	}	
	?>
	<tr class="listBot">
		<td class="left" colspan="<?php echo ($colCount-1)?>"></td>
		<td class="right"></td>
	</tr>
	</table>
	</td>
	</tr>
</table>


<?php 
// check debug request is enabled
if (!empty($requestContent)) {
	?>
	<div style="width: 760px; margin-top: 30px; padding: 14px; height: 900px; overflow: auto; border: 1px solid #B0C2CC;">
		<?php debugVar($requestContent, false); ?>
	</div>
	<?php
}
?>