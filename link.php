<?php

	ini_set("memory_limit","32M");
	ini_set("max_execution_time","300");
	ini_set("mysql.connect_timeout","90");
	date_default_timezone_set("America/Sao_Paulo");

?>
<?php

	switch ( $publish = isset($_GET['id']) ? addslashes($_GET['id']) : "" ) {
		case true:
		
		// conection mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "mylinks";
		$connection = mysqli_connect($hostname,$username,$password);
		$database_selected = mysqli_select_db($connection,$database);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		if ( !$database_selected ) {
			echo "<p>Could not connect to DATABASE.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		$query = mysqli_query($connection,"SELECT * FROM link WHERE publish='$publish'");
		$row = mysqli_fetch_array($query);
		switch ( $publish == $row['publish'] ) {
			case true:
			
			// open url
			
			if ( $open_query = mysqli_query($connection,"SELECT * FROM link WHERE publish='$publish'") ) {
				if ( $row_query = mysqli_fetch_array($open_query) ) {
					
					// perform redirects
					
					header("Location: ".$row_query['link']);
					
					// insert ip
					
					$host_ip = $_SERVER['REMOTE_ADDR'];
					$host_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
					$host_time = date("H:i:s");
					$host_date = date("Y/m/d");
					$host_http = isset($_SERVER['HTTP_REFERER']);
					mysqli_query($connection,"INSERT INTO _$publish (ip,host,time,date,http) VALUES ('$host_ip','$host_host','$host_time','$host_date','$host_http')");
					
					// close mysql
					
					mysqli_close($connection);
					
				}
			}
			
			break;
			case false:
				
				// else id
				
				$host_ip = $_SERVER['REMOTE_ADDR']."\n";
				$path_file = "sistema/text/ip_link.txt";
				$open_file = fopen($path_file,"a") or die("can't open file");
				fwrite($open_file,$host_ip);
				fclose($open_file);
				exit( header("location: http://127.0.0.1/MyLinks/") );
				
			break;
			
		}
		
		break;
		case false:
			
			// else publish
			
			mysqli_close($connection);
			
			// else ip
			
			$host_ip = $_SERVER['REMOTE_ADDR']."\n";
			$path_file = "sistema/text/ip_id.txt";
			$open_file = fopen($path_file,"a") or die("can't open file");
			fwrite($open_file,$host_ip);
			fclose($open_file);
			exit( header("location: http://127.0.0.1/MyLinks/") );
			
		break;
	
	}
	
?>