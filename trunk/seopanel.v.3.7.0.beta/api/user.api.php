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
 * Class defines all functions for managing user API
 * 
 * @author Seo panel
 *
 */
class UserAPI extends Seopanel{
	
	/**
	 * the main controller to get details for api
	 * @var Object
	 */
	var $ctrler;
	
	function UserAPI() {
		include_once(SP_CTRLPATH . "/user.ctrl.php");
		$this->ctrler = new UserController();
	}

	/**
	 * function to get user information 
	 * @param Array $info		The input details to process the api
	 * 		$info['user_id']  	The id of the user
	 * @return Array $userInfo  Contains informations about user
	 */
	function getUserInfo($info) {
		$userId = intval($info['user_id']);
		$returnInfo = array();
		
		// validate the user ifd and user info
		if (!empty($userId)) {
			if ($userInfo = $this->ctrler->__getUserInfo($userId)) {
				$userInfo['password'] = '';
				$returnInfo['response'] = 'success';
				$returnInfo['result'] = $userInfo;
				return $returnInfo;
			}
		}
		
		$returnInfo['response'] = 'Error';
		$returnInfo['error_msg'] = "The invalid user id provided";		
		return 	$returnInfo;
	}
	
}
?>