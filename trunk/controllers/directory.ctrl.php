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

# class defines all directory controller functions
class DirectoryController extends Controller{
	
	function showSubmissionPage(  ) {
		
		$this->set('sectionHead', 'Automatic Directory Submission Tool');
		$userId = isLoggedIn();
		
		$websiteController = New WebsiteController();
		$this->set('websiteList', $websiteController->__getAllWebsites($userId));
		$this->set('websiteNull', true);
		$this->set('onChange', "scriptDoLoadPost('directories.php', 'search_form', 'subcontent')");
		
		$this->render('directory/showsubmission');
	}
	
	function __getDirectoryInfo($dirId){
		$sql = "select * from directories where id=$dirId";
		$listInfo = $this->db->select($sql, true);
		return empty($listInfo['id']) ? false :  $listInfo;
	}
	
	function showWebsiteSubmissionPage($submitInfo, $error=false) {
		if(empty($submitInfo['website_id'])) {
			echo "<script>scriptDoLoad('directories.php', 'content');</script>";
			return;
		}
		
		if(empty($error)){
			$websiteController = New WebsiteController();
			$websiteInfo = $websiteController->__getWebsiteInfo($submitInfo['website_id']);
			$websiteInfo['website_id'] = $submitInfo['website_id'];
		}else{
			$websiteInfo = $submitInfo;
		}
		$this->set('websiteInfo', $websiteInfo);
		
		$this->render('directory/showsitesubmission');
	}
	
	function saveSubmissiondata( $submitInfo ) {
		
		if(empty($submitInfo['website_id'])) {
			echo "<script>scriptDoLoad('directories.php', 'content');</script>";
			return;
		}
		
		$_SESSION['skipped'][$submitInfo['website_id']] = array();
		
		$errMsg['url'] = formatErrorMsg($this->validate->checkBlank($submitInfo['url']));
		$errMsg['owner_name'] = formatErrorMsg($this->validate->checkBlank($submitInfo['owner_name']));
		$errMsg['category'] = formatErrorMsg($this->validate->checkBlank($submitInfo['category']));
		$errMsg['title'] = formatErrorMsg($this->validate->checkBlank($submitInfo['title']));
		$errMsg['description'] = formatErrorMsg($this->validate->checkBlank($submitInfo['description']));
		$errMsg['keywords'] = formatErrorMsg($this->validate->checkBlank($submitInfo['keywords']));
		$errMsg['owner_email'] = formatErrorMsg($this->validate->checkEmail($submitInfo['owner_email']));
		
		# error occurs
		if($this->validate->flagErr){
			$this->set('errMsg', $errMsg);
			$submitInfo['sec'] = '';
			$this->showWebsiteSubmissionPage($submitInfo, true);
			return;
		}
		
		if(!stristr($submitInfo['url'], 'http://')) $submitInfo['url'] = "http://".$submitInfo['url']; 
		
		$sql = "update websites set " .
				"url='{$submitInfo['url']}'," .
				"owner_name='".addslashes($submitInfo['owner_name'])."'," .
				"owner_email='".addslashes($submitInfo['owner_email'])."'," .
				"category='".addslashes($submitInfo['category'])."'," .
				"title='".addslashes($submitInfo['title'])."'," .
				"description='".addslashes($submitInfo['description'])."'," .
				"keywords='".addslashes($submitInfo['keywords'])."' " .
				"where id={$submitInfo['website_id']}";
		$this->db->query($sql);
		
		$this->startSubmission($submitInfo['website_id']);	
					
	}
	
