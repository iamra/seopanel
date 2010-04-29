<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seofreetools.net)  	   *
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


	
	# the section for generate reports using system cron job
	include_once("includes/sp-load.php");
	include_once(SP_CTRLPATH."/cron.ctrl.php");
	$controller = New CronController();
	
	include_once(SP_CTRLPATH."/directory.ctrl.php");
	$dirCtrler = New DirectoryController();
	
	$searchInfo = array(
		'working' => 0,
	);	
	$dirList = $dirCtrler->getAllDirectories($searchInfo);
	
	foreach($dirList as $dirInfo){
		$dirInfo['submit_url'] = preg_replace('/submit\.html/', 'submit.php', $dirInfo['submit_url']);
		$sql = "update directories set submit_url='{$dirInfo['submit_url']}' where id={$dirInfo['id']}";
//		exit;
		$dirCtrler->db->query($sql);
//		$dirCtrler->checkDirectoryStatus($dirInfo['id']);
	}
	
//	print_r($dirList);
	

?>