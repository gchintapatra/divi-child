jQuery(document).ready( function() {

    jQuery(".load_more").click( function(e) {
	  //jQuery("#LoadingImage").show();
	  //e.preventDefault(); 
       page_count = jQuery(this).attr("data-page-count");
       q = jQuery(this).attr("data-search");
       jQuery.ajax({
        type : "post",
        dataType : "json",
        url : myAjax.ajaxurl,
        data : {action: "load_more_post", page_count : page_count, q : q},
		beforeSend: function(){
		// Show image container
		jQuery("#LoadingImage").show();
	   },
        success: function(response) {
		jQuery("#LoadingImage").hide();
           if(response.data != "") {
              jQuery(".searchContent").append(response.data);
              jQuery('.load_more').attr('data-page-count', response.next_page);
           }
           else {
			jQuery("#LoadingImage").hide();
            jQuery(".pagination").css('display','none');
            }
        }
     })   
 
    })
 
 })