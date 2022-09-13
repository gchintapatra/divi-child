<?php
require_once(dirname(__FILE__)."/../../../wp-load.php");
$country=$_POST['country'];
$uid=$_POST['uid'];
$request = wp_remote_get("http://165.22.186.14/api/v1/get/".$uid);
$results = json_decode( wp_remote_retrieve_body( $request ) );
if(!empty($results->streamingServices) && ($country !="streamCon")){
	foreach($results->streamingServices as $stremService){
	  if($stremService->country == trim($country) ){?>
	  	<span><a href="<?php echo $stremService->url; ?>" target="_blank"><img src="<?php echo $stremService->logo; ?>" title="<?php echo $stremService->name; ?>" /></a></span>

	  <?PHP 
	  }
	}
}else{
	foreach($results->streamingServices as $stremService){?>
	<span><a href="<?php echo $stremService->url; ?>" target="_blank"><img src="<?php echo $stremService->logo; ?>" title="<?php echo $stremService->name; ?>" /></a></span>
	<?php 
	}
}
?>