	function startSubmission( $websiteId, $dirId='' ) {
		$sql = "select directory_id from dirsubmitinfo where website_id=$websiteId";
		$list = $this->db->select($sql);
		$dirList = array();
		foreach($list as $listInfo){
			$dirList[] = $listInfo['directory_id'];
		}
		
		if( (count($_SESSION['skipped'][$websiteId]) > 0) && is_array($_SESSION['skipped'][$websiteId])){
			$dirList = array_merge($dirList, array_keys($_SESSION['skipped'][$websiteId]));
		}
		
		$sql = "select * from directories where working=1";
		if(!empty($dirId)) $sql .= " and id=$dirId";
		if(count($dirList) > 0) $sql .= " and id not in (".implode(',', $dirList).")";
		$sql .= " order by id";
		$dirInfo = $this->db->select($sql, true);
		$this->set('dirInfo', $dirInfo);		
				
		if(empty($dirInfo['id'])) return;
		
		$websiteController = New WebsiteController();
		$websiteInfo = $websiteController->__getWebsiteInfo($websiteId);
		$this->set('websiteId', $websiteId);
		
		$spider = new Spider(); 
		$ret = $spider->getContent(addHttpToUrl($dirInfo['submit_url']));
				
		if($ret['error']){
			$this->set('error', 1);
			$this->set('msg', $ret['errmsg']);
		}
		
		$page = $ret['page'];
		$pattern1 = '/<select name="'.$dirInfo['category_col'].'".*?<\/select>/is';
		$pattern2 = '/<select.*?'.$dirInfo['category_col'].'.*?<\/select>/is';
		$pattern3 = '/<select.*?'.$dirInfo['category_col'].'.*<\/select>/is';
		$matched = 0;
		if($matched = preg_match($pattern1, $page, $matches)){
		}elseif($matched = preg_match($pattern2, $page, $matches)){
		}elseif($matched = preg_match($pattern3, $page, $matches)){
		}
					
		if($matched){
			
			$categorysel = $matches[0];
			$catList = explode(',', $websiteInfo['category']);
			if(count($catList) > 0){
				foreach($catList as $category){
					$category = trim($category);
					$categorysel = preg_replace("/<(option.*?$category.*?)>/si", '<$1 selected>', $categorysel, 1, $count);
					if($count > 0) break;	
				}

				if($count <= 0){
					$categorysel = $matches[0];
				}
			}						
			$this->set('categorySel', $categorysel);
			
			
			$captchaUrl = '';
			if(stristr($page, $dirInfo['captcha_script'])){
				$captchaUrl = $dirInfo['captcha_script'];
			}
			
			$imageHash = "";
			if(preg_match('/name="'.$dirInfo['imagehash_col'].'".*?value="(.*?)"/is', $page, $hashMatch)){
				$imageHash = $hashMatch[1];
			}
			$this->set('imageHash', $imageHash);
			
			if(!empty($captchaUrl)){
				$captchaUrl = preg_replace('/^\//', '', $captchaUrl);				
				$dirInfo['domain'] = addHttpToUrl($dirInfo['domain']);
				if(preg_match('/\/$/', $dirInfo['domain'])){
					$captchaUrl = $dirInfo['domain']. $captchaUrl;
				}else 
					$captchaUrl =  $dirInfo['domain']."/". $captchaUrl;				
				
				if(!stristr($captchaUrl, '?')){
					if(!empty($imageHash)) {
						$captchaUrl .= "?".$dirInfo['imagehashurl_col']."=".$imageHash; 
					}else $captchaUrl .= "?rand=".rand(1,1000);	
				}else{					
					if(!empty($imageHash)) {
						$captchaUrl .= "&".$dirInfo['imagehashurl_col']."=".$imageHash; 
					}else $captchaUrl .= "&rand=".rand(1,1000); 
				}				
			}
			$this->set('captchaUrl', $captchaUrl);			
		}else{			
			$this->set('error', 1);
			$this->set('msg', 'The submission category not found in submission page. Please click on "Reload" or "Skip"');			
		}
		
		$this->render('directory/showsubmissionform');				
	}
	
