<?php

Class InstallController extends Controller{
	public function Index(){
		$this->load->model('install');
		if($error = $this->model_install->Install()){
			$this->data['message'] = $error;
		} else {
			$this->data['message'] = 'Database frame successfully created, make sure to delete the install files!';
		}

		$this->response->SetOutput('install.tpl');
	}
}