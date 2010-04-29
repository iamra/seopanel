<?php echo showSectionHead($sectionHead); ?>
<? if(!empty($msg)){
	?>
	<p class="dirmsg">
		<font class="success"><?=$msg?></font>
	</p>
	<? 
	}
?>
<form id="newWebsite">
<input type="hidden" name="sec" value="create"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="left" width='20%'>New Website</td>
		<td class="right">&nbsp;</td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col">Name:</td>
		<td class="td_right_col"><input type="text" name="name" value="<?=$post['name']?>"><?=$errMsg['name']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col">Url:</td>
		<td class="td_right_col"><input type="text" name="url" value="<?=$post['url']?>" style="width:300px;"><?=$errMsg['url']?></td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col">Title:</td>
		<td class="td_right_col"><input type="text" name="title" value="<?=$post['title']?>" style="width:400px;"><?=$errMsg['title']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col">Description:</td>
		<td class="td_right_col"><textarea name="description"><?=$post['description']?></textarea><?=$errMsg['description']?></td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col">Keywords:</td>
		<td class="td_right_col"><textarea name="keywords"><?=$post['keywords']?></textarea><?=$errMsg['keywords']?></td>
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
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="actionSec">
	<tr>
    	<td style="padding-top: 6px;text-align:right;">
    		<a onclick="scriptDoLoad('websites.php', 'content')" href="javascript:void(0);">
         		<img border="0" alt="" src="<?=SP_IMGPATH?>/cancel.gif"/>
         	</a>
         	<a onclick="scriptDoLoadPost('websites.php', 'newWebsite', 'content')" href="javascript:void(0);">
         		<img border="0" alt="" src="<?=SP_IMGPATH?>/proceed.gif"/>
         	</a>
    	</td>
	</tr>
</table>
</form>