	function submitSite( $submitInfo ) {
				
		$dirInfo = $this->__getDirectoryInfo($submitInfo['dir_id']);
		
		$websiteController = New WebsiteController();
		$websiteInfo = $websiteController->__getWebsiteInfo($submitInfo['website_id']);
		
		$postData = $dirInfo['title_col']."=".$websiteInfo['title'];
		$postData .= "&".$dirInfo['url_col']."=".$websiteInfo['url'];
		$postData .= "&".$dirInfo['description_col']."=".$websiteInfo['description'];
		$postData .= "&".$dirInfo['name_col']."=".$websiteInfo['owner_name'];
		$postData .= "&".$dirInfo['email_col']."=".$websiteInfo['owner_email'];
		$postData .= "&".$dirInfo['category_col']."=".$submitInfo[$dirInfo['category_col']];
		$postData .= "&".$dirInfo['cptcha_col']."=".$submitInfo[$dirInfo['cptcha_col']];
		if(!empty($submitInfo[$dirInfo['imagehash_col']])){
			$postData .= "&".$dirInfo['imagehash_col']."=".$submitInfo[$dirInfo['imagehash_col']];
		}
		$postData .= "&".$dirInfo['extra_val'];
		
		$spider = new Spider(); 
		$spider->_CURLOPT_POSTFIELDS = $postData;
		$ret = $spider->getContent($dirInfo['submit_url']);
		
		if($ret['error']){
			$this->set('error', 1);
			$this->set('msg', $ret['errmsg']);
		}else{
			$page = $ret['page'];		
			if(preg_match('/<td.*?class="msg".*?>(.*?)<\/td>/is', $page, $matches)){
				$this->set('msg', $matches[1]);
				$status = 1;
			}else{
				$status = 0;
				$this->set('msg', "Didn't get success message, Please check your mail to find the confirm message");
			}
			
			$sql = "select id from dirsubmitinfo where website_id={$submitInfo['website_id']} and directory_id={$submitInfo['dir_id']}";
			$subInfo = $this->db->select($sql);
			if(empty($subInfo[0][id])){
				$sql = "insert into dirsubmitinfo(id,website_id,directory_id,status,submit_time) values('', {$submitInfo['website_id']}, {$submitInfo['dir_id']}, $status,".mktime().")";				
			}else{
				$sql = "update dirsubmitinfo set status=$status,submit_time=".mktime()." where id={$subInfo[0][id]}";
			}
			$this->db->query($sql);			
		}		
		$this->render('directory/showsubmissionstats');
		
		$this->set('error', 0);
		$this->set('msg', '');
		
		$this->startSubmission($submitInfo['website_id']);		
	}
	
	function skipSubmission( $info ) {
		$_SESSION['skipped'][$info['website_id']][$info['dir_id']] = 1;
		$this->startSubmission($info['website_id']);
	}
	
	# func to show submision reports
	function showSubmissionReports($searchInfo=''){
		$this->set('sectionHead', 'Directory Submission Reports');
		$userId = isLoggedIn();
		
		$websiteController = New WebsiteController();
		$websiteList = $websiteController->__getAllWebsites($userId);
		$this->set('websiteList', $websiteList);
		$websiteId = empty ($searchInfo['website_id']) ? $websiteList[0]['id'] : $searchInfo['website_id'];
		$this->set('websiteId', $websiteId);
		$this->set('onChange', "scriptDoLoadPost('directories.php', 'search_form', 'content', '&sec=reports')");		
		
		$conditions = empty ($websiteId) ? "" : " and ds.website_id=$websiteId";
		$conditions .= empty ($searchInfo['active']) ? "" : " and ds.active=".($searchInfo['active']=='pending' ? 0 : 1);		
		$sql = "select ds.* ,d.domain
								from dirsubmitinfo ds,directories d 
								where ds.directory_id=d.id 
								$conditions  
								order by submit_time desc,d.domain";
								
		# pagination setup		
		$this->db->query($sql, true);
		$this->paging->setDivClass('pagingdiv');
		$this->paging->loadPaging($this->db->noRows, 20);
		$pagingDiv = $this->paging->printPages('directories.php?sec=reports', '', 'scriptDoLoad', 'content', 'website_id='.$websiteId.'&active='.$searchInfo['active']);		
		$this->set('pagingDiv', $pagingDiv);
		$sql .= " limit ".$this->paging->start .",". $this->paging->per_page;						
								
		$reportList = $this->db->select($sql);
		
		$this->set('activeVal', $searchInfo['active']);
		$this->set('list', $reportList);
		$this->render('directory/directoryreport');	
	}
	
