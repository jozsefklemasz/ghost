<?php
	require_once('config.php');
	ini_set("display_errors", ERROR_LEVEL);
	error_reporting(E_ALL & ~E_NOTICE);

	require_once('engine/cookie.php');
	require_once('engine/user.php');
	require_once('engine/path.php');
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
	$path = new Path($load, ROOT, $request);
	$theme = new Theme();
	
	$controllerName = $path->Get();
	$controller = new $controllerName($load, $request, $response, $theme);
	$controller->Index();

	if($controller->View()){
		if($extractableData = $controller->GetData()){
			extract($extractableData);
		}
		
		$output = $theme->Parse($controller->GetView());
		if($output){
			require_once($output);
			unlink($output);	
		}		
	}
?>