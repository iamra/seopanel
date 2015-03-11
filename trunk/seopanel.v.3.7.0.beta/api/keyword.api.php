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

/**
 * Class defines all functions for managing keyword API
 * 
 * @author Seo panel
 *
 */
class KeywordAPI extends Seopanel{
	
	/**
	 * the main controller to get details for api
	 * @var Object
	 */
	var $ctrler;
	
	/**
	 * The report controller to get details of keyword reports 
	 * @var Object
	 */
	var $reportCtrler;
	
	/**
	 * The list contains search engine details
	 * @var Array
	 */
	var $seList;
	
	/**
	 * The constructor of API
	 */
	function KeywordAPI() {
		include_once(SP_CTRLPATH . "/keyword.ctrl.php");
		include_once(SP_CTRLPATH . "/report.ctrl.php");
		$this->ctrler = new KeywordController();
		$this->reportCtrler = New ReportController();
		$seController = New SearchEngineController();
		$list = $seController->__getAllSearchEngines();
		$this->seList = array();
		
		// loop through the search engine and assign id as key
		foreach ($list as $listInfo) {
			$this->seList[$listInfo['id']] = $listInfo;
		}
	}
	
	/**
	 * function to get from time
	 * @param Array $info API input details
	 * @return $fromTime	The timestamp of from time
	 */
	function getFromTime($info) {
		
		// if from time is not empty
		if (!empty($info['from_time'])) {
			$fromTime = strtotime($info['from_time'] . ' 00:00:00');
		} else {
			$fromTime = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
		}
		
		return $fromTime;;
	}
	
	/**
	 * function to get to time
	 * @param Array $info API input details
	 * @return $fromTime	The timestamp of to time
	 */
	function getToTime($info) {
		
		// if from time is not empty
		if (!empty($info['to_time'])) {
			$toTime = strtotime($info['to_time'] . ' 00:00:00');
		} else {
			$toTime = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		}
		
		return $toTime;;
	}

	/**
	 * function to get keyword report and format it
	 * @param id $keywordInfo		The information about keyword
	 * @param int $fromTime			The time stamp of from time
	 * @param int $toTime			The time stamp of to time
	 * @return $keywordInfo			The formatted keyword info with position details
	 */
	function getFormattedReport($keywordInfo, $fromTime, $toTime) {
		$positionInfo = $this->reportCtrler->__getKeywordSearchReport($keywordInfo['id'], $fromTime, $toTime, true);
				
		// loop through and add search engine name
		foreach ($positionInfo as $seId => $info) {
			$positionInfo[$seId]['search_engine'] = $this->seList[$seId]['domain'];
			$positionInfo[$seId]['date'] = date('Y-m-d', $toTime);
		}
		
		$keywordInfo['position_info'] = $positionInfo;
		return $keywordInfo; 
	}	
	
	/**
	 * function to get keyword report using keyword id
	 * @param Array $info			The input details to process the api
	 * 		$info['id']  		The id of the keyword	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about keyword reports
	 */
	function getReportById($info) {
		
		$fromTime = $this->getFromTime($info);
		$toTime = $this->getToTime($info);
		$keywordInfo = $this->ctrler->__getKeywordInfo($info['id']);
		$positionInfo = $this->getFormattedReport($keywordInfo, $fromTime, $toTime);
				
		// if position information is not empty
		if (empty($positionInfo)) {
			$returnInfo['response'] = 'Error';;
			$returnInfo['result'] = "No reports found!";
		} else {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $positionInfo;
		}
		
		return 	$returnInfo;
		
	}
	
	/**
	 * function to get keyword report using website id
	 * @param Array $info			The input details to process the api
	 * 		$info['id']  			The id of the website	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about keyword reports
	 */
	function getReportByWebsiteId($info) {
		
		$websiteId = intval($info['id']);
		if (empty($websiteId)) {
			return array(
				'response' => 'Error',
				'result' => 'Invalid website id'
			);
		}		
		
		$fromTime = $this->getFromTime($info);
		$toTime = $this->getToTime($info);
		$list = $this->ctrler->__getAllKeywords('', $websiteId);

		// lopp through keywords
		$keywordList = array();
		foreach ($list as $keywordInfo) {
			$keywordList[$keywordInfo['id']] = $this->getFormattedReport($keywordInfo, $fromTime, $toTime);
		}

		// if position information is not empty
		if (empty($keywordList)) {
			$returnInfo['response'] = 'Error';
			$returnInfo['result'] = "No reports found!";
		} else {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $keywordList;
		}
		
		return 	$returnInfo;
		
	}	
	
	/**
	 * function to get keyword report using user id
	 * @param Array $info			The input details to process the api
	 * 		$info['id']  			The id of the user	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about keyword reports
	 */
	function getReportByUserId($info) {
		
		$userId = intval($info['id']);
		if (empty($userId)) {
			return array(
				'response' => 'Error',
				'result' => 'Invalid user id'
			);
		}		
		
		$fromTime = $this->getFromTime($info);
		$toTime = $this->getToTime($info);
		
		// get all active websites
		$websiteController = New WebsiteController();
		$websiteList = $websiteController->__getAllWebsitesWithActiveKeywords($userId, true);
		
		// loop through websites
		$keywordList = array();
		foreach ($websiteList as $websiteInfo) {
			$websiteId = $websiteInfo['id'];
			$list = $this->ctrler->__getAllKeywords('', $websiteId);
			foreach ($list as $keywordInfo) {
				$keywordList[$keywordInfo['id']] = $this->getFormattedReport($keywordInfo, $fromTime, $toTime);
			}
		}

		// if position information is not empty
		if (empty($keywordList)) {
			$returnInfo['response'] = 'Error';
			$returnInfo['result'] = "No reports found!";
		} else {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $keywordList;
		}
		
		return 	$returnInfo;
		
	}
	
}
?>