<?php
final class Response{

	public $ViewPath;

	public function Redirect($url){

		if(isset($url) && $url!=''){
			header('Location: ' . $url);
			exit;
		} else {
			return false;
		}

	}

	public function Header($header){
		$link = '';

		switch ($header) {
			case '404':
				$link = $_SERVER["SERVER_PROTOCOL"] ." 404 Not Found";
				break;
			case 'pdf':
				$link = 'Content-Type: application/pdf';
				break;
			case 'csv':
				$link = 'Content-type: text/csv';
				break;
		}

		header($link);

		return;
	}

	public function SetOutput($output){
		$this->ViewPath = 'mvc/view/' . $output;
	}
}