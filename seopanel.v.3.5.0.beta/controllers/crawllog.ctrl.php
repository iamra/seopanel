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
	 * function to create crawl logs for report generation
	 * @param String $crawlType		The type of crawl[keyword/rank/backlink/saturation/meta/other]
	 * @param int $refId			The ref id of crawl purpose
	 * @param int $crawlStatus		The status of the crawl
	 * @param int $proxyId			The id of the proxy if proxy used
	 * @param String $logMessage	The log message of crawl
	 */
	function createCrawlLog($crawlType, $refId, $crawlStatus, $proxyId, $logMessage) {
		$sql = "INSERT INTO crawl_log(`crawl_type`, `ref_id`, `crawl_status`, `proxy_id`, `log_message`)
		VALUES ('".addslashes($crawlType)."', '".intval($refId)."', '".intval($crawlStatus)."', 
		'".intval($proxyId)."', '".addslashes($logMessage)."')";
		$this->db->query($sql);
	}
	
}
?>