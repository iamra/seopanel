<div class="Left">
<div class="col">
<div class="Block">
<h1 class="BlockHeader">Login Section</h1>
<br />
<form name="loginForm" method="post" action="<?=SP_WEBPATH?>/login.php">
<input type="hidden" name="sec" value="login">
<table width="60%" cellpadding="0" cellspacing="0" class="actionForm">
	<tr>
		<th>Login:</th>
		<td><input type="text" name="userName" value="<?=$post['userName']?>"><?=$errMsg['userName']?></td>
	</tr>
	<tr>
		<th>Password:</th>
		<td><input type="password" name="password" value=""><?=$errMsg['password']?></td>
	</tr>
	<tr>
		<td colspan="2" class="actionsBox" style="padding-left:79px;">
			<input class="img" style="border:0px;" type="image" src="<?=SP_IMGPATH?>/proceed.gif" name="login"/>
		</td>
	</tr>
</table>
</form>
</div>
</div>
</div>