<?php
	header('Content-Type: text/html; charset=UTF-8');
	$name = 'Untitled';
	
	if(!isset($_SESSION)){
		session_start();
	}
?>
<html>
	<head>
		<title><? echo $name; ?></title>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scroll.min.js"></script>
		<script src="js/scripts.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/scrollbar.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div id="page-container">
			<div class="navbar">				
				<div class="navbar-inner">
					<span class="left brand"><? echo $name; ?></span>
					<span class="right brand">Quiz Bowl Database</span>
				</div>
			</div>
			<div class="well">
				<span class="left" id="counts">No results found.</span><span class="right" id="answer">No answer line.</span>
			</div>
			<div class="hero-unit">
				<div id="clue">
					Welcome to my quiz bowl search engine. As long as Quizbowl DB stays down, I'll continue to maintain this.
					It might not be clear, but the search box is actually the blank thing under this box.
					You can type in a keyword, with or without quotes, and this will return all relevant results.
					You can additionally specify conditions for more advanced searches. I'm too lazy to tell you how now, 
					but rest assured, I will put up something eventually. Probably. Hopefully. That's basically it, so have fun and
					win at quiz bowl. Note that most search functionality is not yet implemented, and at this point you can basically
					search by answer.
				</div>
				<br><br>
				<button class="btn btn-medium btn-link left" type="button" disabled="disabled" id="previous">&larr; Previous</button>
				<button class="btn btn-medium btn-link right" type="button" disabled="disabled" id="next">Next &rarr;</button>
			</div>
			<form class="form-search" id="search">
				<input type="text" class="input-block-level" id="search-text" placeholder="">
			</form>
			<div class="well" id="footer">
				<span class="left">Created By Sanjay Kannan.</span><span class="right">Hacked Together In An Evening.</span>
			</div>
		</div>
	</body>
</html>