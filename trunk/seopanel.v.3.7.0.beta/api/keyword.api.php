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
	 * The constructor of API
	 */
	function KeywordAPI() {
		include_once(SP_CTRLPATH . "/keyword.ctrl.php");
		include_once(SP_CTRLPATH . "/report.ctrl.php");
		$this->ctrler = new KeywordController();
		$this->reportCtrler = New ReportController();
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
		
		return $fromTime;;
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
		$positionInfo = $this->reportCtrler->__getKeywordSearchReport($info['id'], $fromTime, $toTime);

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
	 * 		$info['website_id']  	The id of the website	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about keyword reports
	 */
	function getReportByWebsiteId($info) {
		
		$websiteId = intval($info['website_id']);
		if (empty($websiteId)) {
			return array(
				'response' => 'Error',
				'result' => 'Invalid website id'
			);
		}		
		
		$fromTime = $this->getFromTime($info);
		$toTime = $this->getToTime($info);
		$list = $this->ctrler->__getAllKeywords('', $websiteId);
		$keywordList = array();
		foreach($list as $keywordInfo){
			$positionInfo = $this->ctrler->__getKeywordSearchReport($keywordInfo['id'], $fromTime, $toTime);
			$keywordInfo['position_info'] = $positionInfo;
			$keywordList[$keywordInfo['id']] = $keywordInfo;
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