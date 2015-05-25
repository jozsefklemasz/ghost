<?php 

class mail{
	
	private $from_mail, $sender;

	function __construct(){

		$this->from_mail = SERVER_MAIL;
		$this->sender = SERVER_MAIL_NAME;

	}

	public function send($to, $subject, $message){

		$header .= "Content-Type: text/html; charset=utf-8\n";
		$header .= 'From: ' . $this->sender . ' <' . $this->from_mail . '>';
		
		echo $to . $subject . $message . $header;
		
		mail($to,$subject,$message,$header);

	}
}
?>