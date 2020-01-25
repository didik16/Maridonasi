
<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<!-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</head>
<body>


	<div class="row" style="background:#fff">
          <div id="portfolio-1" class="portfolio-holder portfolio-type-1 sort-by-js" style="position: relative; height: 1664.53px;">

          <div class="portfolio-item portfolio-item-type-5 has-padding w3 animated-eye-icon post-2097 portfolio type-portfolio status-publish has-post-thumbnail hentry portfolio_category-planning" data-portfolio-item-id="2097" data-terms="1" style="position: absolute; left: 585px; top: 1109px;">
            <div class="item-box wow fadeIn" style="visibility: hidden; animation-name: none;">
              <div class="photo">
              	<a href="http://localhost:8000/assets/img/galang_dana/4.jpg" class="gallery-popup"> 
              		<span class="image-placeholder img-3361" style="padding-bottom:82.85714286%"> 
              			<img width="700" height="580" class="lazyload" alt="" src="http://localhost:8000/assets/img/galang_dana/4.jpg" data-srcset="" data-sizes="(max-width: 700px) 100vw, 700px"> 
              		</span> 
              		<span class="on-hover opacity-yes distanced"> </i> </span> 
              	</a> 
              </div>
            </div>
          </div>

		</div>
        </div>

        <script type="text/javascript">
		var portfolioContainers = portfolioContainers || [];
		portfolioContainers.push( {"instanceId":"portfolio-1","instanceAlias":"our-work","baseQuery":{"post_type":["portfolio"],"post_status":"publish","posts_per_page":12,"orderby":"date","page":"","paged":0,"meta_query":[{"key":"_thumbnail_id","compare":"EXISTS"}]},"vcAttributes":{"portfolio_query":"size:12|order_by:date|post_type:portfolio","title":"Our work","description":"What we've done and more projects.<br \/>\nStructural engineering, city urbanism and more.","category_filter":"yes","portfolio_type":"type-1","columns":"inherit","reveal_effect":"fade","portfolio_spacing":"inherit","dynamic_image_height":"no","portfolio_full_width_title_container":"yes","portfolio_full_width":"inherit","pagination_type":"static","more_link":"","endless_auto_reveal":"","endless_show_more_button_text":"Show More","endless_no_more_items_button_text":"No more portfolio items to show","endless_per_page":"","el_class":"","css":""},"postId":0,"count":6,"countByTerms":{"exterior":2,"interior-design":2,"planning":3,"urbanism":1},"lightboxData":null,"filterPushState":false} );
		</script>

<script>
  $('.gallery-popup').magnificPopup({
    type: 'image',
    removalDelay: 300,
    mainClass: 'mfp-fade',
    gallery: {
      enabled: true
    },
    zoom: {
      enabled: true,
      duration: 300,
      easing: 'ease-in-out',
      opener: function(openerElement) {
        return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }
  });
</script>

<!-- 			   			<div class="card-body">
	          <div class="row">
	            <div class="col imgSmall"><img src="http://localhost:8000/assets/img/galang_dana/4.jpg" class="img-fluid"></div>
	            <div class="col imgSmall px-0"><img src="http://localhost:8000/assets/img/galang_dana/4.jpg" class="img-fluid"></div>
	            <div class="col imgSmall"><img src="http://localhost:8000/assets/img/galang_dana/4.jpg" class="img-fluid"></div>
	          </div>
	        </div>
	        -->

	        <!-- jQuery first Code -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
  window.onload = function() {
    $('.imgSmall img').click(function(event) {
    	console.log("Hai")
      var id = $(this).data('id');
      var src = $(this).attr('src');
      var img = $('#imgBig img');

      img.fadeOut('fast', function() {
        $(this).attr({src: src,});
        $(this).fadeIn('fast');
      });
    });
  };
</script>  -->

</body>
</html>