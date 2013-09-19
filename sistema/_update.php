<?php

	ini_set("memory_limit","32M");
	ini_set("max_execution_time","300");
	ini_set("mysql.connect_timeout","90");

	session_start();

?>
<?php

	if ( (isset($_SESSION['code-key-1'])) && (isset($_SESSION['code-key-2'])) && ($_SESSION['code-key-1'] == $_SESSION['code-key-2']) ) {
	} elseif ( basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__) ) {
		exit( header("location: http://127.0.0.1/MyLinks/auth/logout.php") );
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

	function MenuInsert() {
		
		// HTML
		
		echo "<div style=\"color:#BA1E28;\" >";
		
			// html - top
			
			echo "<div style=\"height:20px;text-align:center;\" >";
				echo "<p>Insert</p >";
			echo "</div >";
			
			// html - container
			
			echo "<div style=\"padding-top:20px;\" >";
				echo "<div style=\"text-align:center;\" >";
					echo "<div id=\"message-input\" ></div >";
				echo "</div >";
				echo "<table style=\"position:relative;left:100px;width:600px;\" >";
					echo "<thead >";
						echo "<tr >";
							echo "<td style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);text-align:center;padding:5px 0;\">";
								echo "<p >Publish</p >";
							echo "</td >";
							echo "<td style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);text-align:center;padding:5px 0;\" >";
								echo "<p >Link</p >";
							echo "</td >";
						echo "</tr >";
					echo "</thead >";
					echo "<tbody >";
						echo "<tr >";
							echo "<td >";
								echo "<ul style=\"text-align:center;\" >";
									echo "<li >";
										echo "<input style=\"width:180px;text-align:center;\" id=\"input-publish\" type=\"text\" />";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
							echo "<td >";
								echo "<ul style=\"text-align:center;\" >";
									echo "<li >";
										echo "<input style=\"width:380px;\" id=\"input-link\" type=\"text\" />";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
						echo "</tr >";
					echo "</tbody >";
					echo "<tfoot >";
						echo "<tr >";
							echo "<td >";
							echo "</td >";
							echo "<td >";
								echo "<ul style=\"position:relative;left:240px;width:160px;text-align:center;\" >";
									echo "<li style=\"display:inline-block;padding:0 2px;\" >";
										echo "<button class=\"link-buttom\" style=\"width:70px;font-size:12px;\" type=\"button\" onclick=\"InsertInput()\" >Send</button >";
									echo "</li >";
									echo "<li style=\"display:inline-block;padding:0 2px;\" >";
										echo "<button class=\"link-buttom\" style=\"width:70px;font-size:12px;\" type=\"button\" onclick=\"ClearInput()\" >Clean</button >";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
						echo "</tr >";
					echo "</tfoot >";
				echo "</table >";
			echo "</div >";
		echo "</div >";
		
	}
	
	function MenuUpdate() {
		
		// HTML
		
		echo "<div style=\"color:#BA1E28;\" >";
		
			// html - top
			
			echo "<div style=\"height:20px;text-align:center;\" >";
				echo "<p>Update</p >";
			echo "</div >";
			
			// html - container
			
			echo "<div style=\"padding-top:20px;\" >";
				echo "<div style=\"text-align:center;\" >";
					echo "<div id=\"message-input\" ></div >";
				echo "</div >";
				echo "<table style=\"position:relative;left:100px;width:600px;\" >";
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
						echo "<tr >";
							echo "<td >";
								echo "<ul style=\"text-align:center;\" >";
									echo "<li >";
										echo "<input style=\"width:180px;text-align:center;\" id=\"input-publish\" type=\"text\" />";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
							echo "<td >";
								echo "<ul style=\"text-align:center;\" >";
									echo "<li >";
										echo "<input style=\"width:380px;\" id=\"input-link\" type=\"text\" />";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
						echo "</tr >";
					echo "</tbody >";
					echo "<tfoot >";
						echo "<tr >";
							echo "<td >";
							echo "</td >";
							echo "<td >";
								echo "<ul style=\"position:relative;left:240px;width:160px;text-align:center;\" >";
									echo "<li style=\"display:inline-block;padding:0 2px;\" >";
										echo "<button class=\"link-buttom\" style=\"width:70px;font-size:12px;\" type=\"button\" onclick=\"UpdateInput()\" >Update</button >";
									echo "</li >";
									echo "<li style=\"display:inline-block;padding:0 2px;\" >";
										echo "<button class=\"link-buttom\" style=\"width:70px;font-size:12px;\" type=\"button\" onclick=\"ClearInput()\" >Clean</button >";
									echo "</li >";
								echo "</ul >";
							echo "</td >";
						echo "</tr >";
					echo "</tfoot >";
				echo "</table >";
			echo "</div >";
		echo "</div >";
		
	}
	
	function MenuDelete() {
		
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
				echo "<p>Delete</p >";
			echo "</div >";
			
			// html - container
			
			echo "<div style=\"padding-top:20px;\" >";
				echo "<div style=\"text-align:center;\" >";
					echo "<div id=\"message-input\" ></div >";
				echo "</div >";
				echo "<table style=\"position:relative;width:800px;\" >";
					echo "<thead >";
						echo "<tr >";
							echo "<td style=\"width:100px;\" >";
							echo "</td >";
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
										echo "<td style=\"padding:5px 10px;text-align:right;\" >";
											echo "<span class=\"link-button\" onclick=\"DeleteLink(this)\" data-publish=\"".htmlspecialchars($row_query['publish'])."\" data-link=\"".htmlspecialchars($row_query['link'])."\" >Delete</span >";
										echo "</td >";
										echo "<td style=\"padding:5px 10px;text-align:center;\" >";
											echo "<span >".htmlspecialchars($row_query['publish'])."</span >";
										echo "</td >";
										echo "<td style=\"padding:5px 10px;text-align:left;\" >";
											echo "<span >".htmlspecialchars($row_query['link'])."</span >";
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
			case "menu-insert":
				MenuInsert();
			break;
			case "menu-update":
				MenuUpdate();
			break;
			case "menu-delete":
				MenuDelete();
			break;
		}
	}

?>