<?php
	require_once('config.php');
	ini_set("display_errors", ERROR_LEVEL);
	error_reporting(E_ALL & ~E_NOTICE);

	require_once('engine/cookie.php');
	require_once('engine/user.php');
	require_once('engine/path.php');
	require_once('engine/global_functions.php');
	require_once('engine/load.php');
	require_once('engine/request.php');
	require_once('engine/response.php');
	require_once('engine/controller.php');
	require_once('engine/model.php');
	require_once('engine/theme.php');

	$cookie = new Cookie();
	$request = new Request();
	$response = new Response();
	$load = new Load($request, $response, $cookie);
	$user = new User($load, $cookie);
	$path = new Path($load, ROOT);
	$theme = new Theme();
	
	$controller = $path->Get();
	$$controller = new $controller($load, $request, $response, $theme);
	$$controller->Index();

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