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
	<li class="tab">
		<a href='javascript:void(0);' onclick="showMenu('<?=$button?>','<?=$subMenuId?>')"><img id="<?=$button?>" src="<?=SP_IMGPATH."/".$imgSrc?>.gif"> <?=$menuInfo['name']?></a>
	</li>
	<li id="<?=$subMenuId?>" class="subtab" style="display:<?=$style?>;">
	<?php
	switch($menuInfo['url_section']){
		case "keyword-position-checker":
			?>
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('reports.php?sec=kwchecker', 'content')">Quick Rank Checker</a></li>				
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('keywords.php', 'content')">Keywords Manager</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('reports.php', 'content')">Simple Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('graphical-reports.php', 'content')">Graphical Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('generate-reports.php', 'content')">Generate Reports</a></li>
			</ul>
			<?php
			break;
			
		case "sitemap-generator":
			?>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('sitemap.php', 'content')">Google Sitemap Generator</a></li>
			</ul>
			<?php
			break;
			
		case "rank-checker":
			?>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=google', 'content')">Google Pagerank</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=alexa', 'content')">Alexa Rank</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=reports', 'content')">Rank Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('rank.php?sec=generate', 'content')">Generate Reports</a></li>
			</ul>
			<?php
			break;
			
		case "backlink-checker":
			?>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php', 'content')">Backlinks Checker</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php?sec=reports', 'content')">Backlinks Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('backlinks.php?sec=generate', 'content')">Generate Reports</a></li>
			</ul>
			<?php
			break;
			
		case "directory-submission":
			?>			
			<ul id='subui'>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php', 'content')">Automatic Submission</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=featured', 'content')">Featured Submission</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=reports', 'content')">Submission Reports</a></li>
				<li><a href="javascript:void(0);" onclick="scriptDoLoad('directories.php?sec=checksub', 'content')">Check Submission</a></li>
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