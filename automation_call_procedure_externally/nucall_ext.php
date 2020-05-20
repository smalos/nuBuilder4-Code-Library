<?php

require_once ('../nucommon.php');

/**
*  Run a nuBuilder Procedure via a cron jobs etc. (eg. nucall_ext.php?p=test&acc=acl_cron_job)
*
*  LICENSE: Anyone is free to copy, modify, publish, use, compile, sell, or
*  distribute this software, either in source code form or as a compiled
*  binary, for any purpose, commercial or non-commercial, and by any means.
* 
*  @version  1.0
*  @updated  20.05.2020
*  @author   kev1n
*  @license  https://unlicense.org/  
* 
*/

$p = $_GET['p']; 		// PHP Procedure code
$acc = $_GET['acc']; 	// Access Level code (May not be assigned to a user for security reasons)

if (!isset($p)) {
    setError('No procedure code is provided.');
}

if (!isset($acc)) {
    setError('No access level code is provided.');
}

$qry = "
	SELECT
		 zzzzsys_php.sph_php AS sph_php    
	FROM zzzzsys_access 
	JOIN zzzzsys_access_php ON zzzzsys_access_id = slp_zzzzsys_access_id
	JOIN zzzzsys_php ON zzzzsys_php_id = slp_zzzzsys_php_id	
	LEFT JOIN zzzzsys_user ON zzzzsys_user.sus_zzzzsys_access_id = zzzzsys_access.zzzzsys_access_id
	WHERE  
	   zzzzsys_user_id is NULL AND
	   zzzzsys_php.sph_code = ? AND 
	   zzzzsys_access.sal_code = ?
";

$rs = nuRunQuery($qry, [$p, $acc]);

if (db_num_rows($rs) != 1) {
    setError('Procedure not found for the access level and procedure code given.');
}

$obj = db_fetch_object($rs);

eval($obj->sph_php);

function setError($h) {
    header("Content-Type: text/html");
    header("HTTP/1.0 400 Bad Request");
    die($h);
}

?>
