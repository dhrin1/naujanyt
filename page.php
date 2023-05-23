<?php require_once("library.php"); require('classes.php'); ?>
<title><?php   $dir = explode("?", basename($_SERVER['REQUEST_URI'])); echo ucfirst($dir[0]);  if(!isset($_GET["pid"])): session::basepath('group'); endif; ?></title> 
<div class="content"></div>
<script src="script/page.js"></script>
