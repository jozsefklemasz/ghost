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

	$load = new Load($request, $response);

	$user = new user($load);
	$language = new language($load);
	$path = new Path($load, ROOT);
	$theme = new Theme();
	$request = new Request();
	$response = new Response();
	
	$controller = $path->Get();
	$$controller = new $controller($load, $request, $response, $theme);
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