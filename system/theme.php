<?php
class theme{
	private $user, $load;

	function __construct($load){
		$this->load = $load;
		$this->user = $this->load->user();
	}

	public function MainMenu(){
		$links = array(
			'/'	=>	'Recent',
			'/today'	=>	'Today\'s',
		);

		$menu = '<ul class="nav navbar-nav navbar-left">';
		
		if ($this->user->loggedin()){
			$menu .= '<li><a href="/profile/"><span class="glyphicon glyphicon-user"></span> Profile</a></li>';
			$menu .= '<li><a href="/create/"><span class="glyphicon glyphicon-pencil"></span> Create article </a></li>';
			$menu .= '<li><a href="/logout/"><span class="glyphicon glyphicon-off"></span> Logout </a></li>';
		} else { 
			$menu .= '<li><a href="/profile/"><span class="glyphicon glyphicon-user"></span> Log in / Register</a></li>';
		}
		
		foreach ($links as $link => $name) {
			$menu .= '<li><a href="' . $link . '">' . $name . '</a></li>';	
		}
		
		$menu .= '</ul>';

		return $menu;
	}

}