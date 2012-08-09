<?php echo showSectionHead($spTextTools['Featured Submission']); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>				
		<th><?=$spText['common']['Directory']?>: </th>
		<td>
			<select name="dir_id" id="dir_id" style="width:150px;" onchange="doLoad('dir_id', 'directories.php?sec=featured', 'content')">
            	<?php foreach($dirList as $dirInfo){?>
            		<?php if($dirInfo['id'] == $selDirId){?>
            			<option value="<?=$dirInfo['id']?>" selected><?=$dirInfo['directory_name']?></option>
            		<?php }else{?>
            			<option value="<?=$dirInfo['id']?>"><?=$dirInfo['directory_name']?></option>
            		<?php }?>
            	<?php }?>
            </select>
		</td>
		<?php if (!empty($selDirInfo['coupon_code'])) { ?>
    		<th><?=$spTextDir['Coupon Code']?>:</th>
    		<td style="color: red;"><?php echo $selDirInfo['coupon_code'] ? $selDirInfo['coupon_code'] : "&nbsp;"; ?></td>
		<?php } ?>				
		<th><?=$spText['common']['Google Pagerank']?>: </th>
		<td style="width: 35%;"><?=$selDirInfo['google_pagerank']?></td>
	</tr>
	
	<?php if (!empty($selDirInfo['coupon_code'])) { ?>
		<tr>
			<td colspan="6">
				<p class='note success'><?php echo str_replace('[REDUCTION_PER]', "<b>".$selDirInfo['coupon_offer']."%</b>", $spTextDir['couponcodenote']); ?></p>
			</td>
		</tr>
	<?php }?>
	
</table>

<div id='subcontent'>
	<iframe id="featured" src="<?=$selDirInfo['directory_link']?>" frameborder="0" width='980px' height="980px"></iframe>
</div>