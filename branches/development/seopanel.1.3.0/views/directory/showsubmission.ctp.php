<?php echo showSectionHead($sectionHead); ?>
<form id='search_form'>
<table width="75%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>				
		<th>Website: </th>
		<td>
			<?php echo $this->render('website/websiteselectbox', 'ajax'); ?>
		</td>
		<td width="20px"><input type="checkbox" name="no_captcha"></td>
		<th style="text-align: left;" nowrap="nowrap">Directories with out captcha</th>
		<td align='left'>
			<a onclick="scriptDoLoadPost('directories.php', 'search_form', 'subcontent')" href="javascript:void(0);">
         		<img border="0" alt="" src="<?=SP_IMGPATH?>/show_records.gif"/>
         	</a>
         </td>
	</tr>
</table>
</form>
<div id='subcontent'>
	<p class='note'>Select a <b>Website</b> to <b>Proceed</b> directory submission. Check <b>Directories with out captcha</b> to submit to directories with out captcha!</p>
</div>