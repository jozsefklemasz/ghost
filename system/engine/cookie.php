<?php

final class Cookie{
        
    /**
     *
     * @var array $cookies      array of currently set cookies
     */
	private $cookies;
        
    /**
    * Accessing, creating, deleting cookies;
    */
	function __construct(){
		$this->UpdateCookies();
	}
        
    /**
     * Creating a cookie by setting it's name, value and expiration date
     * @param string $cookieName    The name of the cookie
     * @param string $cookieValue   The value of the cookie
     * @param int $expire           Expiration time of cookies(in seconds)
     */
	public function Set($cookieName, $cookieValue, $expire = 0){
		if($cookieName != '' && $cookieValue != ''){		
			if(!$expire){
				$expire = 60 * 60 * 24 * 7;
			}

			setcookie($cookieName, $cookieValue, time() + $expire);
		} 

		$this->UpdateCookies();
	}
        
    /**
     * Deleting a cookie by name
     * @param string $cookieName    The name of the cookie you want to delete
     */
	public function Delete($cookieName){
		if($cookieName != ''){		
			setcookie($cookieName, '', 1);
		}

		$this->UpdateCookies();
	}
        
    /**
     * Getting a cookie by name
     * @param string $cookieName    Name of the cookie you want to access
     * @return Either returns cookie data(array) or false if the cookie not exists
     */
	public function Get($cookieName = ''){
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
        
    /**
     * Updates the cookie stack
     */
	private function UpdateCookies(){
		$cookieList = array();
		
		$filteredCookie = filter_input_array(INPUT_COOKIE, $_COOKIE);
		if(!empty($filteredCookie)){
			foreach ($filteredCookie as $key => $value) {
				$cookieList[$key] = $value;
			}

			$this->cookies = $cookieList;
		} else {
			$this->cookies = false;
		}
	}

	/**
	* Destroys every cookie
	*/
	public function Clean(){
		if(!empty($_COOKIE)){
			foreach ($_COOKIE as $key => $value) {
				setcookie($key, '', 1);
			}
		}
	}
}