<?php 
$connectionInfo = array("UID" => USERNAME, "PWD" => PASSWORD, "Database" => DBNAME, "CharacterSet" => "UTF-8", "ReturnDatesAsStrings" => true); 
$conn = sqlsrv_connect(SERVERNAME, $connectionInfo);  


?>