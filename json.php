<?php
	header('Content-Type: application/json');
	error_reporting(0);
	include "curl_gd.php";
	$url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : null;
	if(empty($url)) {
	  $url = 'https://drive.google.com/file/d/1VHco1KxapTm40mJ1_PTq5brfU1DHX6aF/view';
	}
	$gid = get_drive_id($url);
	$results = GoogleDrive($gid);
	echo $results;
?>
