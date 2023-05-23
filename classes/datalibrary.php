<?php  
/**
 * 
 */
class Datalibrary extends configuration
{
	
	public function generateid(){
		return rand(1000, 10000).rand(10000, 20000);
	}

	public function getattributeuser($uid){
		$datahelper = new Datahelper();

		$dtble = $datahelper->SQLROW("SELECT b.description AS userType FROM tblaccattr a INNER JOIN tblacctype b ON a.typeid = b.id WHERE a.accid = :uid", [":uid"=>$uid]);

		return $dtble["userType"];
	}

	public function getexduedatetime($datetime){
		$xtract1 = explode("-", $datetime); $xtract2 = explode(" ", $datetime); //extract 2 times
		$year = $xtract1[0]; //year
		$month = substr($xtract1[1], -2, 2); //month
		$day = substr($xtract1[2], 0, 3); //day
		$time = substr($xtract2[1], 0, 5).' '.strtoupper($xtract2[2]); // time
		return date('M', strtotime(date('Y-'. $month .'-d'))).' '.str_replace(' ', '',$day).', '.$year.' '.$time;
	}

	public function getcurtime(){
		date_default_timezone_set('Asia/Manila');
		return date('Y-m-d h:i:s A');
	}


	public function getconverttimeago($timestamp){

		date_default_timezone_set('Asia/Manila');
	  	//$date = date('Y-m-d h:i:s a'); //ex: format time;
	 	//$date = '2018-02-14 12:12:02 AM'; //

		$time_ago = strtotime($timestamp);
		$current_time  = time();
		$time_diff = $current_time - $time_ago;
		$seconds = $time_diff;
		$minutes = round($seconds / 60);
		$hours = round($seconds / 3600);
		$days = round($seconds / 86400);
		$weeks = round($seconds / 604800);
		$months = round($seconds / 2629440);
		$years = round($seconds / 31553280);

		if($seconds <= 60){
			return "Just Now";
		}else if($minutes <= 60){
			if($minutes == 1){
				return "one minute ago";
			}else{
				return "$minutes minutes ago";
			}
		}else if($hours <= 24){
			if($hours == 1){
				return "an hour ago";
			}else{
				return "$hours hrs ago";
			}
		}else if($days <= 7){
			if($days == 1){
				return "yesterday";
			}else{
				return "$days days ago";
			}
		}else if($weeks <= 4.3){
			if($weeks == 1){
				return "a week ago";
			}else{
				return "$weeks weeks ago";
			}
		}else if($months <= 12){
			if($months == 1){
				return "a month ago";
			}else{
				return "$months months ago";
			}
		}else{
			if($years == 1){
				return "one year ago";
			}else{
				return "$years years ago";
			}
		}
	}


	public function getHash($string, $argu = ''){
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering);
		$option = 0;
		$cip_iv = '1234567891011121';
		$en_dec_key = "AlhdrinGungon";

		
		$encryption = openssl_encrypt($string, $ciphering, $en_dec_key, $option, $cip_iv);
		if($argu == "enc"){
			return $encryption;
		}
		
		$descryption = openssl_decrypt($string, $ciphering, $en_dec_key, $option, $cip_iv);

		if($argu == "dec"){
			return $descryption;
		}
		
	}
}
?>