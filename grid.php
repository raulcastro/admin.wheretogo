<?php
session_start();
//	error_reporting(E_ALL);
//	ini_set("display_errors", 1);
// var_dump($_GET);

$root = $_SERVER['DOCUMENT_ROOT'];

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

require_once($root.'/Framework/Mysqli_Tool.php');
require_once($root.'/Framework/controlAccess.php');
require_once($root.'/Framework/Connection_Data.php');

$db =  new Mysqli_Tool(DB_HOST, DB_USER, DB_PASS, DB_NAME);

require_once $root.'/views/Layout_View.php';

if ($_SESSION['FBID']):
$control = new controlAccess($db, $_SESSION['FBID']);
if ($control->authorized)
{
	require_once $root.'/backends/admin-backend.php';
	
	$infoRequest	= '';
	$categoryId 	= '';
	$locationId 	= '';
	
	if (isset($_GET['infoRequest']))
	{
		$infoRequest = $_GET['infoRequest'];
	}
	
	if (isset($_GET['categoryId']))
	{
		$categoryId = $_GET['categoryId'];
	}
	
	if (isset($_GET['locationId']))
	{
		$locationId = $_GET['locationId'];
	}
	
	switch ($infoRequest)
	{
		case 'category':
			$section = 'byCategory';
			break;
			
		case 'promoted':
			$section = 'promoted';
			break;
			
		case 'unpublished':
			$section = 'unpublished';
			break;
			
		case 'location':
			$section = 'location';
			break;
	}
	
	$data 		= $backend->loadBackend($section);
	
	switch ($infoRequest)
	{
		case 'category':
			$data['title'] 			= $data['categoryInfo']['name'];
			break;
			
		case 'promoted':
			$data['title'] 			= "Promoted";
			break;
			
		case 'unpublished':
			$data['title'] 			= "Unpublished";
			break;
			
		case 'location':
			$data['title'] 			= "Location";
			break;
	}
	
	
	$data['section'] 		= 'dashboard';
	$data['template-class'] = '';
	$data['icon']			= 'fa-dashboard';
}
else
{
	require_once $root.'/backends/general.php';
	$data 					= $backend->loadBackend('mainSection');
	$data['title'] 			= 'Un Authorized';
	$data['section'] 		= 'unauthorized-page';
	$data['template-class'] = 'log-in';
}
else :
	require_once $root.'/backends/general.php';
	$data 					= $backend->loadBackend('mainSection');
	
	$data['title'] 			= 'Log In';
	$data['section'] 		= 'log-in';
	$data['template-class'] = 'login-page';
endif;

$view 		= new Layout_View($data);
echo $view->printHTMLPage();
?>