<?php
class NotExists Extends Controller{

	public function Index(){
		$this->response->SetOutput('404.tpl');
	}

}