<?php 
  require_once 'db.php';
   $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($connection->connect_error) die($connection->connect_error);
		
	function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
	
  }
  ?>