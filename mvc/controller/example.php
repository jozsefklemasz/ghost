<?php
class ExampleController extends Controller{

	public function Index(){
		$this->data['title'] = 'php_mvc_framework';
		$this->response->SetOutput('example.tpl');
		$this->load->model('example', $this);

		echo $this->examplemodel->Test();
	}

}