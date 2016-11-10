<?php

class DefaultController extends Controller{
	public function Index(){
		
		$this->response->SetOutput('default.tpl');
	}
}