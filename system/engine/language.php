<?php
class Language{

	private $load, $browser;

	public function __construct($load){
		$this->load = $load;

		$this->setCurrent();

		if($_SERVER['HTTP_ACCEPT_LANGUAGE']){
			$this->browser = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$this->browser = false;
		}
	}

	private function setCurrent(){
		if($_GET['language']){
			if($_GET['language'] == 'en' or $_GET['language']){
				$_SESSION['language'] = strtolower($_GET['language']);
			} else {
				$_SESSION['language'] = 'en';
			}
		} else {
			if($this->browser){
				if($this->browser == 'en' or $this->browser == 'hu'){
					$_SESSION['language'] = $this->browser;
				}
			} else {
				$_SESSION['language'] = 'en';
			}
		}
	}
}