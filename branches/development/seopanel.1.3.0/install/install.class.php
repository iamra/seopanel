<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	           *
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

class Install {
	
	# func to check requirements
	function checkRequirements() {
		?>
		hiiiii
		<?php
	}
	
	function showDefaultHeader() {
		?>
		<html>
			<head>
				<title>Seo Panel installation interface</title>
				<meta name="description" content="Seo Panel installation Steps to install seo control panel for managing seo of your sites.">
				<link rel="stylesheet" type="text/css" href="/css/screen.css" media="all" />				
			</head>
			<body>
				<div class="installdiv">
		<?php		
	}
	
	function showDefaultFooter($content='') {
		?>
				</div>
			</body>
		</html>
		<?php		
	}
}
?>