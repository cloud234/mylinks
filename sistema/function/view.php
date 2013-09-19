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

	function ActionPreview($page,$publish) {
		
		// Connection Mysql
		
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
		
		// PHP Pagination
		
		if($page == "") {
			$page = "1";
		}
		
		$maximum = 200;	
		$outset = $page - 1;
		$outset = $maximum * $outset;
		
		$count_unique = mysqli_query($connection,"SELECT count(*) AS 'full_records' FROM $publish");
		$row = mysqli_fetch_array($count_unique);
		$total_unique = $row['full_records'];
		
		$count_duplicate = mysqli_query($connection,"SELECT ip AS 'full_records' FROM $publish GROUP BY ip HAVING count(ip) > 1");
		while ( $row_duplicate = mysqli_fetch_array($count_duplicate) ) {
			$query_duplicate = mysqli_query($connection,"SELECT * FROM $publish WHERE ip='$row_duplicate[full_records]'");
			while ( $result_duplicate = mysqli_fetch_array($query_duplicate) ) {
				$total_ip[] = $result_duplicate['ip'];
			}
		}
		if ( !empty($total_ip) ) {
			$total_duplicate = count($total_ip);
		} else {
			$total_duplicate = "0";
		}
		
		// HTML
		
		echo "<div >";
		
			// HTML - top
			
			echo "<div >";
				echo "<p style=\"text-align:center;\" >Result</p >";
				echo "<div style=\"float:left;\" >";
					echo "<span style=\"color:#222;text-shadow:0 1px rgba(51,51,51,0.5);padding:2px 5px;\" >$total_duplicate</span >";
					echo "<span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.5);padding:2px 5px;\" onclick=\"PreviewLinkAll('$publish')\" >$total_unique</span >";
				echo "</div >";
				echo "<div style=\"float:right;\" >";
					echo "<span class=\"button-span\" onclick=\"CleanPreview('$publish')\" >$publish</span >";
				echo "</div >";
				echo "<span >&nbsp;</span >";
			echo "</div >";
			
			// HTML - pagination
			
			$less = $page - 1;
			$more = $page + 1;	 
			$pages_total = ceil($total_duplicate/$maximum);
			if ( $pages_total > 1 ) {
				echo "<div style=\"text-align:center;\" >";
					echo "<ul >";
						if ( $less > 0 ) {
							echo "<li style=\"display:inline-block;padding:0 5px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" data=\"".$less."\" onclick=\"PaginationPreview(this,'$publish')\" >Previous</span ></li >";
						}
						for ( $i=1; $i<=$pages_total; $i++ ) {
							if ( $i != $page ) {
								echo "<li style=\"display:inline-block;padding:0 3px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.5);\" data=\"".$i."\" onclick=\"PaginationPreview(this,'$publish')\" >".$i."</span ></li >";
							} else {
								echo "<li style=\"display:inline-block;padding:0 3px;\" ><span style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);\" >".$i."</span ></li>";
							}
						}
						if ( $more <= $pages_total ) {
							echo "<li style=\"display:inline-block;padding:0 5px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" data=\"".$more."\" onclick=\"PaginationPreview(this,'$publish')\" >Next</span ></li >";
						}
					echo "</ul >";
				echo "</div >";
			} else {
				echo "<div >&nbsp;</div >";
			}
			
			// HTML - container
			
			echo "<div style=\"padding-top:10px;\" >";
				echo "<table >";
					echo "<tbody style=\"color:#BA1E28;line-height:22px;\" >";
						$open_duplicate = mysqli_query($connection,"SELECT ip AS 'full_records' FROM $publish GROUP BY ip HAVING count(ip) > 1");
						while ( $row_open = mysqli_fetch_array($open_duplicate) ) {
							$query_open = mysqli_query($connection,"SELECT * FROM $publish WHERE ip='$row_open[full_records]' ORDER BY id LIMIT $outset,$maximum");
							while ($row_query = mysqli_fetch_object($query_open)) {
								echo "<tr style=\"height:80px;\" >";
									echo "<td style=\"width:100px;\" >";
										echo "<p style=\"text-align:center;\" >$row_query->id</p >";
										echo "<p >&nbsp;</p >";
									echo "</td >";
									echo "<td style=\"width:200px;\" >";
										echo "<p style=\"float:left;padding-left:20px;\" >$row_query->time</p >";
										echo "<p style=\"float:right;padding-right:20px;\" >$row_query->date</p >";
										echo "<p style=\"text-align:center;\" >$row_query->ip</p >";
									echo "</td >";
									echo "<td style=\"width:500px;\" onclick=\"ClickMouse(this)\" >";
										$http = !empty($row_query->http) ? $row_query->http : "<br />";
										$http = parse_url($http);
										$scheme = isset($http['scheme']) ? $http['scheme']."://" : "";
										$host = isset($http['host']) ? $http['host'] : "";
										$path = isset($http['path']) ? $http['path'] : "";
										$query = isset($http['query']) ? $http['query'] : "";
										echo "<p style=\"text-align:center;\" class=\"html_url\" >$scheme$host$path</p >";
										echo "<p style=\"text-align:center;\" class=\"html_host\" >$row_query->host</p >";
										echo "<input class=\"input_hidden\" type=\"hidden\" value=\"$query\" />";
									echo "</td >";
								echo "</tr >";
							}
						}
					echo "</tbody >";
				echo "</table >";
			echo "</div >";
		echo "</div >";
		
		// Close Mysql
		
		mysqli_close($connection);
		
	}
	
	function ActionPreviewAll($page,$publish) {
		
		// Connection Mysql
		
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
		
		// PHP Pagination
		
		if($page == "") {
			$page = "1";
		}
		
		$maximum = 200;
		$outset = $page - 1;
		$outset = $maximum * $outset;
		
		$count_unique = mysqli_query($connection,"SELECT count(*) AS 'full_records' FROM $publish");
		$row_unique = mysqli_fetch_array($count_unique);
		$total_unique = $row_unique['full_records'];
		
		$count_duplicate = mysqli_query($connection,"SELECT ip AS 'full_records' FROM $publish GROUP BY ip HAVING count(ip) > 1");
		while ( $row_duplicate = mysqli_fetch_array($count_duplicate) ) {
			$query_duplicate = mysqli_query($connection,"SELECT * FROM $publish WHERE ip='$row_duplicate[full_records]'");
			while ( $result_duplicate = mysqli_fetch_array($query_duplicate) ) {
				$total_ip[] = $result_duplicate['ip'];
			}
		}
		if ( !empty($total_ip) ) {
			$total_duplicate = count($total_ip);
		} else {
			$total_duplicate = "0";
		}
		
		// HTML
		
		echo "<div >";
		
			// HTML - top
			
			echo "<div >";
				echo "<p style=\"text-align:center;\" >Result</p >";
				echo "<div style=\"float:left;\" >";
					echo "<span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.5);padding:2px 5px;\" onclick=\"PreviewLink('$publish')\" >$total_duplicate</span >";
					echo "<span style=\"color:#222;text-shadow:0 1px rgba(51,51,51,0.5);padding:2px 5px;\" >$total_unique</span >";
				echo "</div >";
				echo "<div style=\"float:right;\" >";
					echo "<span class=\"button-span\" onclick=\"CleanPreview('$publish')\" >$publish</span >";
				echo "</div >";
				echo "<span >&nbsp;</span >";
			echo "</div >";
			
			// HTML - pagination
			
			$less = $page - 1;
			$more = $page + 1;
			$pages_total = ceil($total_unique/$maximum);
			if ( $pages_total > 1 ) {
				echo "<div style=\"text-align:center;\" >";
					echo "<ul >";
						if ( $less > 0 ) {
							echo "<li style=\"display:inline-block;padding:0 5px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" data=\"".$less."\" onclick=\"PaginationPreviewAll(this,'$publish')\" >Previous</span ></li >";
						}
						for ( $i=1; $i<=$pages_total; $i++ ) {
							if ( $i != $page ) {
								echo "<li style=\"display:inline-block;padding:0 3px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" data=\"".$i."\" onclick=\"PaginationPreviewAll(this,'$publish')\" >".$i."</span ></li >";
							} else {
								echo "<li style=\"display:inline-block;padding:0 3px;\" ><span style=\"color:#3A1B1D;text-shadow:0 1px rgba(58,27,29,0.2);\" >".$i."</span ></li>";
							}
						}
						if ( $more <= $pages_total ) {
							echo "<li style=\"display:inline-block;padding:0 5px;\" ><span style=\"cursor:pointer;color:#BA1E28;text-shadow:0 1px rgba(186,30,40,0.2);\" data=\"".$more."\" onclick=\"PaginationPreviewAll(this,'$publish')\" >Next</span ></li >";
						}
					echo "</ul >";
				echo "</div >";
			} else {
				echo "<div >&nbsp;</div >";
			}
			
			// HTML - container
			
			echo "<div style=\"padding-top:10px;\" >";
				echo "<table >";
					echo "<tbody style=\"color:#BA1E28;line-height:22px;\" >";	
						$open_duplicate = mysqli_query($connection,"SELECT ip AS 'full_records' FROM $publish GROUP BY ip HAVING count(ip) > 1");
						while ( $row_open = mysqli_fetch_array($open_duplicate) ) {
							$query_open = mysqli_query($connection,"SELECT * FROM $publish WHERE ip='$row_open[full_records]' ORDER BY id LIMIT $outset,$maximum");
							while ($row_query = mysqli_fetch_object($query_open)) {
								echo "<tr style=\"height:80px;\" >";
									echo "<td style=\"width:100px;\" >";
										echo "<p style=\"text-align:center;\" >$row_query->id</p >";
										echo "<p >&nbsp;</p >";
									echo "</td >";
									echo "<td style=\"width:200px;\" >";
										echo "<p style=\"float:left;padding-left:20px;\" >$row_query->time</p >";
										echo "<p style=\"float:right;padding-right:20px;\" >$row_query->date</p >";
										echo "<p style=\"text-align:center;\" >$row_query->ip</p >";
									echo "</td >";
									echo "<td style=\"width:500px;\" onclick=\"ClickMouse(this)\" >";
										$http = !empty($row_query->http) ? $row_query->http : "<br />";
										$http = parse_url($http);
										$scheme = isset($http['scheme']) ? $http['scheme']."://" : "";
										$host = isset($http['host']) ? $http['host'] : "";
										$path = isset($http['path']) ? $http['path'] : "";
										$query = isset($http['query']) ? $http['query'] : "";
										echo "<p style=\"text-align:center;\" class=\"html_url\" >$scheme$host$path</p >";
										echo "<p style=\"text-align:center;\" class=\"html_host\" >$row_query->host</p >";
										echo "<input class=\"input_hidden\" type=\"hidden\" value=\"$query\" />";
									echo "</td >";
								echo "</tr >";
							}
						}
					echo "</tbody >";
				echo "</table >";
			echo "</div >";
		echo "</div >";
		
		// Close Mysql
		
		mysqli_close($connection);
		
	}
	
	function ActionDelete($publish) {
		
		// connection mysql
		
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$connection = mysqli_connect($hostname,$username,$password);
		if ( !$connection ) {
			echo "<p>Could not connect to MYSQL.</p>";
			echo "<p>MySQL Error: " .mysqli_connect_error()."</p>";
		}
		
		// sql mysql
		
		if ( mysqli_select_db($connection,"mylinks") ) {
			mysqli_query($connection,"DELETE FROM $publish");
			mysqli_query($connection,"TRUNCATE TABLE $publish");
			//mysqli_query($connection,"ALTER TABLE $publish AUTO_INCREMENT=1");
			//mysqli_query($connection,"DROP TABLE $publish");
			//mysqli_query($connection,"CREATE TABLE $publish (id int(10) AUTO_INCREMENT,ip varchar(50),host varchar(200),time time, date date,http varchar(500), PRIMARY KEY (id))");
		}
		
		// html delete
		
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
	$page = isset($_GET['data-page']) ? (int)$_GET['data-page'] : "";
	$publish = isset($_GET['input-publish']) ? addslashes($_GET['input-publish']) : "";
	
	if ( !empty($action) ) {
		switch ( $action ) {
			case "preview":
				ActionPreview($page,$publish);
			break;
			case "preview-all":
				ActionPreviewAll($page,$publish);
			break;
			case "delete":
				ActionDelete($publish);
			break;
		}
	}

?>