<?php
class ExampleController extends Controller{

	public function Index(){

		$this->example_model = $this->load->model('example');

		$this->example_model->Example(); 

		$this->response->SetOutput('example.tpl');

	}

}