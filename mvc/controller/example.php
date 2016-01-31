<?php
class ExampleController extends Controller{

	public function Index(){

		$this->data['title'] = $this->theme->GetTitle();
		$this->response->SetOutput('example.tpl');

	}

}