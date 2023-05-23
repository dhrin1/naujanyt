<?php  
require('../classes.php');
session::start();
if(isset($_GET['log'])){
	session::out();
	session::basepath('../index');
}


?>