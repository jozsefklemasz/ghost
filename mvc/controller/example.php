<?php
class ExampleController extends Controller{

	public function Index(){

		$this->data['title'] = 'Ghost Framework';

		$this->response->SetOutput('example.tpl');

	}

}