	function changeConfirmStatus($dirInfo){
		$status = ($dirInfo['confirm']=='Yes') ? 0 : 1;
		$sql = "Update dirsubmitinfo set status=$status where id=".$dirInfo['id'];
		$this->db->query($sql);
	}
	
	function showConfirmStatus($id){
		$sql = "select status from dirsubmitinfo where id=".$id;		
		$statusInfo = $this->db->select($sql, true);
		
		$confirm = empty($statusInfo['status']) ? "No" : "Yes";
        $confirmId = "confirm_".$id;
        $confirmLink = "<a href='javascript:void(0);' onclick=\"scriptDoLoad('directories.php', '$confirmId', 'sec=changeconfirm&id=$id&confirm=$confirm')\">$confirm</a>";
        
        print $confirmLink;
	}
	
	function checkSubmissionStatus($dirInfo){		
		$sql = "select ds.* ,d.domain,d.search_script,w.url
					from dirsubmitinfo ds,directories d,websites w 
					where ds.directory_id=d.id and ds.website_id=w.id 
					and ds.id=". $dirInfo['id'];
		$statusInfo = $this->db->select($sql, true);
		
		$searchUrl = (preg_match('/\/$/', $statusInfo['domain'])) ? $statusInfo['domain'].$statusInfo['search_script'] : $statusInfo['domain']."/".$statusInfo['search_script'];
		$keyword = formatUrl($statusInfo['url']);
		$searchUrl = str_replace('[--keyword--]', urlencode($keyword), $searchUrl);
		
		$ret = $this->spider->getContent($searchUrl);
		if(empty($ret['error'])){
			if(stristr($ret['page'], 'href="'.$statusInfo['url'].'"')){
				return 1;
			}elseif(stristr($ret['page'], "href='".$statusInfo['url']."'")){
				return 1;
			}elseif(stristr($ret['page'], 'href='.$statusInfo['url'])){
				return 1;
			}
		}
		return 0;
	}
	
	function updateSubmissionStatus($dirId, $status){
		$sql = "Update dirsubmitinfo set active=$status where id=".$dirId;
		$this->db->query($sql);
	}
	
	function showSubmissionStatus($id){
		$sql = "select active from dirsubmitinfo where id=".$id;		
		$statusInfo = $this->db->select($sql, true);
        
        print empty($statusInfo['active']) ? "Pending" : "Approved";
	}
	
	function checkSubmissionReports( $searchInfo ) {
		
		$this->set('sectionHead', 'Check Submission Reports');
		$userId = isLoggedIn();
		
		$websiteController = New WebsiteController();
		$this->set('websiteList', $websiteController->__getAllWebsites($userId));
		$this->set('websiteNull', true);
		$this->set('onClick', "scriptDoLoadPost('directories.php', 'search_form', 'subcontent', '&sec=checksub')");
		
		$this->render('directory/checksubmission');
	}
	
	function generateSubmissionReports( $searchInfo ){
		if(empty($searchInfo['website_id'])) {
			echo "<script>scriptDoLoad('directories.php', 'content', 'sec=checksub');</script>";
			return;
		}		
				
		$sql = "select ds.* ,d.domain
								from dirsubmitinfo ds,directories d 
								where ds.directory_id=d.id  
								and ds.website_id={$searchInfo['website_id']} and ds.active=0   
								order by submit_time";
		$reportList = $this->db->select($sql);		
		$this->set('list', $reportList);
		$this->render('directory/generatesubmission');
	}
	
	function deleteSubmissionReports($dirSubId){
		$sql = "delete from dirsubmitinfo where id=$dirSubId";
		$this->db->query($sql);
		
		echo "<script>scriptDoLoadPost('directories.php', 'search_form', 'content', '&sec=reports');</script>";
	}
	
	function showFeaturedSubmission() {
		$this->set('sectionHead', 'Featured Submission');
		
		$this->render('directory/featuredsubmission');
	}
}
?>