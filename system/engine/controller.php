<?php 

class Controller{

	protected $load, $user, $request, $response, $error = false, $data;
	private $view = true;
	
	function __construct($load, $request, $response){
		$this->load = $load;
		$this->load->SetParentController($this);
		$this->user = $this->load->user();
		$this->request = $request;
		$this->response = $response;
	}

	public function GetData(){
		if(!empty($this->data)){
			return $this->data;
		} else {
			return false;
		}
	}

	public function DisableView(){
		$this->view = false;
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