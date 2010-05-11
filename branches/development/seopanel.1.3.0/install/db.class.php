<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	   		   *
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

# class defines all database functions
class DB{

	var $error = false;   		# error while databse operations
	
	function connectDatabase($dbServer, $dbUser, $dbPassword, $dbName){
		$this->connectionId = @mysql_connect($dbServer, $dbUser, $dbPassword, true);
		if (!$this->connectionId){
			return $this->getError();
		}
		return $this->selectDatabase($dbName);
	}

	# func to select database
	function selectDatabase($dbName){
		$res = @mysql_select_db($dbName, $this->connectionId);
		if(@mysql_errno() != 0){			
			return $this->getError();
		}
	}

	# func to Execute a general mysql query
	function query($query, $noRows=false){
		$res = @mysql_query($query, $this->connectionId);
		if ($res){
			$this->rowsAffected = @mysql_affected_rows($this->connectionId);
			$this->lastInsertId = @mysql_insert_id($this->connectionId);
		}else{
			$this->showError();
			@mysql_free_result($res);
		}
		if($noRows) $this->noRows = mysql_num_rows($res);
		return $res;
	}

	# func to Display the Mysql error
	function getError(){
		if (@mysql_errno() != 0) {			
			$this->error = true;
			$error =  "Mysql Error: " . @mysql_error();
		}
		return $error;
	}
	
	function importDatabaseFile($filename){
		
		# temporary variable, used to store current query
		$tmpline = '';
		
		# read in entire file
		$lines = file($filename);
		
		# loop through each line
		foreach ($lines as $line){
			
			# skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
				continue;
		 
			# add this line to the current segment
			$tmpline .= $line;
			
			# if it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';'){
				
				if(!empty($tmpline)){
					$this->query($tmpline);
				}
				$tmpline = '';
			}
		}
		
	}
}
?>