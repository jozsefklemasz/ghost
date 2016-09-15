<?php
	require_once('config.php');
	ini_set("display_errors", ERROR_LEVEL);
	error_reporting(E_ALL & ~E_NOTICE);

	//Load framework files
	require_once(__DIR__ . '/engine/cookie.php');
	require_once(__DIR__ . '/engine/user.php');
	require_once(__DIR__ . '/engine/path.php');
	require_once(__DIR__ . '/engine/load.php');
	require_once(__DIR__ . '/engine/request.php');
	require_once(__DIR__ . '/engine/response.php');
	require_once(__DIR__ . '/engine/controller.php');
	require_once(__DIR__ . '/engine/model.php');
	require_once(__DIR__ . '/engine/theme.php');

	$cookie = new Cookie();
	$request = new Request();
	$response = new Response();
	$load = new Load($request, $response, $cookie);
	$user = new User($load, $cookie);
	$path = new Path($load, ROOT, $request, $user);
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