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
 * Class defines all functions for managing website API
 * 
 * @author Seo panel
 *
 */
class WebsiteAPI extends Seopanel{
	
	/**
	 * the main controller to get details for api
	 * @var Object
	 */
	var $ctrler;
	
	/**
	 * The list contains search engine details
	 * @var Array
	 */
	var $seList;
	
	/**
	 * The constructor of API
	 */
	function WebsiteAPI() {
		$this->ctrler = new WebsiteController();
		$list = $seController->__getAllSearchEngines();
		$this->seList = array();
		
		// loop through the search engine and assign id as key
		foreach ($list as $listInfo) {
			$this->seList[$listInfo['id']] = $listInfo;
		}
		
		include_once(SP_CTRLPATH."/saturationchecker.ctrl.php");
		include_once(SP_CTRLPATH."/rank.ctrl.php");
		include_once(SP_CTRLPATH."/backlink.ctrl.php");
		include_once(SP_CTRLPATH."/directory.ctrl.php");
	}

	/**
	 * function to get website report and format it
	 * @param id $websiteInfo		The information about website
	 * @param int $fromTime			The time stamp of from time
	 * @param int $toTime			The time stamp of to time
	 * @return $websiteInfo			The formatted website info with position details
	 */
	function getFormattedReport($websiteInfo, $fromTime, $toTime) {
		$positionInfo = $this->reportCtrler->__getWebsiteSearchReport($websiteInfo['id'], $fromTime, $toTime, true);
				
		// loop through and add search engine name
		foreach ($positionInfo as $seId => $info) {
			$positionInfo[$seId]['search_engine'] = $this->seList[$seId]['domain'];
			$positionInfo[$seId]['date'] = date('Y-m-d', $toTime);
		}
		
		$websiteInfo['position_info'] = $positionInfo;
		return $websiteInfo; 
	}	
	
	/**
	 * function to get website report using website id
	 * @param Array $info			The input details to process the api
	 * 		$info['id']  			The id of the website	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about website reports
	 */
	function getReportById($info) {
		
		$fromTime = $this->getFromTime($info);
		$toTime = $this->getToTime($info);
		$websiteInfo = $this->ctrler->__getWebsiteInfo($info['id']);
		
		
		$rankCtrler = New RankController();
		$backlinlCtrler = New BacklinkController();
		$saturationCtrler = New SaturationCheckerController();
		$dirCtrler = New DirectoryController();
			
		$websiteRankList = array();
		foreach($websiteList as $listInfo){
		
			// if only needs to show onewebsite selected
			if (!empty($websiteId) && ($listInfo['id'] != $websiteId)) continue;
			 
			# rank reports
			$report = $rankCtrler->__getWebsiteRankReport($listInfo['id'], $fromTime, $toTime);
			$report = $report[0];
			$listInfo['alexarank'] = empty($report['alexa_rank']) ? "-" : $report['alexa_rank']." ".$report['rank_diff_alexa'];
				$listInfo['googlerank'] = empty($report['google_pagerank']) ? "-" : $report['google_pagerank']." ".$report['rank_diff_google'];
		
				# back links reports
			$report = $backlinlCtrler->__getWebsitebacklinkReport($listInfo['id'], $fromTime, $toTime);
			$report = $report[0];
			$listInfo['google']['backlinks'] = empty($report['google']) ? "-" : $report['google']." ".$report['rank_diff_google'];
			$listInfo['alexa']['backlinks'] = empty($report['alexa']) ? "-" : $report['alexa']." ".$report['rank_diff_alexa'];
					$listInfo['msn']['backlinks'] = empty($report['msn']) ? "-" : $report['msn']." ".$report['rank_diff_msn'];
		
							# rank reports
				$report = $saturationCtrler->__getWebsiteSaturationReport($listInfo['id'], $fromTime, $toTime);
						$report = $report[0];
						$listInfo['google']['indexed'] = empty($report['google']) ? "-" : $report['google']." ".$report['rank_diff_google'];
								$listInfo['msn']['indexed'] = empty($report['msn']) ? "-" : $report['msn']." ".$report['rank_diff_msn'];
		
										$listInfo['dirsub']['total'] = $dirCtrler->__getTotalSubmitInfo($listInfo['id']);
										$listInfo['dirsub']['active'] = $dirCtrler->__getTotalSubmitInfo($listInfo['id'], true);
										$websiteRankList[] = $listInfo;
		}		
				
		// if position information is not empty
		if (empty($positionInfo)) {
			$returnInfo['response'] = 'Error';;
			$returnInfo['result'] = "No reports found!";
		} else {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $websiteRankList[0];
		}
		
		return 	$returnInfo;
		
	}	
	
	/**
	 * function to get website report using user id
	 * @param Array $info			The input details to process the api
	 * 		$info['id']  			The id of the user	- Mandatory
	 * 		$info['from_time']  	The from time of report in (yyyy-mm-dd) Eg: 2014-12-24	- Optional - (default => Yesterday)
	 * 		$info['to_time']  		The to time of report in (yyyy-mm-dd) Eg: 2014-12-28	- Optional - (default => Today)
	 * @return Array $returnInfo  	Contains informations about website reports
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
		$websiteList = $websiteController->__getAllWebsitesWithActiveWebsites($userId, true);
		
		// loop through websites
		$websiteList = array();
		foreach ($websiteList as $websiteInfo) {
			$websiteId = $websiteInfo['id'];
			$list = $this->ctrler->__getAllWebsites('', $websiteId);
			foreach ($list as $websiteInfo) {
				$websiteList[$websiteInfo['id']] = $this->getFormattedReport($websiteInfo, $fromTime, $toTime);
			}
		}

		// if position information is not empty
		if (empty($websiteList)) {
			$returnInfo['response'] = 'Error';
			$returnInfo['result'] = "No reports found!";
		} else {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $websiteList;
		}
		
		return 	$returnInfo;
		
	}
	
}
?>