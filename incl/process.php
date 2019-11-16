<?php
	include 'functions.php';

	$url = htmlentities($_POST['url']) ?? null;	
	$validateURL = false;

	if (isset($url) && filter_var($url, FILTER_VALIDATE_URL)) {
		$uniqueidFirst = generate_unique_id();
		$validateURL = true;
		$uniqueid = html_entity_decode($uniqueidFirst, ENT_QUOTES, 'UTF-8');
        
        	createInsertToDatabase($uniqueidFirst, $url);
        
		mkdir("./" . $uniqueid, 0777, true);
		$myfile = fopen($uniqueid . "/index.php" , "w") or die('Cannot open file:' . $uniqueid);
		$txt = "<?php include __DIR__ . '/../incl/functions.php'; \$id = \"" . $uniqueidFirst . "\"; \$url = get_url(\$id); header('Location: '. \$url); ?>";
		fwrite($myfile, $txt);
		fclose($myfile);
	} else {
		$message = "URL not valid or non-existent.";
	}

