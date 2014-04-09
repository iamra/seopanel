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

# class defines all crawl log functions
class CrawlLogController extends Controller {
	
	/**
	 * the name of the crawl logging database tabel
	 */
	var $tablName = "crawl_log";
	
	/**
	 * function to create crawl logs for report generation
	 * @param $crawlInfo 	The array contains all detaisl of crawl
	 */
	function createCrawlLog($crawlInfo) {
		$sql = "INSERT INTO ". $this->tablName ."(".implode(",", array_keys($crawlInfo)).")";
		$sql .= " values ('".implode("','", array_values($crawlInfo))."')";
		$this->db->query($sql);
		$logId = $this->db->getMaxId($this->tablName);
		return $logId;
	}
	
	/**
	 * function to update crawl log
	 * @param int $logId			The id of the crawl log needs to be updated
	 * @param Array $crawlInfo		The array contains crawl log details needs to be updated
	 */
	function updateCrawlLog($logId, $crawlInfo) {
		
		// if log id is not empty
		if (!empty($logId)) {
		
			$sql = "update $this->tablName set ";
			
			// for each through the log values
			foreach($crawlInfo as $key => $value) {
				$sql .= "$key='". addslashes($value) ."',";
			}
			
			$sql = rtrim($sql, ",");
			$sql .= " where id=$logId";
			$this->db->query($sql);
		}
		
	}
	
	
	/**
	 * Function to display crawl log details 
	 * @param Array $info	Contains all search details
	 */
	function listCrawlLog($info = ''){
	
		$userId = isLoggedIn();
		$sql = "select * from $this->tablName where 1=1";
	
		if (isset($info['status'])) {
			if (($info['status']== 'success') || ($info['status']== 'fail')) {
				$statVal = ($info['status']=='success') ? 1 : 0;
				$conditions .= " and crawl_status=$statVal";
				$urlParams .= "&status=".$info['status'];
			}
		} else {
			$info['status'] = '';
		}
		$this->set('statVal', $info['status']);
	
		if (empty($info['keyword'])) {
			$info['keyword'] =  '';
		} else {
			$info['keyword'] = urldecode($info['keyword']);
			$conditions .= " and (ref_id like '%".addslashes($info['keyword'])."%' or subject like '%".addslashes($info['keyword'])."%'
			 or crawl_link like '%".addslashes($info['keyword'])."%' or log_message like '%".addslashes($info['keyword'])."%' )";
			$urlParams .= "&keyword=".urlencode($info['keyword']);
		}
		$this->set('keyword', $info['keyword']);
	
		$sql .= " $conditions order by id";
	
		# pagination setup
		$this->db->query($sql, true);
		$this->paging->setDivClass('pagingdiv');
		$this->paging->loadPaging($this->db->noRows, SP_PAGINGNO);
		$pagingDiv = $this->paging->printPages('proxy.php', '', 'scriptDoLoad', 'content', $urlParams);
		$this->set('pagingDiv', $pagingDiv);
		$sql .= " limit ".$this->paging->start .",". $this->paging->per_page;
	
		$logList = $this->db->select($sql);
		$this->set('pageNo', $info['pageno']);
		$this->set('list', $logList);
		$this->set('urlParams', $urlParams);
		$this->render('log/crawlloglist');
	}
	
}
?>