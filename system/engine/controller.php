<?php 

class Controller{

	protected $load, $user, $request, $response, $error = false;
	private $view = false;
	public $data;
	
	function __construct($load, $request, $response, $theme = ''){
		$this->load = $load;
		$this->load->SetParentController($this);
		$this->user = $this->load->user();
		$this->request = $request;
		$this->response = $response;

		if($theme){
			$this->theme = $theme;
		}
	}

	protected function Error(){
		if($this->error){
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