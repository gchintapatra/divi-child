<?php

function my_theme_enqueue_styles() { 

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


add_action( 'init', 'my_script_enqueuer' );

function my_script_enqueuer() {
   wp_register_script( "load_more_script", get_stylesheet_directory_uri().'/page_load_more.js', array('jquery') );
   wp_localize_script( 'load_more_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'load_more_script' );

}

add_action("wp_ajax_load_more_post", "load_more_post");
add_action("wp_ajax_nopriv_load_more_post", "load_more_post");

function load_more_post() {  
    $page_count = $_REQUEST["page_count"];
    $q = $_REQUEST["q"];
    $next_page= $page_count+1;
    
    $request = wp_remote_get("http://165.22.186.14/api/v1/search/2?q=".$q."&size=12&page=".$page_count);
    $results = json_decode( wp_remote_retrieve_body( $request ) );
    $data='';
    if(!empty($results)){
        foreach($results as $each_arr){
            $data .='<div class="card">';
            $data .='<a class="imagePan" href="'.home_url().'/search-details/?showType=details&UID='.$each_arr->UID.'&q='.$s.'"><img src="'.$each_arr->image.'" alt="'.$each_arr->title.'" ></a>';
            $data .='<div class="right-cont">';
           // $data .='<p class="price"></p>';
            $data .='<a href="'.home_url().'/search-details/?showType=details&UID='.$each_arr->UID.'&q='.$s.'">'.$each_arr->originalTitle.' ('.$each_arr->year.')'.'</a>';
            $data .='<p>';
              if(!empty ($each_arr->type))
              { 
                $data .= 'Type:&nbsp;'.$each_arr->type.'&nbsp;&nbsp;';
              }
             if(!empty ($each_arr->genres)){ 
               $data .='Genres:&nbsp;'.$each_arr->genres[0].'&nbsp;&nbsp;';
               }
            if(!empty ($each_arr->casts)){ 
               $casts=explode(",",$each_arr->casts);
               $data .='Casts:&nbsp;'.$casts[0].',&nbsp;'.$casts[1].',&nbsp;'.$casts[2];
            }
            $data .='</p>';
            $data .='</div></div>';
        }
    }

    $response = array('next_page'=>$next_page,'data'=>$data);
    $response = json_encode($response);
    echo $response; die();
}
function cmpCountry($a, $b){
	if($a==$b) {return 0;}
	return ($a < $b) ? -1: 1;
}
//redirect to registration page after certain number of visit by a user
//add_action('wp','check_userActivity');
function check_userActivity(){
	global $post;
	$registrationPage = 'https://flickshow.org/registration/';
	$pageurl = $registrationPage; //page url to redirect
	$pageid=$post->ID;
    if(is_user_logged_in()){
        return false;
    }
	$c = $_COOKIE["user_search_activity"];
	if($c!=''){
		$cookie_name = "user_search_activity";
		if($c==30){
			//wp_redirect($pageurl);
            //$ret = '<div class="asl_nores">
                //<span class="asl_nores_header">Results: Please login/register to do more searches!</span>
            //</div>';
            $ret = 'redirectToRegister';
            return $ret;
			exit;
		}else{
			$cookie_value = $c + 1;
			setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60), "/");
		}
	}else{
		$cookie_name = "user_search_activity";
		$cookie_value = "1";
		setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60), "/");
	}
}

add_filter('asl_before_ajax_output','search_result_filter_Custom', 10, 4 );
function search_result_filter_Custom($html_results, $id, $results, $args){
    if(count($results)>0){
        $ret = check_userActivity();
    }
    return ($ret)?$ret:$html_results;
}
