<?php

class HeaderController extends Controller{
	public function Index(){
		$scripts = [
			'https://code.jquery.com/jquery-3.1.0.min.js',
			'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
			SUBDIR . '/mvc/view/theme/main/js/sketch.js'
		];

		$styles = [
			'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
			'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400&subset=latin-ext" rel="stylesheet',
			'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
			SUBDIR . '/mvc/view/theme/main/style/style.css',
		];

		$this->data['scripts'] = $scripts;
		$this->data['styles'] = $styles;

		$this->response->SetOutput('blocks/header.tpl');
	}
}