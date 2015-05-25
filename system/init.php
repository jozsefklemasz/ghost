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
	
	$path = new Path(new Load, ROOT);
	
	$controller = $path->Get();
	$$controller = new $controller(new Load, new Request, new Response);
	$$controller->index();

	if($$controller->View()){
		$extractVars = $$controller->data;
		if(!empty($extractVars)){
			extract($extractVars);	
		}
		
		require('theme/main/head.php');
		require($$controller->GetView());
		require('theme/main/footer.php');	
	}
	
?>