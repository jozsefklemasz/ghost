<?php

class FooterController extends Controller{
	public function Index(){
		$this->response->SetOutput('blocks/footer.tpl');
	}
}