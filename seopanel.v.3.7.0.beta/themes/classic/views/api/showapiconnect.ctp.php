<?php 
echo showSectionHead($spTextPanel['API Connection']);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="left" width='30%'><?=$spTextPanel['API Connection']?></td>
		<td class="right">&nbsp;</td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col"><?=$spTextAPI['API Url']?>:</td>
		<td class="td_right_col"><?=$apiInfo['api_url']?></td>
	</tr>
	<tr class="blue_row">
		<td class="td_left_col"><?=$spTextSettings['SP_API_KEY']?>:</td>
		<td class="td_right_col"><?=$apiInfo['SP_API_KEY']?></td>
	</tr>
	<tr class="white_row">
		<td class="td_left_col"><?=$spTextSettings['API_SECRET']?>:</td>
		<td class="td_right_col">
			<div id="api_secret" style="display: none;"><?=$apiInfo['API_SECRET']?></div>
			<a href="javascript:void(0);" onclick="showDiv('api_secret');hideDiv('secret_link');" id='secret_link'>Show</a>
		</td>
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
<br><br>