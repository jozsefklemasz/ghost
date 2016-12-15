<?php

class DefaultController extends Controller{
	public function Index(){
		if($this->request->post){
			$this->user->Login($this->request->post);
		}

		if($this->user->LoggedIn())
		{
			$this->data['loggedin'] = true;
		}

		$this->data['header'] = $this->load->controller('blocks/header');
		$this->data['footer'] = $this->load->controller('blocks/footer');
		$this->response->SetOutput('default.tpl');
	}
}