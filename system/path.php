<?php 

	class Path{
		
		private $load;
		/*
		*
		* handles the loading of other classes eg: user, mvc classes, etc.
		*
		*/

		private $user;
		/*
		*
		* basic user class.
		*
		*/

		private $current;
		/*
		*
		* the current path.
		*
		*/

		function __construct($loadl, $root = ''){
			$this->load = $load;
			$this->user = $user;

			if(isset($_GET['p']) && $_GET['p'] != ''){
				$this->current = $_GET['p'];
			} else {
				if($root != ''){
					$this->current = $root;	
				} else {
					$this->current = '404';
				}
			}

			$this->Load();
			

		}

		private function Load(){
			if(!file_exists('catalog/controller/' . $this->current . '.php')){
				$this->current = 'notexists';
			}

			require('catalog/controller/' . $this->current . '.php');
		}

		/*
		*
		* Get()
		* Returns the current controller file's path.
		*
		*/
		public function Get(){
			return $this->current . 'Controller';
		}

	}

?>