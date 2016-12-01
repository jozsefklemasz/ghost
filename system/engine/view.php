<?php
final class View{

	private $current_theme;

	function __construct(){
		$this->current_theme = 'main';
	}

	public function SetTitle($title){
		$this->title = $title;
	}

	public function GetTitle(){
		return $this->title;
	}

}