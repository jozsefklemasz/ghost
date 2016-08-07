<?php
	require_once('config.php'); // Config file
	ini_set("display_errors", ERROR_LEVEL);
	error_reporting(E_ALL & ~E_NOTICE);

	// Start session before anything happens
	session_start();
	

	//Engine	
	require_once('user.php');
	require_once('language.php');
	require_once('path.php');
	require_once('global_functions.php');
	require_once('load.php');
	require_once('request.php');
	require_once('response.php');
	require_once('controller.php');
	require_once('model.php');
	require_once('theme.php');

	$user = new user(new Load);
	$language = new language(new Load);
	
	$path = new Path(new Load, ROOT);

	$theme = new Theme();
	
	$controller = $path->Get();
	$$controller = new $controller(new Load(new Request, new Response), new Request, new Response, $theme);
	$$controller->index();

	if($$controller->View()){
		$extractVars = $$controller->data;
		if(!empty($extractVars)){
			extract($extractVars);	
		}

		$output = $theme->Parse($$controller->GetView());
		if($output){
			require($output);
			unlink($output);	
		}		
	}
	
?>