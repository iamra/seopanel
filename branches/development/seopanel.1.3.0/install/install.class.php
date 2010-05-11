<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	           *
 *   sendtogeo@gmail.com   												   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/

class Install {
	
	# func to check requirements
	function checkRequirements($error=false) {
		$phpClass = "green";
		$phpSupport = "Yes";
		$phpVersion = phpversion();
		if(intval($phpVersion) < 6){			
			$phpClass = "green";
			$phpSupport = "Yes";
		}
		$phpSupport .= " ( PHP $phpVersion )";
		
		$mysqlClass = "red";
		$mysqlSupport = "No";
		if(function_exists('mysql_query')){
			$res = mysql_query("select version() as version");
			$resObj = mysql_fetch_object($res);
			$mysqlSupport = "Yes ( MySQL " . $resObj->version ." )";
			$mysqlClass = "green";
		}
		
		$curlClass = "red";
		$curlSupport = "No";
		if(function_exists('curl_version')){
			$version = curl_version();
			$curlSupport = "Yes ( CURL  {$version['version']} )";
			$curlClass = "green";
		}
		
		$shorttagClass = "red";
		$shorttagSupport = "Disabled";
		if(ini_get('short_open_tag')){
			$shorttagSupport = "Enabled";
			$shorttagClass = "green";
		}
		
		$gdClass = "red";
		$gdSupport = "No";
		if(function_exists('gd_info')){
			$version = gd_info();
			$gdSupport = "Yes ( GD  {$version['GD Version']} )";
			$gdClass = "green";
		}
		
		$configClass = "red";
		$configSupport = "Not found";
		$configFile = SP_INSTALL_CONFIG_FILE;
		if(file_exists($configFile)){
			$configSupport = "Found, Unwritable<br><p class='note'><b>Command:</b> chmod 777 config/sp-config.php</p>";
			if(is_writable($configFile)){				
				$configSupport = "Found, Writable";				
				$configClass = "green";
			}			
		}
		
	
		$tmpClass = "red";
		$tmpSupport = "Not found";
		$tmpFile = SP_INSTALL_DIR.'/../tmp';
		if(file_exists($tmpFile)){
			$tmpSupport = "Found, Unwritable<br><p class='note'><b>Command:</b> chmod -R 777 tmp/</p>";
			if(is_writable($tmpFile)){				
				$tmpSupport = "Found, Writable";				
				$tmpClass = "green";
			}			
		}
		$errMsg = $error ? "Please fix the following errors to proceed to next step!" : "";
		?>
		<h1 class="BlockHeader">Welcome to Seo panel Installation</h1>
		<form method="post">
		<table width="100%" cellspacing="8px" cellpadding="0px" class="formtab">
			<tr><th colspan="2" class="header">Installation compatibility</th></tr>
			<tr><td colspan="2" class="error"><?php echo $errMsg;?></td></tr>
			<tr>
				<th>PHP version >= 4.0.0</th>
				<td class="<?php echo $phpClass;?>"><?php echo $phpSupport;?></td>
			</tr>
			<tr>
				<th>MySQL Support</th>
				<td class="<?php echo $mysqlClass;?>"><?php echo $mysqlSupport;?></td>
			</tr>
			<tr>
				<th>CURL Support</th>
				<td class="<?php echo $mysqlClass;?>"><?php echo $curlSupport; ?></td>
			</tr>
			<tr>
				<th>PHP short_open_tag</th>
				<td class="<?php echo $shorttagClass;?>"><?php echo $shorttagSupport; ?></td>
			</tr>
			<tr>
				<th>GD graphics support</th>
				<td class="<?php echo $gdClass;?>"><?php echo $gdSupport; ?></td>
			</tr>
			<tr>
				<th>/config/sp-config.php</th>
				<td class="<?php echo $configClass;?>"><?php echo $configSupport; ?></td>
			</tr>
			<tr>
				<th>/tmp</th>
				<td class="<?php echo $tmpClass;?>"><?php echo $tmpSupport; ?></td>
			</tr>
		</table>
		<input type="hidden" value="<?php echo $phpClass;?>" name="php_support">
		<input type="hidden" value="<?php echo $mysqlClass;?>" name="mysql_support">
		<input type="hidden" value="<?php echo $curlClass;?>" name="curl_support">
		<input type="hidden" value="<?php echo $shorttagClass;?>" name="short_open_tag">
		<input type="hidden" value="<?php echo $configClass;?>" name="config">
		<input type="hidden" value="startinstall" name="sec">
		<input type="submit" value="Proceed to next step" name="submit" class="button">
		</form>
		<?php
	}
	
