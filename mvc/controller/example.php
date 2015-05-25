<?php
class ExampleController extends Controller{

	private $example;

	public function Index(){

		$this->example = $this->load->model('example');

		$this->example->Example(); 

		$this->response->SetOutput('example.tpl');

	}

}