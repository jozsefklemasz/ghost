<?php 

class Controller{

	protected $load, $user, $request, $response, $error;
	private $view;
	public $data;
	
	function __construct($load, $request, $response, $theme = ''){
		$this->error = false;
		$this->load = $load;
		$this->load->SetParentController($this);
		$this->user = $this->load->user();
		$this->request = $request;
		$this->response = $response;
		$this->view = false;

		if($theme){
			$this->theme = $theme;	
		}
	}

	protected function Error(){
		if(isset($this->error) && $this->error){
			return true;
		} else {
			return false;
		}
	}

	public function View(){
		return $this->view;	
	}

	public function GetView(){
		return $this->response->ViewPath;
	}
}
?>