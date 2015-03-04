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
	 * @param Array $info			The input details to process the api
	 * 		$info['user_id']  		The id of the user
	 * @return Array $returnInfo  	Contains informations about user
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
	
	/**
	 * function to create user
	 * @param Array $info			The input details to process the api
	 * 		$info['userName']		The username of the user
	 * 		$info['password']		The password of the user
	 * 		$info['firstName']		The first name f teh user
	 * 		$info['lastName']		The last name of user
	 * 		$info['email']			The user email
	 * 		$info['type_id']		The user type id of user - default[2]
	 * 		$info['status']			The status of the user - default[1]
	 * @return Array $returnInfo  	Contains details about the operation succes or not
	 */
	function createUser($info) {
		$userInfo = $info;
		$userInfo['confirmPassword'] = $userInfo['password'];
		$return = $this->ctrler->createUser($userInfo, false);
		
		// if user creation is success
		if ($return[0] == 'success') {
			$returnInfo['response'] = 'success';
			$returnInfo['result'] = $return[1];
		} else {
			$returnInfo['response'] = 'Error';
			$returnInfo['error_msg'] = $return[1];
		}
		
		return 	$returnInfo;
		
	}
	
}
?>