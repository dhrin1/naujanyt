<?php
class Session extends configuration{

	private static $session = false;

	public static function start(){

		if(self::$session == false):
			session_start();
			self::$session = true;
		endif;
	}

	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function get($key, $secondKey = false){
		if($secondKey == true){
			if(isset($_SESSION[$key][$secondKey]))
				return $_SESSION[$key][$secondKey];
		}
		else{

			if(isset($_SESSION[$key]))
				return $_SESSION[$key];

		}
		return false;
		
	}

	public static function display(){
		echo '<pre>';
		print_r($_SESSION);	
		echo '</pre>';
	}

	public static function out(){
		
		if(self::$session == true){
			session_unset();
			session_destroy();
		}
		
	}

	public static function trigger()
	{
		session::start();
		return (session::get('account', 'accid') != null) ? self::get('account', 'accid') : false;
	}

	public static function basepath($location){
		header('location: '. $location);
	}

} 	 
?>