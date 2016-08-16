<?php

Class Cookie{

	private $cookies;

	function __construct(){
		$this->UpdateCookies();
	}

	public function Set($cookieName, $cookieValue, $expire = 0){
		if($cookieName != '' && $cookieValue != ''){		
			if(!$expire){
				$expire = 60 * 60 * 24 * 7; //default expiration time: one week
			}

			setcookie($cookieName, $cookieValue, time() + $expire);
		} 

		$this->UpdateCookies();
	}

	public function Delete($cookieName){
		if($cookieName != ''){		
			setcookie($cookieName, '', 1);
		}

		$this->UpdateCookies();
	}

	public function Get($cookieName){
		if($cookieName != ''){
			if($this->cookies[$cookieName]){
				return $this->cookies[$cookieName];	
			} else {
				return false;
			}
		} else {
			return $this->cookies;
		}
	}

	private function UpdateCookies(){
		$cookieList = array();
		
		if(!empty($_COOKIE)){
			foreach ($_COOKIE as $key => $value) {
				$cookieList[$key] = $value;
			}

			$this->cookies = $cookieList;
		} else {
			$this->cookies = false;
		}
	}
}