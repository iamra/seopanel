<script>
	var menuList = new Array();
	var buttonList = new Array();
	var scriptList = new Array();	
</script>
<ul id="menu">
<?php 
foreach($menuList as $i => $menuInfo){
	if($menuSelected == $menuInfo['url_section']){
			$imgSrc = "hide";
			$style = "";
	}else{
		$imgSrc = "more";
		$style = 'none';
	}
	$button = "img".$menuInfo['id'];
	$subMenuId = "sub".$menuInfo['id'];
	?>
	<script type="text/javascript">
		menuList[<?=$i?>] = '<?=$subMenuId?>';
		buttonList[<?=$i?>] = '<?=$button?>';
	</script>
	<li class="tab">
		<a href='javascript:void(0);' onclick="showMenu('<?=$button?>','<?=$subMenuId?>')"><img id="<?=$button?>" src="<?=SP_IMGPATH."/".$imgSrc?>.gif"> <?=$menuInfo['name']?></a>
	</li>
	<li id="<?=$subMenuId?>" class="subtab" style="display:<?=$style?>;padding-left:0px;">
	<?php
	switch($menuInfo['url_section']){
		case "keyword-position-checker":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'reports.php?sec=kwchecker';</script>
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('reports.php?sec=kwchecker', 'content')">Quick Rank Checker</a></li>				
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('keywords.php', 'content')">Keywords Manager</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('reports.php?sec=reportsum', 'content')">Report Summary</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('reports.php', 'content')">Simple Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('graphical-reports.php', 'content')">Graphical Reports</a></li>				
	         	<?php if(SP_DEMO){?>
	         		<li><a href="javascript:void(0);" onclick="alertDemoMsg();">Generate Reports</a></li>
	         	<?php }else{?>
					<li><a href="javascript:void(0);" onclick="scriptDoLoad('generate-reports.php', 'content')">Generate Reports</a></li>
	         	<?php }?>
			</ul>
			<?php
			break;
			
		case "sitemap-generator":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'sitemap.php';</script>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('sitemap.php', 'content')">Google Sitemap Generator</a></li>
			</ul>
			<?php
			break;
			
		case "rank-checker":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'rank.php?sec=google';</script>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=google', 'content')">Google Pagerank</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=alexa', 'content')">Alexa Rank</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=reports', 'content')">Rank Reports</a></li>
				<?php if(SP_DEMO){?>
	         		<li><a href="javascript:void(0);" onclick="alertDemoMsg();">Generate Reports</a></li>
	         	<?php }else{?>
					<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=generate', 'content')">Generate Reports</a></li>
	         	<?php }?>
			</ul>
			<?php
			break;
			
		case "backlink-checker":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'backlinks.php';</script>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php', 'content')">Backlinks Checker</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php?sec=reports', 'content')">Backlinks Reports</a></li>
				<?php if(SP_DEMO){?>
	         		<li><a href="javascript:void(0);" onclick="alertDemoMsg();">Generate Reports</a></li>
	         	<?php }else{?>
					<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php?sec=generate', 'content')">Generate Reports</a></li>
	         	<?php }?>
			</ul>
			<?php
			break;
			
		case "directory-submission":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'directories.php';</script>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php', 'content')">Automatic Submission</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=featured', 'content')">Featured Submission</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=reports', 'content')">Submission Reports</a></li>
				<?php if(SP_DEMO){?>
	         		<li><a href="javascript:void(0);" onclick="alertDemoMsg();">Check Submission</a></li>
	         	<?php }else{?>	         		
					<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=checksub', 'content')">Check Submission</a></li>
	         	<?php }?>
			</ul>
			<?php
			break;			
			
		case "saturation-checker":
			?>
			<script type="text/javascript">scriptList[<?=$i?>] = 'saturationchecker.php';</script>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('saturationchecker.php', 'content')">Saturation Checker</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('saturationchecker.php?sec=reports', 'content')">Saturation Reports</a></li>				
				<?php if(SP_DEMO){?>
	         		<li><a href="javascript:void(0);" onclick="alertDemoMsg();">Generate Reports</a></li>
	         	<?php }else{?>
	         		<li><a href="javascript:void(0);" onclick="scriptDoLoad('saturationchecker.php?sec=generate', 'content')">Generate Reports</a></li>
	         	<?php }?>
			</ul>
			<?php
			break;
	}
	?>
	</li>
	<?php
}
?>
</ul>