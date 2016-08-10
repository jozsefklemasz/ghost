<?php
class ExampleController extends Controller{

	public function Index(){

		$this->data['title'] = 'php_mvc_framework';
		$this->response->SetOutput('example.tpl');

		$this->example = $this->load->model('example');

		$this->example->Example();

	}

}