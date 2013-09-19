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

	function MenuView() {
		
		// Connection Mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// HTML
		
		echo "<div style=\"color:#BA1E28;\" >";
		
			// html - top
			
			echo "<div style=\"height:20px;text-align:center;\" >";
				echo "<p>View</p >";
			echo "</div >";
			
			// html - container
			
			echo "<div style=\"padding-top:20px;\" >";
				echo "<ul style=\"text-align:center;\" >";
					if ( mysqli_select_db($connection,"mylinks") ) {
						if ( $open_query = mysqli_query($connection,"SHOW TABLES") ) {
							while ( $row_query = mysqli_fetch_array($open_query) ) {
								if ( !strstr($row_query[0],"_") ) {
									if ( !empty($row_query[0]) ) {
									echo "<li style=\"padding:5px 0;\" ><span class=\"link-span\" onclick=\"PreviewLink('".$row_query[0]."')\" >".$row_query[0]."</span ></li >";
									} else { echo "Rafael"; }
								}
							}
						}
					}
				echo "</ul >";
			echo "</div >";
		echo "</div >";
		
		// Close Mysql
		
		mysqli_close($connection);
		
	}
	
	function MenuResult() {
		
		// Connection Mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// HTML
		
		echo "<div style=\"color:#BA1E28;\" >";
		
			// html - top
			
			echo "<div style=\"height:20px;text-align:center;\" >";
				echo "<p>Result</p >";
			echo "</div >";
			
			// html - container
			
			echo "<div style=\"padding-top:20px;\" >";
				echo "<table >";
					echo "<thead >";
						echo "<tr >";
							echo "<td style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);text-align:center;padding:5px 0;\" >";
								echo "<p >Publish</p >";
							echo "</td >";
							echo "<td style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);text-align:center;padding:5px 0;\" >";
								echo "<p >Link</p >";
							echo "</td >";
						echo "</tr >";
					echo "</thead >";
					echo "<tbody >";
						if ( mysqli_select_db($connection,"mylinks") ) {
							if ( $open_query = mysqli_query($connection,"SELECT * FROM _link") ) {
								while ( $row_query = mysqli_fetch_array($open_query) ) {
									echo "<tr >";
										echo "<td style=\"padding:5px 10px;text-align:center;\" >";
											echo "<span >".htmlspecialchars($row_query['publish'])."</span >";
										echo "</td >";
										echo "<td style=\"padding:5px 10px;\" >";
											echo "<a class=\"link-span\" href=\"".htmlspecialchars($row_query['link'])."\" target=\"_blank\" >".htmlspecialchars($row_query['link'])."</a >";
										echo "</td >";
									echo "</tr >";
								}
							}
						}
					echo "</tbody >";
				echo "</table >";
			echo "</div >";
		echo "</div >";
		
		// Close Mysql
		
		mysqli_close($connection);
		
	}

?>
<?php

	$menu = isset($_GET['menu']) ? $_GET['menu'] : "";
	
	if ( !empty($menu) ) {
		switch ( $menu ) {
			case "menu-view":
				MenuView();
			break;
			case "menu-result":
				MenuResult();
			break;
		}
	}

?>