	# func to start installation
	function startInstallation($info='', $errMsg='') {
		if( ($info['php_support'] == 'red') || ($info['mysql_support'] == 'red') || ($info['curl_support'] == 'red') || ($info['short_open_tag'] == 'red') || ($info['config'] == 'red') ){
			$this->checkRequirements(true);
			return;
		}
		?>
		<h1 class="BlockHeader">Database Settings</h1>
		<form method="post">
		<table width="100%" cellspacing="8px" cellpadding="0px" class="formtab">
			<tr><th colspan="2" class="header">Database configuration</th></tr>
			<tr><td colspan="2" class="error"><?php echo $errMsg;?></td></tr>
			<tr>
				<th>Database type:</th>
				<td>
					<select name="db_engine">
						<option value="mysql">MySQL</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Database server hostname:</th>
				<td><input type="text" name="db_host" value="<?php echo empty($info['db_host']) ? "localhost" : $info['db_host'];?>"></td>
			</tr>
			<tr>
				<th>Database name:</th>
				<td><input type="text" name="db_name" value="<?php echo $info['db_name'];?>"></td>
			</tr>
			<tr>
				<th>Database username:</th>
				<td><input type="text" name="db_user" value="<?php echo $info['db_user'];?>"></td>
			</tr>
			<tr>
				<th>Database password:</th>
				<td><input type="text" name="db_pass" value="<?php echo $info['db_pass'];?>"></td>
			</tr>
		</table>		
		<input type="hidden" value="proceedinstall" name="sec">		
		<input type="submit" value="Proceed to next step" name="submit" class="button">
		</form>
		<?php		
	}
	
	# func to write to config file
	function writeConfigFile($info) {
		
		$handle = fopen(SP_INSTALL_CONFIG_SAMPLE, "r");
		$cfgData = fread($handle, filesize(SP_INSTALL_CONFIG_SAMPLE));
		fclose($handle);
		
		
		$search = array('[SP_WEBPATH]', '[DB_NAME]', '[DB_USER]', '[DB_PASSWORD]', '[DB_HOST]', '[DB_ENGINE]');
		$replace = array($info['web_path'], $info['db_host'], $info['db_user'], $info['db_pass'], $info['db_host'], $info['db_engine'] );
		$cfgData = str_replace($search, $replace, $cfgData);
		
		$handle = fopen(SP_INSTALL_CONFIG_FILE, "w");
		fwrite($handle, $cfgData);
		fclose($handle);
	}
	
	# func to proceed installation
	function proceedInstallation($info) {
		$db = New DB();
		$errMsg = $db->connectDatabase($info['db_host'], $info['db_user'], $info['db_pass'], $info['db_name']);
		if($db->error ){
			$this->startInstallation($info, $errMsg);
			return;
		}
		
		if(!is_writable(SP_INSTALL_CONFIG_FILE)){
			$this->checkRequirements(true);
			return;
		}

		$this->writeConfigFile($info);
		
		exit;
		?>
		<h1 class="BlockHeader">Database Settings</h1>
		<form method="post">
		<table width="100%" cellspacing="8px" cellpadding="0px" class="formtab">
			<tr><th colspan="2" class="header">Database configuration</th></tr>
			<tr><td colspan="2" class="error"><?php echo $errMsg;?></td></tr>
			<tr>
				<th>Database type:</th>
				<td>
					<select name="db_type">
						<option value="mysql">MySQL</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Database server hostname:</th>
				<td><input type="text" name="db_host" value="localhost"></td>
			</tr>
			<tr>
				<th>Database name:</th>
				<td><input type="text" name="db_name" value=""></td>
			</tr>
			<tr>
				<th>Database username:</th>
				<td><input type="text" name="db_user" value=""></td>
			</tr>
			<tr>
				<th>Database password:</th>
				<td><input type="text" name="db_pass" value=""></td>
			</tr>
		</table>		
		<input type="submit" value="Proceed to next step" name="submit" class="button">
		</form>
		<?php		
	}
	
	# func to show default install header
	function showDefaultHeader() {
		?>
		<html>
			<head>
				<title>Seo Panel installation interface</title>
				<meta name="description" content="Seo Panel installation Steps to install seo control panel for managing seo of your sites.">
				<link rel="stylesheet" type="text/css" href="install.css" media="all" />				
			</head>
			<body>
				<div class="installdiv">
		<?php		
	}
	
	# func to show default install footer
	function showDefaultFooter($content='') {
		?>
				</div>
			</body>
		</html>
		<?php		
	}
}
?>