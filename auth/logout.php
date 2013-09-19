<?php

	ini_set("memory_limit","32M");
	ini_set("max_execution_time","300");
	
	session_start();
	$_SESSION = array();
	session_destroy();
	
	header("location: http://127.0.0.1/MyLinks/");

?>