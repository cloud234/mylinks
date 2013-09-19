<?php

	ini_set("memory_limit","32M");
	ini_set("max_execution_time","300");
	ini_set("mysql.connect_timeout","90");

	session_start();

?>
<?php

	if ( (isset($_SESSION['code-key-1'])) && (isset($_SESSION['code-key-2'])) && ($_SESSION['code-key-1'] == $_SESSION['code-key-2']) ) {
	} elseif ( basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__) ) {
		exit( header("location: http://mylinks.earnmoneyclicking.com/auth/logout.php") );
	}
	
?>
<?php

	if ( (isset($_SESSION['id-auth-1'])) && (isset($_SESSION['id-auth-2'])) && ($_SESSION['id-auth-1'] == $_SESSION['id-auth-2']) ) {
		if ( (isset($_SESSION['name-auth-1'])) && (isset($_SESSION['name-auth-2'])) && ($_SESSION['name-auth-1'] == $_SESSION['name-auth-2']) ) {
		} elseif ( basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__) ) {
			exit( header("location: http://mylinks.earnmoneyclicking.com/auth/logout.php") );
		}
	} elseif ( basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__) ) {
		exit( header("location: http://mylinks.earnmoneyclicking.com/auth/logout.php") );
	}
	
?>
<?php

	function ActionInsert($publish,$link) {
		
		// Connection Mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// Insert Registry
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			if ( $open_query = mysqli_query($connection,"SELECT * FROM _link WHERE publish='$publish'") ) {
				if ( !mysqli_fetch_array($open_query) ) {
					mysqli_query($connection,"INSERT INTO _link (publish,link) VALUES ('$publish','$link')");
				}
			}
		}
		
		// Create Table 
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			mysqli_query($connection,"CREATE TABLE $publish (id int(10) AUTO_INCREMENT,ip varchar(50),host varchar(200),time time, date date,http varchar(500), PRIMARY KEY (id))");
		}
		
		// Close Mysql
		
		mysqli_close($connection);
		
		// Redirect
		
		echo "<div style=\"color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" >";
			echo "<div style=\"height:20px;\" >";
			echo "</div >";
			echo "<div style=\"text-align:center;padding-top:20px;\" >";
				echo "<p >Data entered</p >";
			echo "</div >";
		echo "</div >";
		
	}
	
	function ActionUpdate($publish,$link) {
		
		// Connection Mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// Update Registry
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			if ( $open_query = mysqli_query($connection,"SELECT * FROM _link WHERE publish='$publish'") ) {
				if ( mysqli_fetch_array($open_query) ) {
					mysqli_query($connection,"UPDATE _link SET link='$link' WHERE publish='$publish'");
				}
			}
		}
		
		// Close Mysql
		
		mysqli_close($connection);
		
		// Redirect
		
		echo "<div style=\"color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" >";
			echo "<div style=\"height:20px;\" >";
			echo "</div >";
			echo "<div style=\"text-align:center;padding-top:20px;\" >";
				echo "<p >Updated Data</p >";
			echo "</div >";
		echo "</div >";
		
	}
	
	function ActionDelete($publish) {
		
		// Connection Mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// Delete Registry
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			if ( $open_query = mysqli_query($connection,"SELECT * FROM _link WHERE publish='$publish'") ) {
				if ( mysqli_fetch_array($open_query) ) {
					if ( mysqli_query($connection,"DELETE FROM _link WHERE publish='$publish'") ) {
					}
				}
			}
		}
		
		
		// Delete Table
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			mysqli_query($connection,"DROP TABLE $publish");
		}
		
		// Close Mysql
		
		mysqli_close($connection);
		
		// Redirect
		
		echo "<div style=\"color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" >";
			echo "<div style=\"height:20px;\" >";
			echo "</div >";
			echo "<div style=\"text-align:center;padding-top:20px;\" >";
				echo "<p >Table clean</p >";
			echo "</div >";
		echo "</div >";
		
	}

?>
<?php

	$action = isset($_GET['action']) ? $_GET['action'] : "";
	$publish = isset($_GET['input-publish']) ? addslashes($_GET['input-publish']) : "";
	$link = isset($_GET['input-link']) ? addslashes($_GET['input-link']) : "";
	
	if ( !empty($action) ) {
		switch ( $action ) {
			case "insert":
				ActionInsert($publish,$link);
			break;
			case "update":
				ActionUpdate($publish,$link);
			break;
			case "delete":
				ActionDelete($publish);
			break;
		}
	}

?>