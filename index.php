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
include 'inc/mainfile.php';
include 'inc/mysql.php';

$ret_p=sql_connect();
if (!$ret_p) {
	echo 'Impossible de se connecter a la base de donnée';
	die();
}

if (!protection()) {
	die();
} 

$user = $_SERVER['PHP_AUTH_USER'];
$action = $_GET['action'];

	switch($action) 
	{
		case 'compte':
			$include = 'views/compte.php';
			break;
			
		case 'synthese':
			$include = 'views/synthese.php';
			break;
			
		case 'gestionCode':
			$include = 'views/gestionCode.php';
			break;
			
		case 'gestionCompte':
			break;			
			
		default:
			$include = 'views/synthese.php';
			break;
	}

include 'header.php';

	if(!empty($include))
		include $include;
		
include 'footer.php'
?>