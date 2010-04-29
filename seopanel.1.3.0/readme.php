<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type" />
<title>Seo Panel: ReadMe</title>
<meta name="description" content="Seo Panel Readme file explains steps to install and setup seopanel in your web server." />
<meta name="keywords" content="Install seo panel" />

<link rel="stylesheet" type="text/css" href="css/screen.css" media="all" />
<link rel="shortcut icon" href="images/favicon.ico" />

</head>

<body>
<?php 
if($_GET['error']){
	?>
	<p class="note error" style="height:25px;font-size: 14px;padding:5px;">Database connection failed. Please check the following installation steps and fix the issue.</p>
	<?php
}
?>
<div id='readme'>
<a href="http://www.seopanel.in/" style="padding:0px;" target="_blank"><h1>Seo Panel</h1></a>
<p style="text-align: center;">Version 1.2.0</p>

<h2>Requirements:</h2>
<div class="text">
	<p class="info">1. PHP, MYSQL</p>
	<p class="info">2. CURL enabled with PHP, Refer following link to install curl with php if it is not installed.</p>
	<div class="subtext">
		<p class="info"><a href="http://php.net/manual/en/curl.setup.php">http://php.net/manual/en/curl.setup.php</a></p>
	</div>	
</div>


<h2>Installation: Simple 5 minute installation</h2>
<div class="text">
	   <p class="info">1. <a href="http://www.seopanel.in/download/" target="_blank">Download</a> and Unzip the package.</p>
	   
	   <p class="info">2. Open up config/sp-config.php with a text editor like notepad or similar editor.<br /> 
	   	  &nbsp;&nbsp;&nbsp;&nbsp;Then modify the following sections with your server and database settings.</p>
	   		
	   		<div class="subtext">
	   		<p class="info"># The web path or url to access seo panel through browser.<br />
			define('SP_WEBPATH', 'http://localhost/seopanel');</p>
			
			<p class="info"># DB settings - You can get this info from your web hosting provider.<br />
			# The name of the database for seo panel<br />
			define('DB_NAME', 'seopanel');</p>
			
			<p class="info"># DB database username.<br />
			define('DB_USER', 'root');</p>
			
			<p class="info"># DB database password.<br />
			define('DB_PASSWORD', '');</p>
			
			<p class="info"># DB hostname.<br />
			define('DB_HOST', 'localhost');</p>
	   		</div>
	   
	   <p class="info">3. Save the contents of file config/sp-config.php.</p>
	   
	   <p class="info">4. Upload everything to your document root.</p>
	   
	   <p class="info">5. Chage permission of "tmp" folder of seo panel directory. Your "tmp" directory should be writable.<br /><br/>
   
   	  						&nbsp;&nbsp;&nbsp;&nbsp;In linux/unix  change permission by following command.<br/><br/>
   	  
   	  						&nbsp;&nbsp;&nbsp;&nbsp;chmod -R 777 tmp</p>
	   
	   <p class="info">6. Open index.php in your browser. This should setup the tables needed for seo panel. If there is an error, double check your config/sp-config.php file, &nbsp;&nbsp;&nbsp;&nbsp;and try again. If it fails again, please go to the support or help forums in next section or take "<B>readme.php</B>" in your browser.</p>
	   
	   <p class="info">7. Please use following login details to access Admin and User Section.</p>
	   
	   <p class="info" style="padding-left:10px;"><b>Admin Section:</b><br /><br/>
	   			&nbsp;&nbsp;Username: spadmin<br />
	   			&nbsp;&nbsp;Password: spadmin</p>
	   		
	   <p class="info"><b>Note:</b> Please change password of admin section from 'My Account' link on right top of seo panel, after first login to prevent from security threats.</p>  
	
</div>
<h2>Online Seo Panel Resources:</h2>
<div class="text">

<p class="info">1. <a href="http://help.seopanel.in/">Seo Panel Help Guide and Forum</a></p>

<p class="info">2. <a href="http://www.seopanel.in/support/">Seo Panel Support</a></p>

<p class="info">3. <a href="http://www.seopanel.in/download/">Download Seo Panel</a></p>

<p class="info">4. <a href="http://www.seopanel.in/donate/">Donate for Seo Panel</a></p>

<p class="info">5. <a href="http://www.seopanel.in/contact/">Seo Panel Contact Form</a></p><br></br>

<h2>Developed By Geo Varghese (<a href="http://www.seopanel.in">www.seopanel.in</a>)</h2>
	
</div>
</div>
<div id="footer">
<div>&#169; Copyright 2010-2020	www.seopanel.in. All rights reserved.</div>
<div>
	<a href="http://www.seopanel.in/" target="_blank">SEO PANEL</a> | 
	<a href="http://support.seopanel.in/" target="_blank">SEO PANEL SUPPORT</a> |
	<a href="http://www.seopanel.in/seo-tools/" target="_blank">SEO TOOLS</a> | 
	<a href="http://www.seopanel.in/seo-tutorials/" target="_blank">SEO TUTORIALS</a> | 
	<a href="http://www.seopanel.in/seo-news/" target="_blank">SEO NEWS</a> | 
	<a href="http://www.seopanel.in//contact/" target="_blank">CONTACT US</a> |  
	<a href="http://www.gethostingplans.com/" target="_blank">WEB HOSTING PLANS</a> | 
	<a href="http://directory.seopanel.in/" target="_blank">SEO FREE DIRECTORY</a>
</div>
</div>
</body>
</html>
