<?php 
	//MySql DB details
	define('DB_SERVER', '');
	define('DB_USER', '');
	define('DB_PASS', '');
	define('DB_NAME', '');
        
	define('DB_DEBUG', false);

	//Routing settings.
	define('LOGIN_REQ', false); // if true, authentication required
	define('LOGIN_ROUTE', 'login'); // if authentication is required, this will be the site root
	define('SITE_ROOT', 'default'); // this will load after authentication
	

	//System settings
	define('ERROR_LEVEL', '1'); // 0 is disabled, use 1 for debugging
