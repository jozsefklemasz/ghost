<?php
class NotExistsController Extends Controller{

	public function Index(){
		$this->response->header('404');
		$this->response->SetOutput('404.tpl');
	}

}