<?php
	/* error_reporting(E_ALL);
	ini_set('display_errors', 'on'); */
	include __DIR__ . '/incl/process.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shortener</title>
		<meta charset="utf-8">
		<meta name="description" content="Shorten your URL with this tool.">
		<link rel="stylesheet" type="text/css" href="stylesheet/style.css">
    		<meta property="og:title" content="Shortener | abbe.dev">
	    	<meta property="og:type" content="website">
		<meta property="og:image" content="incl/favico/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="180x180" href="incl/favico/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="incl/favico/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="incl/favico/favicon-16x16.png">
		<link rel="manifest" href="incl/favico/site.webmanifest">
	</head>
	<body>
		<h1><img src="incl/favico/favicon-32x32.png" alt="icon"> URL shortener.</h1>
		<div>
  			<form method="post">
   				<label for="fname">Your URL...</label>
    				<input type="text" id="fname" name="url" placeholder="https://www.example.cx">
   				<label for="result">Your shortened URL: <a id="link" style="<?= !$validateURL ? "color: red; text-decoration: none;" : "" ?>" href="<?= $uniqueid ?>"><?= $validateURL ? "https://short.abbe.dev/" . $uniqueid : $message ?></a></label>
				<button type="button" onclick="myFunction()">Copy &#128279;</button>
    			<input type="submit" value="Submit">
  		    </form>
		</div>
	</body>
	<script src="js/script.js"></script>
</html>
