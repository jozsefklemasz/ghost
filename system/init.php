<?php
	ini_set("display_errors", "1");
	error_reporting(E_ALL & ~E_NOTICE);

	// Start session before anything happens
	session_start();
	
	// Get basic system files
	require('config.php'); // Config file
	require('user.php'); // User class
	require('language.php'); // Language class
	require('path.php'); // Path class
	require('global_functions.php'); // Global functions class

	// Get the MVC classes
	require('load.php'); // Loader class
	require('request.php'); // basic request class
	require('response.php'); // basic response class
	require('controller.php'); // frame class for controllers
	require('model.php'); // frame class for models

	$user = new user(new Load);
	$language = new language(new Load);
	
	$site_title = SITENAME;
	
	$cPath = new path('controller', new Load);
	if($cPath->loaded()){
		$controllername = $cPath->get_current();
		$$controllername = new $controllername(new Load, new request, new response);
		$$controllername->index();


		if($$controllername->View()){
			$extractVars = $$controllername->data;
			if(!empty($extractVars)){
				extract($extractVars);	
			}
			
			require('theme/main/head.php');
			require($$controllername->GetView());
			require('theme/main/footer.php');	
		}
	} else {
		$view = new path('404', new Load);
		require('theme/main/head.php');
		require($view->load());
		require('theme/main/footer.php');	
	}
?>