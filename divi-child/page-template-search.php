<?php
/* Template Name: search Details Page */
get_header();
$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
?>
<style>
.detailP{display:none;}
.bgBlue{background: #01092e; border-top: 2px solid #828699;}
.showDetail{width: 80%; max-width: 1080px; margin:0px auto; color: #fff; padding-bottom:50px; font-family: 'Montserrat', sans-serif; font-weight: 400; font-size: 14px; line-height: 125%;}
.sdTop{display: flex; justify-content: space-between;  padding-top: 70px;}
.sdtl{width: 30%;}
.sdtl img{width: 100%;}
.sdtr{width: 65%;}
.sdtr h2{ font-weight: bold; font-size: 30px; font-family: 'Montserrat', sans-serif; margin-bottom: 30px; color: #fff;}
.sdtr h2 span{display: inline-flex; font-size: 15px; font-weight: normal; margin-top: 0px; color: #fafdfd;}
.starPan{ display: flex; align-items: center;}
.starPan b{ font-size: 16px; font-weight: 600; display: flex; align-items: center; margin-right: 46px;}
.starPan b img{margin-right: 10px;}
.starPan span{ font-size: 15px; font-weight: 400; color: #fafdfd; margin-left: 0px;}
.mInfo{ display: flex; align-items: center; font-size: 15px; color: #fafdfd; margin-top: 15px; font-weight: 300;}
.mInfo label{ width: 30%; padding-right:16px; color: #2cbbc2; font-weight: 500; font-size: 18px;}  
.mInfo p{ width: 70%;}

.sdBottom h5{color: #2cbbc2; font-size: 18px; margin: 40px 0 20px; font-family: 'Montserrat', sans-serif;}
.sdBottom p{color: #fafdfd; font-size: 15px; line-height: 22px; font-weight: 300;}
.strWrap{display: flex; justify-content: space-between; margin: 30px 0;}
.strL{background: #010620; padding: 30px; width: calc(80% - 16px);}
.strTop{display: flex; justify-content: space-between; margin-bottom: 40px;}
.strTop h3{font-family: 'Montserrat', sans-serif; color:#fff;}
.stR select{ background: none; color: #ccc; font-size: 16px; outline: none; border: none;  border-bottom: 1px solid #ccc; padding:8px;}
.stR select option{color: #010620;} 
.strR{ display: flex; flex-direction: column; width: 20%; align-items: center; justify-content: center; background: #010620; }
.strR p a{font-family: 'Montserrat', sans-serif; font-size: 16px; color:#fff;}
.strR span{ display: block; color: #ffffff; margin: 0 0 30px 0; font-size: 22px;}
.strR h3{font-family: 'Montserrat', sans-serif; font-size: 24px; color:#fff;}
.lbBoxWrap{display: flex; justify-content: space-between;}
.lBox{background: #010620; padding: 30px; width: 50%;}
.rBox{background: #010620; padding: 30px; width: 45%;}
.lbBoxWrap h3{ padding: 0 4px; margin-bottom: 40px; font-family: 'Montserrat', sans-serif; color:#fff;}
.lWrap{display: flex; flex-wrap: wrap;}
.lWrap span{display: inline-block; margin: 4px; width:15%;}
.lWrap.rt span{width:20%;}

.pageBottom{text-align: center; margin: 110px 0 0;}
.pageBottom h2{ margin-bottom: 40px; color:#fff;}
.pageBottom .bButton{background: #2ab3bb; color: #fff; font-size: 16px; cursor: pointer; padding: 20px; display: inline-block; border: none;}

.logoWrap{display: flex; flex-wrap: wrap;}
.logoWrap span{width: 10%; margin-right: 5px;}
.logoWrap span img{width: 100%;}

@media only screen and (max-width: 600px){
.showDetail{padding:16px; width: 100%;}
.sdtr h2 {margin-bottom: 10px;}
.sdtr h2 span{margin-top: 5px;}

.mInfo{flex-direction: column; align-items: flex-start;}
.mInfo label{margin-bottom:5px;}
.lbBoxWrap{flex-direction: column;}
.lBox{width: 100%; margin-bottom:30px;}
.rBox{width: 100%;}
.strWrap{flex-direction: column;}
.strL{width: 100%;}
.strR{width: 100%; margin: 16px 0 0; padding-bottom: 24px;}
.logoWrap span{width: 25%;}
.strR span{margin: 30px 0 30px 0;}
.pageBottom{margin: 50px 0;}
.strTop{flex-direction: column; align-items: center; text-align: center;}
.strR h3{padding-bottom: 30px;}
.stR{width: 100%;}
.stR select{width: 100%;}
.starPan span{ margin-top:0!important;}
.sdTop{flex-direction: column;}
.sdtl {width: 100%; margin-bottom:32px;}
.sdtr {width: 100%;}

}
</style>
<?php if ( ! $is_page_builder_used ) : ?>
<div class="container bgBlue">
<?php endif; ?>
  <?php while ( have_posts() ) : the_post(); ?>
   <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	  <?php if ( ! $is_page_builder_used ) : ?>
		  <?php
			$thumb = '';
			$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );
			$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
			$classtext = 'et_featured_image';
			$titletext = get_the_title();
			$alttext = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
			$thumbnail = get_thumbnail( $width, $height, $classtext, $alttext, $titletext, false, 'Blogimage' );
			$thumb = $thumbnail["thumb"];
			if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
				print_thumbnail( $thumb, $thumbnail["use_timthumb"], $alttext, $width, $height );
		 ?>
	  <?php endif; ?>
	  <div class="entry-content">
	  	<?php
		  the_content();
		  if ( ! $is_page_builder_used )
		  wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
		  $request = wp_remote_get("http://165.22.186.14/api/v1/get/".$_GET['UID']);
		  $uid=$_GET['UID'];
		  $results = json_decode( wp_remote_retrieve_body( $request ) );
		  $allCountries=$results->streamingCountries;
		  usort($allCountries, "cmpCountry");
		  $countryUsa=array_search("United States of America", $allCountries, true);
		  if($countryUsa !=false) {unset($allCountries[$countryUsa]); array_unshift($allCountries, "United States of America");}
		  //echo $countryUsa.'&nbsp;Gowranga';
		  //print_r($allCountries);
		?>
		  <div class="content bgBlue">
		  	  <div class="showDetail">
			    <div class="sdTop">
					<div class="sdtl">
					  	<img src="<?php echo $results->image; ?>">
				    </div>
					<div class="sdtr">
					   <?php $genres=explode(',',$results->genres); ?>
					   <?php $casts=explode(',',$results->casts); ?>
						<?php  if(!empty ($results->title)){?> <h2><?php echo $results->title; ?> <span>(<?php echo $results->year; ?>)</span> <?php }?>    
						<div class="starPan"><b><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/star.png"><?php  echo $results->Score; ?></b> <span><?php  echo $results->Votes; ?>&nbsp;Votes</span></div>
						<?php  if(!empty ($results->type)){?><div class="mInfo"><label>TYPE</label><?php  echo $results->type; ?></div><?php }?>
						<?php  if(!empty ($results->genres)){?><div class="mInfo"><label>GENRE</label><?php  echo $results->genres; ?></div><?php }?>
						<?php  if(!empty ($results->casts)){?><div class="mInfo"><label>CASTS</label><p><?php echo $casts[0].',&nbsp;'.$casts[1].',&nbsp;'.$casts[2].',&nbsp;'.$casts[3]; ?></p></div><?php }?>
						<?php  if(!empty ($results->countries)){?><div class="mInfo"><label>COUNTRY</label><?php  echo $results->countries; ?></div><?php }?>
						<?php  if(!empty ($results->directores)){?><div class="mInfo"><label>DIRECTOR</label><p><?php  echo $results->directores; ?></p></div><?php }?>
						<?php  if(!empty ($results->franchise[0])){?><div class="mInfo"><label>FRANCHISE</label><?php  echo $results->franchise[0]; ?></div><?php }?>
						<?php  if(!empty ($results->platforms)){?><div class="mInfo"><label>PLATFORMS</label><?php  echo $results->platforms; ?></div><?php }?>
						<?php  if(!empty ($results->Companies)){?><div class="mInfo"><label>PRODUCTION<br/>COMPANY</label> <p><?php echo $results->Companies; ?></p></div><?php }?>
						<?php  if(!empty ($results->duration)){?><div class="mInfo"><label>RUNTIME</label><?php  echo $results->duration; ?></div><?php }?>
										
					</div>
				</div> <!--sdTop-->
				<div class="sdBottom">
				<?php if(!empty($results->synopsis)){?>
				    <h5>SINOPSIS</h5>
					<p><?php echo $results->synopsis; ?></p>
					<?php }?>
					<div class="strWrap">
						<div class="strL">
							<div class="strTop">
								<h3 class="stL">Streaming services availability</h3>
								<?php $couSelected=$allCountries[0];?>
								<?php if(!empty($results->streamingCountries)){?>
								<div class="stR">
									<select id="strCountry" onchange="getSelectedCountry(this)">
									<?php foreach($allCountries as $couuntryName => $countryValue){ ?>
										<option id="defaultId" value="<?php echo $countryValue; ?>" ><?php echo $countryValue; ?></option>
									<?php }?>
										<option id="uidval" value="<?=$uid?>" hidden ><?=$uid?></option>
									</select>
								</div>
								<?php }?>
							</div>
							<script type="text/javascript">
							function getSelectedCountry(strCountry){
							var defaultVal=document.getElementById("defaultId").value;
							var selectedText = strCountry.options[strCountry.selectedIndex].innerHTML;
							var country = strCountry.value;
							var uid= document.getElementById("uidval").value;
							//alert("Selected Text: " + selectedText + " Country: " + country + " " +  "Contry: "  + <?=$selCountry?> + " " +  "UID: "  + uid);
							jQuery.ajax({
								type: "POST",
								url : "<?php echo get_stylesheet_directory_uri(); ?>/straming-searvice-filter.php",
								data : "country=" + country + "&uid=" + uid, 
								cache: false,
								success:function(response){
								jQuery("#strLogos").html(response);
								if(response.data != ""){
								 document.getElementById("strLogo").style.display="none";
								 document.getElementById("strLogos").style.display="flex";
								 }
								 else{
									 document.getElementById("strLogo").style.display="flex";
									 document.getElementById("strLogos").style.display="none";
									 }
								}
								});
							}
							</script>
							
							<?php if(!empty($results->streamingServices)){?>
					        <div class="logoWrap" id="strLogo">
							    <?php
								foreach($results->streamingServices as $stremService){
									if($stremService->country == trim($couSelected)){?>
									<span><a href="<?php echo $stremService->url; ?>" target="_blank"><img src="<?php echo $stremService->logo; ?>" title="<?php echo $stremService->name; ?>" /></a></span>
									<?php
									}
								}				 
								?>
							 </div>
							<?php }?>
							 <!--Dispaly response-->
							 <div class="logoWrap" id="strLogos" style="display:none;">Dispaly Ajax Response</div>
						</div>
						<div class="strR">
							<span>Illegal Sites</span>
						   <h3><?php echo $results->piracy; ?></h3>
						   <p><a href="https://bb.vision/online-audits-en/" target="_blank">find out more >></a></p>
						</div>
					</div> <!--strWrap-->
					
					<div class="lbBoxWrap">
						<div class="lBox">
							<?php if(!empty($results->databases)){ ?>
							<h3>Audiovisual Databases</h3>
							<div class="lWrap">
							  <?php foreach($results->databases as $each_log){ ?>
								<span><a href="<?php echo $each_log->url; ?>" target="_blank"><img src="<?php echo $each_log->logo; ?>" title="<?php echo $each_log->name; ?>" ></a></span>
							  <?php } ?>
							</div>
						  <?php } ?>
						</div>
						<div class="rBox">
							<h3>Marketplaces</h3>
							<?php if(!empty($results->marketPlaces)){ ?>
							<div class="lWrap rt">
								<?php foreach($results->marketPlaces as $mktPlaces){ ?>
								<span><img src="<?php echo  $mktPlaces->url; ?>" /></span>
								<?php }?>
							</div>
							<?php }?>
						</div>
					</div> <!--lbBoxWrap-->
				</div> <!--sdBottom-->
				<div class="pageBottom">
					<h2>Is this your title?</h2>
					<a class="bButton" href="https://flickshow.org/register-movies-and-tvshows/" target="_self">Claim your title</a>
				</div>
			  </div> <!--showDetail-->
		  </div> <!--content-->
	  </div> <!--entry-content-->
   </article>
  <?php endwhile; ?>
</div>
<script>
  jQuery(window).load(function() {  
     function setHeight() {
         windowHeight = jQuery('#mainImage').innerHeight()+parseInt(50);
         jQuery('#main-content').css({
      "max-height": windowHeight+"px",
      "min-height": windowHeight+"px"
    });   
     };   
     setHeight();
     jQuery(window).resize(function() {
         setHeight();   
     }); 
 });
</script>
<?php get_footer(); ?>