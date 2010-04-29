<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	   *
 *   sendtogeo@gmail.com   						   *
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

# The web path or url to access seo panel through browser.
define('SP_WEBPATH', 'http://localhost/seopanel');

# DB settings - You can get this info from your web hosting provider.
# The name of the database for seo panel
define('DB_NAME', 'seopanel');

# DB database username
define('DB_USER', 'root');

# DB database password
define('DB_PASSWORD', '');

# DB hostname
define('DB_HOST', 'localhost');

# The name of the database engine for seo panel
define('DB_ENGINE', 'mysql');

# The DB debug mode
define('SP_DEBUG', 1);

# The seo panel seconds for session timeout
define('SP_TIMEOUT', 3600);

# The seo panel no of entries per page
define('SP_PAGINGNO', 10);

# The seo panel plugin directory
define('SP_PLUGINDIR', 'plugins');

# The seo panel plugin db file
define('SP_PLUGINDBFILE', 'database.sql');

# The seo panel plugin menu file
define('SP_PLUGINMENUFILE', 'menu.ctp.php');

# default title for seo panel
define('SP_TITLE', "Seo Panel: World's first seo control panel for multiple web sites");

# default decsription for seo panel
define('SP_DESCRIPTION', "A complete free control panel for managing search engine optimization of your websites. It containing lots of hot seo tools to increase and track the performace your websites. Its an open source software and also you can develop your own seo plugins for seo panel.");

# default keywords for seo panel
define('SP_KEYWORDS', "Seo Panel,seo control panel,search engine optimization panel,seo tools kit,keyword rank checker,google pagerank checker,alexa rank checker,sitemap generator,meta tag generator,back link checker,Website Submission tool");
?>
