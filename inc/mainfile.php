<?php
/***************************************************************************
application : Budget
Description: Permet de gerer son budget de façon tres simple
Auteur: Johan VIVIEN
Date de creation: 23 janvier 2012
Version: 0.1
Auteur URI: http://www.hotfirenet.com
Copyright (c) 2002-2008 par Johan VIVIEN
***************************************************************************/

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$dbhost = 'localhost';
$dbuname = 'root';
$dbpass = '';
$dbname = 'budget';



function protection() {
	switch($_SERVER['PHP_AUTH_USER'])
	{
		case 'johan':
			$username = 'johan';
			$password = 'InfoCentre/';
			break;
		case 'adeline':
			$username = 'adeline';
			$password = '@mourdemalife';		
			break;				
	}
	
	if (!isset($_SERVER['PHP_AUTH_USER'])
    || $username != $_SERVER['PHP_AUTH_USER']
    || $password != $_SERVER['PHP_AUTH_PW']) {
        header('WWW-Authenticate: Basic realm="Private"');
        header('HTTP/1.0 401 Unauthorized');
        return false;
    }
    return true;
}
?>