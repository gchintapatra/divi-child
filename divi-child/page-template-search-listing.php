<?php
/* Template Name: search listing */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
?>

<div id="main-content" class="searchListP">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				
<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
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

				<?php endif;  ?>

					<div class="entry-content">
					
					<?php
           //if(!isset($_GET['q'])):
						the_content();
          //endif;
						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
 if(isset($_GET['q'])){
     if(isset($_GET['size']))
     {
        $page = $_GET['size'];
     }else{
        $page = 1;
     }
    $request = wp_remote_get("http://165.22.186.14/api/v1/search/2?q=".$_GET['q']."&size=10&page=".$page);
    $results = json_decode( wp_remote_retrieve_body( $request ) );
	$arrElements = count($results);
	?>
       
<style>
  .probox{display: flex; justify-content: center;  align-items: center;}
#ajaxsearchlite1 .probox, div.asl_w .probox{
background-image: radial-gradient(ellipse at center,#30324E,#30324E);
}
#main-header{background-color: #00092d !important;}
#et-main-area{margin-top:0px;}
.entry-content{width:100%; margin:0 auto; padding:0px 0px;}
.card {
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2);
  width: 100%;
  padding: 8px 32px;
  margin: 0 0 10px;
  background:#F6F6F5;
  display:flex;
  align-items: center;
}
.card  a{display:inline-block;}
.card .imagePan{margin-right:16px;}
.card .imagePan img{height:100px; min-width: 68px; object-fit: cover;}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #00092D;
  text-align: center;
  cursor: pointer;
  width: 50%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
.pagination {
  display: inline-block;
  float: right;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: #2AB3BB;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #00557D;}
#main-footer{clear: both;}

.searchContent{width: 80%; margin: 30px auto;}
.searchListP{max-height: none!important; min-height: fit-content!important;}
</style>
<div class="searchContent">

<?php if(!empty($results)){
	foreach($results as $each_arr){?>
	<div class="card">
    <a class="imagePan" href="<?php echo home_url().'/search-details/?showType=details&UID='.$each_arr->UID.'&q='.$s; ?>"><img src="<?php echo $each_arr->image;?>" alt="<?php echo $each_arr->title; ?>" ></a>
	  <div class="right-cont">
		  <a href="<?php echo home_url().'/search-details/?showType=details&UID='.$each_arr->UID.'&q='.$s;?>"><?php echo $each_arr->originalTitle.' ('.$each_arr->year.')'; ?></a>
		  <p>
		    <?php $casts=explode(",",$each_arr->casts); ?>
			<?php if(!empty ($each_arr->type)){ echo 'Type:&nbsp;'.$each_arr->type.'&nbsp;&nbsp;';}?>
			<?php if(!empty ($each_arr->genres)){ echo 'Genres:&nbsp;'.$each_arr->genres[0].'&nbsp;&nbsp;';}?>
			<?php if(!empty ($each_arr->casts)){ echo 'Casts:&nbsp;'.$casts[0].',&nbsp;'.$casts[1].',&nbsp;'.$casts[2];}?>
		 </p>
	  </div>
	</div>
<?php } ?>
  </div>
<div id="LoadingImage" style="margin-left:43%; display:none;">
 <img class="article-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ajax-loader2.gif" border="0" >
</div>
<div class="pagination" style="margin:0 auto; margin-right:45%;">
<a href="javascript:void(0);" class="active load_more" data-page-count="<?php echo '2';?>" data-search="<?php echo $_GET['q'];?>">Load More ...</a>
</div>
                
<?php } } ?>
					</div>

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article>

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>

<?php endif; ?>

</div>
<script>
  jQuery(window).load(function() {   
     function setHeight() {
         windowHeight = jQuery(window).innerHeight();
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
