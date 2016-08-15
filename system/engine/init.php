<?php
	require_once('config.php'); // Config file
	ini_set("display_errors", ERROR_LEVEL);
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	//Engine
	require_once('engine/user.php');
	require_once('engine/language.php');
	require_once('engine/path.php');
	require_once('engine/global_functions.php');
	require_once('engine/load.php');
	require_once('engine/request.php');
	require_once('engine/response.php');
	require_once('engine/controller.php');
	require_once('engine/model.php');
	require_once('engine/theme.php');

	$load = new Load($request, $response);
	$user = new User($load);
	$language = new Language($load);
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