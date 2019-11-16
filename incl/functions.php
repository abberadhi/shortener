<?php
/*
	Functions for shortener.
*/

function generate_unique_id() {
	/*
	Generates random binary ID. 
	Returns the ID.
	*/
	$onetwo = ["&zwj;", "&zwnj;"];
	$uniqueid = '';
	for ($i = 0; $i < 8; $i++) {
		$uniqueid .= $onetwo[rand(0, 1)];
	}

	return $uniqueid;
}

function connect_to_database() {
    /*
    Connects to DB and returns object.
    */
    $config = parse_ini_file('/var/db.ini');
    $dbname = $config['db'];

	try {
        $conn = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8", $config['username'], $config['password']);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
        
    } catch(PDOException $e) {
        echo "Connection failed";
    }
}

function createInsertToDatabase($uniqueid, $url) {
    /*
    Inserts ID to database, updates if it already exists.
    */
    $db = connect_to_database();
    $sql = <<<EOD
            UPDATE shortenerLogs SET ip=?, link=?, views=0 WHERE id=?
EOD;

    $stmt = $db->prepare($sql);
    $params = [$_SERVER['REMOTE_ADDR'], $url, $uniqueid];
    $stmt->execute($params);
    $res = $stmt->rowCount();

    if ($res == 0) {
        $sql = <<<EOD
            INSERT INTO shortenerLogs (id, ip, link, views) VALUES (?, ?, ?, 0);
EOD;

    $stmt = $db->prepare($sql);
    $params = [$uniqueid, $_SERVER['REMOTE_ADDR'], $url];
    $stmt->execute($params);
    }
}

function get_url($uniqueid) {
    /*
    Grabs URL from database based on ID.
    */
    $db = connect_to_database();
    $sql = <<<EOD
            UPDATE shortenerLogs 
		SET views = views + 1 WHERE id = ?;
EOD;

    $stmt = $db->prepare($sql);
    $params = [$uniqueid];
    $stmt->execute($params);
	
    $sql = <<<EOD
            SELECT * FROM shortenerLogs WHERE id =?;
EOD;

    $stmt = $db->prepare($sql);
    $params = [$uniqueid];
    $stmt->execute($params);
	
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    print_r($res);

    return $res['link'];
}



