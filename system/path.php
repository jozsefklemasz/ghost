<?php 

	class path{
		private $current, $type, $success, $to_load, $load, $user, $root;

		function __construct($type, $load){
			
				$this->load = $load;
				$this->user = $load->user();
				$this->type = $type;

				$this->root = 'example';
				
			
			if($type == '404'){

				$this->type = 'view';
				$this->current = '404';
				$this->load_file($this->current);
				$this->success = True;

			} else {

				if($this->user->loggedin()){
					if(!empty($_GET['p']) && $_GET['p']!=''){
					
						$this->current = $_GET['p'];

					} else {
						
						$this->current = $this->root;

					}
				} else {
					
					$this->current = 'login';
				}

				

				if($this->file_exists($this->current)){
					
					$this->load_file($this->current);
					$this->success = True;
				
				} else {
					
					$this->success = False;
					return False;
				
				}

			}
		}

		public function loaded(){

			return $this->success;

		}


		private function file_exists($file){

			// Check if file exists in its directory
			
			foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.')) as $filename){
			
			        if(strpos($filename, 'catalog/' . $this->type . '/' . $file) or $filename == 'catalog/' . $this->type . '/' . $filename . '.php'){
			        	return true;
			        }
			
			}

			return false;
		}

		private function load_file($file){
			
			if($this->type!='view'){

				require('catalog/' . $this->type . '/' . $file . '.php');
			
			}

		}

		public function load(){
			
			return 'catalog/' . $this->type . '/' . $this->current . '.php';
		
		}

		public function get_Current(){
		
			return str_replace('-','',$this->current);
		
		}
	}

?>