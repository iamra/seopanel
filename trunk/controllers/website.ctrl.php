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

# class defines all website controller functions
class WebsiteController extends Controller{

	# func to show websites
	function listWebsites(){		
		$this->set('sectionHead', 'Websites Manager');
		$userId = isLoggedIn();
		$sql = "select * from websites where user_id=$userId order by name";

		# pagination setup		
		$this->db->query($sql, true);
		$this->paging->setDivClass('pagingdiv');
		$this->paging->loadPaging($this->db->noRows, SP_PAGINGNO);
		$pagingDiv = $this->paging->printPages('websites.php');		
		$this->set('pagingDiv', $pagingDiv);
		$sql .= " limit ".$this->paging->start .",". $this->paging->per_page;
				
		$websiteList = $this->db->select($sql);		
		$this->set('list', $websiteList);
		$this->render('website/list');
	}

	# func to get all Websites
	function __getAllWebsites($userId=''){
		$sql = "select * from websites where status=1";
		if(!empty($userId)) $sql .= " and user_id=$userId"; 
		$sql .= " order by name";
		$websiteList = $this->db->select($sql);
		return $websiteList;
	}
	
	# func to get all Websites
	function __getCountAllWebsites($userId=''){
		$sql = "select count(*) count from websites where status=1";
		if(!empty($userId)) $sql .= " and user_id=$userId";
		$countInfo = $this->db->select($sql, true);
		$count = empty($countInfo['count']) ? 0 : $countInfo['count']; 
		return $count;
	}
	
	# func to get all Websites having active keywords
	function __getAllWebsitesWithActiveKeywords($userId=''){
		$sql = "select w.* from websites w,keywords k where w.id=k.website_id and w.status=1 and k.status=1";
		if(!empty($userId)) $sql .= " and user_id=$userId"; 
		$sql .= " group by w.id order by w.name";
		$websiteList = $this->db->select($sql);
		return $websiteList;
	}

	# func to change status
	function __changeStatus($websiteId, $status){
		$sql = "update websites set status=$status where id=$websiteId";
		$this->db->query($sql);
		
		$sql = "update keywords set status=$status where website_id=$websiteId";
		$this->db->query($sql);
	}

	# func to change status
	function __deleteWebsite($websiteId){
		$sql = "delete from websites where id=$websiteId";
		$this->db->query($sql);
		
		# delete all keywords under this website
		$sql = "select id from keywords where website_id=$websiteId";
		$keywordList = $this->db->select($sql);
		$keywordCtrler = New KeywordController();
		foreach($keywordList as $keywordInfo){
			$keywordCtrler->__deleteKeyword($keywordInfo['id']);
		}
	}

	function newWebsite($info=''){
		$this->set('sectionHead', 'New Website');
		$userId = isLoggedIn();
		if(!empty($info['check']) && !$this->__getCountAllWebsites($userId)){
			$this->set('msg', 'Please create a website before start to using seo tools and seo plugins.');
		}
		$this->render('website/new');
	}

	function __checkName($name, $userId){
		$sql = "select id from websites where name='$name' and user_id=$userId";
		$listInfo = $this->db->select($sql, true);
		return empty($listInfo['id']) ? false :  $listInfo['id'];
	}

	function createWebsite($listInfo){
		$userId = isLoggedIn();
		$this->set('post', $listInfo);
		$errMsg['name'] = formatErrorMsg($this->validate->checkBlank($listInfo['name']));
		$errMsg['url'] = formatErrorMsg($this->validate->checkBlank($listInfo['url']));
		if(!$this->validate->flagErr){
			if (!$this->__checkName($listInfo['name'], $userId)) {
				$sql = "insert into websites(id,name,url,title,description,keywords,user_id,status)
							values('','{$listInfo['name']}','{$listInfo['url']}','".addslashes($listInfo['title'])."','".addslashes($listInfo['description'])."','".addslashes($listInfo['keywords'])."',$userId,1)";
				$this->db->query($sql);
				$this->listWebsites();
				exit;
			}else{
				$errMsg['name'] = formatErrorMsg('Website already exist!');
			}
		}
		$this->set('errMsg', $errMsg);
		$this->newWebsite();
	}

	function __getWebsiteInfo($websiteId){
		$sql = "select * from websites where id=$websiteId";
		$listInfo = $this->db->select($sql, true);
		return empty($listInfo['id']) ? false :  $listInfo;
	}

	function editWebsite($websiteId, $listInfo=''){		
		$this->set('sectionHead', 'Edit Website');
		if(!empty($websiteId)){
			if(empty($listInfo)){
				$listInfo = $this->__getWebsiteInfo($websiteId);
				$listInfo['oldName'] = $listInfo['name'];
			}
			$listInfo['title'] = stripslashes($listInfo['title']);
			$listInfo['description'] = stripslashes($listInfo['description']);
			$listInfo['keywords'] = stripslashes($listInfo['keywords']);
			$this->set('post', $listInfo);
			$this->render('website/edit');
			exit;
		}
		$this->listWebsites();
	}

	function updateWebsite($listInfo){
		$userId = isLoggedIn();
		$this->set('post', $listInfo);
		$errMsg['name'] = formatErrorMsg($this->validate->checkBlank($listInfo['name']));
		$errMsg['url'] = formatErrorMsg($this->validate->checkBlank($listInfo['url']));
		if(!$this->validate->flagErr){

			if($listInfo['name'] != $listInfo['oldName']){
				if ($this->__checkName($listInfo['name'], $userId)) {
					$errMsg['name'] = formatErrorMsg('Website already exist!');
					$this->validate->flagErr = true;
				}
			}

			if (!$this->validate->flagErr) {
				$sql = "update websites set
						name = '{$listInfo['name']}',
						url = '{$listInfo['url']}',
						title = '".addslashes($listInfo['title'])."',
						description = '".addslashes($listInfo['description'])."',
						keywords = '".addslashes($listInfo['keywords'])."'
						where id={$listInfo['id']}";
				$this->db->query($sql);
				$this->listWebsites();
				exit;
			}
		}
		$this->set('errMsg', $errMsg);
		$this->editWebsite($listInfo['id'], $listInfo);
	}
}
?>