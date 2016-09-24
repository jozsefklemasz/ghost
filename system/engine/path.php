<?php 

	class Path{
		
		private $load, $user, $current, $request;

		function __construct($load, $root = '', $request, $user){
			$this->load = $load;
			$this->user = $user;
			$this->request = $request;

			if(LOGIN_REQ){
				if(LOGIN_ROUTE){
					$this->current = LOGIN_ROUTE;
				}
			} else {
				if(!($this->current = $this->request->get['p'])){
					if($root != ''){
						$this->current = $root;
					} else {
						$this->current = '404';
					}
				}
			}
			

			$this->LoadCurrentController();
		}

		private function LoadCurrentController(){
			if(!file_exists('mvc/controller/' . $this->current . '.php')){
				$this->current = 'notexists';
			}

			require('mvc/controller/' . $this->current . '.php');
		}

		public function Get(){
			return str_replace('-', '', $this->current . 'Controller');
		}

	}

?>