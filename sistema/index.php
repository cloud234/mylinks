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

	function IndexView() {
		
		echo "<div id=\"menu-content-left\" >";
			echo "<ul >";
				echo "<li ><span id=\"menu-view\" onclick=\"IndexView(this)\" >View</span ></li >";
				echo "<li ><span id=\"menu-result\" onclick=\"IndexView(this)\" >Result</span ></li >";
			echo "</ul >";
		echo "</div >";
		
	}
	
	function IndexUpdate() {
		
		echo "<div id=\"menu-content-left\" >";
			echo "<ul >";
				echo "<li ><span id=\"menu-insert\" onclick=\"IndexUpdate(this)\" >Insert</span ></li >";
				echo "<li ><span id=\"menu-update\" onclick=\"IndexUpdate(this)\" >Update</span ></li >";
				echo "<li ><span id=\"menu-delete\" onclick=\"IndexUpdate(this)\" >Delete</span ></li >";
			echo "</ul >";
		echo "</div >";
		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyLinks</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="behavior/behavior.js?behavior=b"></script>
<script type="text/javascript" src="behavior/functions.js?function=f"></script>
<style type="text/css" >
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
    margin:0;
    padding:0;
    border:0;
}
ol, ul {
    list-style:none;
}
table {
    border-collapse:separate;
    border-spacing:0;
}
</style>
<style type="text/css" >

/* Gradient */

#header, #menu-content-left span {
	background-image: -webkit-gradient(linear,left top,left bottom,from(#BA1E28),to(#BA1E28));
	background-image: -webkit-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -moz-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -ms-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -o-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: linear-gradient(top,#BA1E28,#BA1E28);
}
#menu-header-bar a, #menu-header-logout a {
	background-image: -webkit-gradient(linear,left top,left bottom,from(#3A1B1D),to(#3A1B1D));
	background-image: -webkit-linear-gradient(top,#3A1B1D,#3A1B1D);
	background-image: -moz-linear-gradient(top,#3A1B1D,#3A1B1D);
	background-image: -ms-linear-gradient(top,#3A1B1D,#3A1B1D);
	background-image: -o-linear-gradient(top,#3A1B1D,#3A1B1D);
	background-image: linear-gradient(top,#3A1B1D,#3A1B1D);
}


/* HTML */

#body {
	overflow-y:scroll;
}
#wrapper {
	font-family:verdana,arial,sans-serif;
	font-size:14px;
	color:#3A1B1D;
}


/* Header */

#header {
	height:35px;
	background-color:#BA1E28;
}
#inner-header {
	width:1000px;
	margin:0 auto;
}

/* Menu-Bar */

#menu-header-bar {
	display:inline-block;
	float:left;
	padding-top:2px;
}
#menu-header-bar ul {
	display:block;
}
#menu-header-bar li {
	display:inline-block;
	float:left;
}
#menu-header-bar a {
	display:block;
	width:100px;
	color:#FFC1CA;
	line-height:30px;
	text-align:center;
	text-decoration:none;
	background-color:#3A1B1D;
	border-left:1px solid #FFC1CA;
}
#menu-header-bar li:first-child > a {
	border-left:0;
	border-radius:0 0 0 5px;
	-moz-border-radius:0 0 0 5px;
	-webkit-border-radius:0 0 0 5px;
}
#menu-header-bar li:last-child > a {
	border-right:0;
	border-radius:0 0 5px 0;
	-moz-border-radius:0 0 5px 0;
	-webkit-border-radius:0 0 5px 0;
}

/* Menu-Logout */

#menu-header-logout {
	display:inline-block;
	float:right;
	padding-top:2px;
}
#menu-header-logout ul {
	display:block;
}
#menu-header-logout li {
	display:block;
}
#menu-header-logout a {
	display:block;
	width:100px;
	color:#FFC1CA;
	line-height:30px;
	text-align:center;
	text-decoration:none;
	background-color:#3A1B1D;
}
#menu-header-logout a {
	border-radius:0 0 5px 5px;
	-moz-border-radius:0 0 5px 5px;
	-webkit-border-radius:0 0 5px 5px;
}


/* Content */

#content {
}
#inner-content {
	width:1000px;
	margin:0 auto;
}
#inner-content-left {
	float:left;
	width:200px;
	border-bottom-left-radius:5px;
	border-bottom-right-radius:5px;
}
#inner-content-right {
	float:right;
	width:800px;
}
#message-content-right {
	text-align:center;
}
#html-content-right {
}

/* Menu-Content-Left */

