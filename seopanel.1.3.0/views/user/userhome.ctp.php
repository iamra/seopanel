<div class="Center" style='width:100%;'>
<div class="col" style="">

<div class="SectionHeader">
<h1 style="text-align:center;border: none;">Account Summary</h1>
</div>
<br />

<div class="Block">
	<table width="100%" cellspacing="0" cellpadding="0" class="summary">
		<tr><td class="topheader" colspan="5">Your Account Details</td></tr>
		<tr>
			<td class="subheader" style="border: none;width:30%;">Name</td>
			<td class="subheader">Username</td>
			<td class="subheader" width="30%">Email</td>
			<td class="subheader">Sign Up Date</td>
			<td class="subheader">Account Status</td>
		</tr>
		<tr>
			<td class="content" style="border-left: none;"><?php echo $userInfo['first_name']." ".$userInfo['last_name'];?></td>
			<td class="content"><?php echo $userInfo['username'];?></td>
			<td class="content"><?php echo $userInfo['email'];?></td>
			<td class="content"><?php echo date('M d Y', $userInfo['created']);?></td>
			<td class="content"><?php echo $userInfo['status'] ? "Active" : "Inactive";?></td>
		</tr>		
	</table>
	<br><br>
	<table width="100%" cellspacing="0" cellpadding="0" class="summary">
		<tr><td class="topheader" colspan="10">Your Website Statistics</td></tr>
		<tr>
			<td class="subheader" style="border: none;" width="5%" rowspan="2">#</td>
			<td class="subheader" rowspan="2">Site Name/Url</td>
			<td class="subheaderdark" colspan="2">Ranks</td>
			<td class="subheaderdark" colspan="2">Google</td>
			<td class="subheaderdark" colspan="2">Yahoo</td>
			<td class="subheaderdark" colspan="2">MSN</td>
		</tr>		
		<tr>
			<td class="subheader">Alexa</td>
			<td class="subheader">Google</td>
			<td class="subheader">pages Indexed</td>
			<td class="subheader">Backlinks</td>
			<td class="subheader">pages Indexed</td>
			<td class="subheader">Backlinks</td>
			<td class="subheader">pages Indexed</td>
			<td class="subheader">Backlinks</td>
		</tr>
		<?php if(count($websiteList) > 0){ ?> 
			<?php foreach($websiteList as $websiteInfo){ ?>
				<tr>
					<td class="content" style="border-left: none;"><?php echo $websiteInfo['id']?></td>
					<td class="content">
						<?php echo $websiteInfo['name'];?><br>
						<a href="<?php echo $websiteInfo['url'];?>"><?php echo $websiteInfo['url'];?></a>
					</td>
					<td class="content"><?php echo $websiteInfo['alexarank'];?></td>
					<td class="content"><?php echo $websiteInfo['googlerank'];?></td>
					<td class="content"><?php echo $websiteInfo['google']['indexed'];?></td>
					<td class="content"><?php echo $websiteInfo['google']['backlinks'];?></td>
					<td class="content"><?php echo $websiteInfo['yahoo']['indexed'];?></td>
					<td class="content"><?php echo $websiteInfo['yahoo']['backlinks'];?></td>
					<td class="content"><?php echo $websiteInfo['msn']['indexed'];?></td>
					<td class="content"><?php echo $websiteInfo['msn']['backlinks'];?></td>
				</tr> 
			<?php } ?>
		<?php }else{ ?>
			<tr><td colspan="10" class="norecord">No Websites Found!</td></tr>
		<?php } ?>		
	</table>
</div>



</div>
</div>