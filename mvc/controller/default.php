<?php

class DefaultController extends Controller{
	public function Index(){
		$this->data['header'] = $this->load->controller('blocks/header');
		$this->data['footer'] = $this->load->controller('blocks/footer');
		$this->response->SetOutput('default.tpl');
	}
}