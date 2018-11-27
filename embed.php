<?php
	error_reporting(0);
	include "curl_gd.php";
	$base_url = 'https://shinznime.herokuapp.com';

	if(isset($_GET['id'])){
		$eid = htmlspecialchars($_GET['id']);
		$gid = my_simple_crypt($eid, 'd');
		$results = file_get_contents($base_url.'/json.php?url=https://drive.google.com/file/d/'.$gid.'/preview');
		$results = json_decode($results, true);
		if($results['file']==1){
	    echo '<center>Sorry, the owner hasn\'t given you permission to download this file.</center>';
			exit;
	  }elseif($results['file']==2) {
			echo '<center>Error 404. We\'re sorry. You can\'t access this item because it is in violation of our Terms of Service.</center>';
			exit;
	  }
	}

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $results['title'];?></title>
	<!-- Plyr.io Player -->
	<link rel="stylesheet" href="https://cdn.plyr.io/3.3.12/plyr.css">
		<style type="text/css">
		video {
		  background-color: #FFF!important;
		  background-image: /* our video */;
		  background-position: center center;
		  background-size: contain;
		}
		#video-bg {
		  position: fixed;
		  top: 0; right: 0; bottom: 0; left: 0;
		  overflow: hidden;
		}
		#video-bg > video {
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		}
		/* 1. No object-fit support: */
		@media (min-aspect-ratio: 16/9) {
		  #video-bg > video { height: 300%; top: -100%; }
		}
		@media (max-aspect-ratio: 16/9) {
		  #video-bg > video { width: 300%; left: -100%; }
		}
		/* 2. If supporting object-fit, overriding (1): */
		@supports (object-fit: cover) {
		  #video-bg > video {
		    top: 0; left: 0;
		    width: 100%; height: 100%;
		    object-fit: cover;
		  }
		}
	</style>
</head>
<body style="margin:0px;">
	<div id="video-bg">
	<video poster="<?php echo $results['image']; ?>" id="player" playsinline controls>
		<source src="<?php echo $results['file'];?>" type="<?php echo $results['type'];?>">
	</video>
	</div>
	<!-- Plyr JS -->
	<script src="https://cdn.plyr.io/3.3.12/plyr.js"></script>
	<script>const player = new Plyr('#player');</script>
  </body>
</html>
