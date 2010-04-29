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

# func to format error message
function formatErrorMsg($msg, $class='error'){
	if(!empty($msg)){
		$msg = "<font class='$class'> * $msg</font>";
	}
	return $msg;
}

# func to redirect url
function redirectUrl($url) {
	header("Location: $url");
	exit;
}

# func to redirect url
function redirectUrlByScript($url) {
	print "<script>window.location='$url';</script>";
	exit;
}

# func to show no results
function showNoRecordsList($colspan, $msg='No Records Found!') {
	$data['colspan'] = $colspan;
	$data['msg'] = $msg;
	return View::fetchViewFile('common/norecords', $data);
}

# func to show no results
function showSectionHead($sectionHead) {
	$data['sectionHead'] = $sectionHead;
	return View::fetchViewFile('common/sectionHead', $data);
}

# function to check whether user logged in
function checkLoggedIn() {
	$userInfo = Session::readSession('userInfo');
	if(empty($userInfo['userId'])){
		redirectUrlByScript(SP_WEBPATH."/login.php");
	}
}

# function to check whether admin logged in
function checkAdminLoggedIn() {
	$userInfo = Session::readSession('userInfo');
	if(empty($userInfo['userType']) || ($userInfo['userType'] != 'admin') ) {
		redirectUrlByScript(SP_WEBPATH."/login.php");
	}
}

# function to user is admin or not
function isAdmin() {
	$userInfo = Session::readSession('userInfo');
	return ($userInfo['userType'] == 'admin') ? $userInfo['userId'] : false;
}

# function to user logged in or not
function isLoggedIn() {
	$userInfo = Session::readSession('userInfo');
	return empty($userInfo['userId']) ? false : $userInfo['userId'];
}

# get functions
function scriptGetAJAXLink($file, $area, $args='', $trigger='OnClick'){
	$link = ' '.$trigger.'="scriptDoLoad('."'$file', '$area', '$args')".'"';
	return $link;
}

function confirmScriptAJAXLink($file,$area,$trigger='OnClick'){
	$link = ' '.$trigger.'="confirmLoad('."'$file', '$area', '$args')".'"';
	return $link;
}

function scriptAJAXLinkHref($file, $area, $args='', $linkText='Click', $class='', $trigger='OnClick'){
	$link = ' '.$trigger.'="scriptDoLoad('."'$file', '$area', '$args')".'"';
	$link = "<a href='javascript:void(0);'class='$class' $link>$linkText</a>";
	return $link;
}

function confirmScriptAJAXLinkHref($file, $area, $args='', $linkText='Click', $trigger='OnClick'){
	$link = ' '.$trigger.'="confirmLoad('."'$file', '$area', '$args')".'"';
	$link = "<a href='javascript:void(0);'class='$class' $link>$linkText</a>";
	return $link;
}


#post functions
function scriptPostAJAXLink($file, $form, $area, $trigger='OnClick'){
	$link = ' '.$trigger.'="scriptDoLoadPost('."'$file', '$form', '$area')".'"';
	return $link;
}

function confirmPostAJAXLink($file, $form, $area, $trigger='OnClick'){
	$link = ' '.$trigger.'="confirmSubmit('."'$file', '$form', '$area')".'"';
	return $link;
}

function formatUrl( $url ) {
	$url = str_replace('http://', '', $url);
	$url = str_replace('https://', '', $url);
	$url = str_replace('www.', '', $url);
	return $url;
}

function addHttpToUrl($url){
	if(!stristr($url, 'http://') && !stristr($url, 'https://')){
		$url = 'http://'.$url;
	}
	$url = strtolower($url);
	return $url;
}

function formatFileName( $fileName ) {
	$search = array(' ');
	$replace = array('_');
	$fileName = str_replace($search, $replace, $fileName);
	return $fileName;
}

function showActionLog($msg, $area='subcontent'){
	echo "<script type='text/javascript'>updateArea('$area', '$msg')</script>";
}

function loadGif ($imgname){
	$im = @imagecreatefromgif ($imgname);
	if (!$im) {
		$im = imagecreatetruecolor (150, 30);
		$bgc = imagecolorallocate ($im, 255, 255, 255);
		$tc = imagecolorallocate ($im, 0, 0, 0);
		imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);
		imagestring ($im, 1, 5, 5, "Error loading $imgname", $tc);
	}
	return $im;
}

# func to check whether logged in user having website
function isHavingWebsite() {
	$userId = isLoggedIn();
	$websiteCtrl = New WebsiteController();
	$count = $websiteCtrl->__getCountAllWebsites($userId);
	if($count<=0){
		redirectUrl(SP_WEBPATH."/admin-panel.php?sec=newweb");
	}
}

# function to create plugin ajax get method
function pluginGETMethod($args='', $area='content'){
	$script = "seo-plugins.php?pid=".PLUGIN_ID;	
	$request = "scriptDoLoad('$script', '$area', '$args')";
	return $request;
}

# function to create plugin ajax post method
function pluginPOSTMethod($formName, $area='content', $args=''){
	$args = "&pid=".PLUGIN_ID."&$args";
	$request = "scriptDoLoadPost('seo-plugins.php', '$formName', '$area', '$args')";
	return $request;
}

# func to create plugin menu
function pluginMenu($args='', $area='content') {
	$pluginId = Session::readSession('plugin_id');
	$script = "seo-plugins.php?pid=".$pluginId;	
	$request = "scriptDoLoad('$script', '$area', '$args')";
	return $request;
}
?>