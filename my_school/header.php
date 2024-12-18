<head>
	<!-- This site was created by Adam M. Erickson to learn more about PHP in 2012 -->
	<title>Title will be php created in the future</title>
	<!--link rel="stylesheet" type="text/css" href="/templates/CSS/style1.css" media="screen"-->
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>
<body>
	<?php session_start(); echo ('<p>Welcome '.$_SESSION['valid_user'].'</p>'); ?>
	<h1>School Site</h1>
	<hr/>
