<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	   *
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

# class defines all controller functions
class Controller extends Seopanel{
	var $view;
	var $session;
	var $validate;
	var $db;
	var $spider;
	var $paging;
	var $layout = 'default';

	function Controller(){
		# create database object
		if(!is_object($this->db)){
			include_once(SP_LIBPATH."/database.class.php");
			$dbObj = New Database(DB_ENGINE);
			$this->db = $dbObj->dbConnect();
			
			$this->db->query("show tables", true);
			if($this->db->noRows <= 0){
				# starts installtion of seo panel software
				$this->restoreData();
				
				$installUpdateUrl = "http://www.seopanel.in/installupdate.php?url=".urlencode(SP_WEBPATH)."&ip=".$_SERVER['SERVER_ADDR'];
				$spider = New Spider();
				$spider->getContent($installUpdateUrl);
			}
		}
		
		$this->view = New View();
		$this->session = New Session();
		$this->validate = New Validation();
		$this->spider = New Spider();
		$this->paging = New Paging();
	}
	
	# func to restore data
	function restoreData() {
		$dbFile = SP_DATAPATH."/seopanel.sql";
		$this->db->importDatabaseFile($dbFile);
	}

	# func set variable to ctp
	function set($varName, $varValue){
		$this->data[$varName] = $varValue;
	}

	# normal render function
	function render($viewFile='home', $layout='default'){
		if(empty($layout) || ($layout == 'default')){
			if(!empty($this->layout)){
				$layout = $this->layout;
			}
		}
		$this->view->data = $this->data;
		$this->view->render($viewFile, $layout);
	}
	
	# plugin render function
	function pluginRender($viewFile='home', $layout='default'){
		if(empty($layout) || ($layout == 'default')){
			if(!empty($this->layout)){
				$layout = $this->layout;
			}
		}
		$this->view->data = $this->data;
		$this->view->pluginRender($viewFile, $layout);
	}

}
?>