#menu-content-left {
	padding-top:30px;
}
#menu-content-left ul {
	text-align:center;
}
#menu-content-left li {
	padding:0 30px;
}
#menu-content-left span {
	cursor:pointer;
	display:block;
	color:#FFC1CA;
	line-height:28px;
	background-color:#BA1E28;
}
#menu-content-left span {
	border-left:1px solid #3A1B1D;
	border-right:1px solid #3A1B1D;
	border-top:1px solid #3A1B1D;
	border-radius:5px 5px 5px 5px;
	-moz-border-radius:5px 5px 5px 5px;
	-webkit-border-radius:5px 5px 5px 5px;
}
#menu-content-left li:last-child > span {
	border-bottom:1px solid #3A1B1D;
}

/* HTML-Content-Right */

#html-content-right input[type=text] {
	outline:none;
	color:#BA1E28;
	padding:4px 5px;
}
#html-content-right .link-button {
	cursor:pointer;
	color:#FFFE10;
	font-size:12px;
	text-shadow:0 1px rgba(255,254,16,0.2);
	padding:2px 10px;
	border-radius:3px;
	background-color:#BA1E28;
	background-image: -webkit-gradient(linear,left top,left bottom,from(#BA1E28),to(#BA1E28));
	background-image: -webkit-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -moz-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -ms-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -o-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: linear-gradient(top,#BA1E28,#BA1E28);
}
#html-content-right .link-span {
	cursor:default;
	color:#BA1E28;
	padding:2px 5px;
}
#html-content-right .link-span:hover {
	cursor:pointer;
	color:#FFFE10;
	border-radius:4px;
	padding:2px 5px;
	background-color:#BA1E28;
	background-image: -webkit-gradient(linear,left top,left bottom,from(#BA1E28),to(#BA1E28));
	background-image: -webkit-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -moz-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -ms-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -o-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: linear-gradient(top,#BA1E28,#BA1E28);
}
#inner-content .button-span {
	cursor:pointer;
	outline:none;
	color: #FFFE10;
	font-size:12px;
	text-shadow:0 1px rgba(255,254,16,0.2);
	padding:2px 5px;
	border: 1px solid #BA1E28;
	border-radius:3px;
	background-color: #BA1E28;
	background-image: -webkit-gradient(linear,left top,left bottom,from(#BA1E28),to(#BA1E28));
	background-image: -webkit-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -moz-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -ms-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -o-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: linear-gradient(top,#BA1E28,#BA1E28);
}
#inner-content .button-span:hover {
	box-shadow: 0 1px 8px 1px rgba(51,51,51,20);
}
#html-content-right button {
	cursor:pointer;
	color:#FFFE10;
	font-size:12px;
	text-shadow:0 1px rgba(255,254,16,0.2);
	border: 1px solid #BA1E28;
	padding:2px 10px;
	border-radius:3px;
	background-color:#BA1E28;
	background-image: -webkit-gradient(linear,left top,left bottom,from(#BA1E28),to(#BA1E28));
	background-image: -webkit-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -moz-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -ms-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: -o-linear-gradient(top,#BA1E28,#BA1E28);
	background-image: linear-gradient(top,#BA1E28,#BA1E28);
}
#html-content-right button:hover {
	box-shadow: 0 1px 8px 1px rgba(51,51,51,20);
}
</style>
</head>
<body id="body" >
    <div id="wrapper" >
    	<div id="header" >
        	<div id="inner-header" >
            	<div id="menu-header-bar" >
                    <ul >
                		<li ><a href="/MyLinks/" >Home</a ></li >
            			<li ><a href="/MyLinks/sistema/?index=view" >View</a ></li >
                		<li ><a href="/MyLinks/sistema/?index=update" >Update</a ></li >
                    </ul >
                </div >
                <div id="menu-header-logout" >
                    <ul >
                		<li ><a href title="Logout" >Logout</a ></li >
                    </ul >
                </div >
            </div >
        </div >
        <div id="content" >
        	<div id="inner-content" >
            	<div id="inner-content-left" >
                <?php
				
					$index = isset($_GET['index']) ? $_GET['index'] : "";
					if ( !empty($index) ) {
						switch( $index ) {
							case "view":
								IndexView();
							break;
							case "update":
								IndexUpdate();
							break;
						}
					}
				
				?>
                </div >
                <div id="inner-content-right" >
                	<div id="message-content-right" >
                    </div >
                    <div id="html-content-right" >
                    </div >
                </div >
          	</div >
      	</div >
        <div id="footer" >
        	<div id="inner-footer" >
          	</div >
      </div >
</div >
</body>
</html>