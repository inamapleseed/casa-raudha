<?php /* Template Name: Articles Template */

get_header();

// $page_id = 909;

?>
<div class="entry-content-custom">
	<?php
		the_content();
	?>
</div>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<div id="main-content" class="events-wrapper">

	<div class="container" style="padding-top: 0 !important;padding-bottom: 0 !important;padding-left: 0;padding-right: 0;"><!-- container -->
  
		<div id="filter-groups"><!-- filter-groups -->
			<?php
			$args2 = array(
		        'post_type' => 'article',
		        // 'posts_per_page' => 3,
		        'post_status' => 'publish',
		        'orderby' => 'date',
		        'order' => 'desc',
			);

			$agrz = array(
                'taxonomy'  => 'category',				
			);
			$cats = get_categories($argz);

			$query2 = new WP_Query($args2);

			if($query2->have_posts()){
			?>
			<div class="cat-tabs">
				<?php  foreach($cats as $m => $cat):?>
					<a data-target="<?php echo strtolower(str_replace(' ', "", $cat->name)); ?>" class="a"><?php echo $cat->name; ?></a>
				<?php endforeach ?>
			</div>

			<script>
				jQuery('.cat-tabs .a').click(function(){
					//get target
					let target23 = jQuery(this).data('target');
					jQuery(this).parent().find('.active').removeClass('active');

					// jQuery(this).removeClass('hidden');
					jQuery(this).addClass('active');

					// show active tab content
					jQuery('.events .boxes').hide();
					jQuery('.events .' + target23).css('display', 'block');

					//featured
					// find and remove current active slick
					if(jQuery('.active2'))
					//hide current active
					jQuery(this).parent().parent().find('.active2').addClass('hidden');
					jQuery(this).parent().parent().find('.active2').removeClass('active2');
					//add class to new active slick
					jQuery('.top-recent-updates.hidden.' + target23).addClass('active2');
					// show new active slick
					jQuery('.top-recent-updates.hidden.' + target23).removeClass('hidden');

					//hide default slick
					// jQuery('.top-recent-updates.unfiltered').slick('unslick');
					jQuery('.top-recent-updates.unfiltered').hide('');
					
					//set active
					jQuery('.top-recent-updates.active2.' + target23).slick('setPosition').slick();
					
				})
			</script>
			
			<div class="top-recent-updates unfiltered">
				<?php 
                    while($query2->have_posts()):
                        $query2->the_post();

                        $image = get_field('no_image', 'option');
                        if (get_field('image')){
                            $image = get_field('image');
                        }

		    			if(get_field('short_description')){
		    				$description = get_field('short_description');
		    			}
		    			else{
		    				$description = get_the_content();
		    			}

		    			if(get_field('featured_event')){
		    				$featured_event = get_field('featured_event');
		    			
	    		?>

					<div class="boxes">
						<div class="image">
						
							<div class="wrapper">
								<div class="overlay" onclick="window.location = '<?php echo get_the_permalink();?>'" style="cursor: pointer; ">
								<img src="<?php echo $image;?>" alt="">

							</div>
							</div>
						</div>
						<div class="info">
							<a href="<?php echo get_the_permalink();?>"><h3 class="orange page-sub-title"><?php echo get_the_title();?></h3></a>
							<p class="date my-date"><img class="calendar-icon" src="../wp-content/themes/Divi-child/img/slicings/cal.png" alt="calendar"><span><?php echo get_the_date( 'F d, Y' ); ?></span></p>
							<div class="p">
								<?php echo $description; ?>
							</div>
							<a href="<?php echo get_the_permalink();?>" class="btn-green-o">Read More > </a>
						</div>
					</div>
	    		<?php } endwhile;?>
			</div>
			
			<?php 
				$terms = get_terms( array(
					'taxonomy' => 'category',
					'hide_empty' => false,
				) );
				foreach($cats as $m => $cat):
					foreach($terms as $mh => $term):
					if(strtolower(str_replace(' ', "", $term->name)) == strtolower(str_replace(' ', "", $cat->name))):
				?>
					<div class="top-recent-updates hidden <?php echo strtolower(str_replace(' ', "", $cat->name)); ?>">
						<?php 
							while($query2->have_posts()):
								$query2->the_post();

								$image = get_field('no_image', 'option');
								if (get_field('image')){
									$image = get_field('image');
								}

								if(get_field('short_description')){
									$description = get_field('short_description');
								}
								else{
									$description = get_the_content();
								}

								if(get_field('featured_event')){
									$featured_event = get_field('featured_event');

									$term_obj_list = get_the_terms(get_the_ID(), 'category');
									$c2 = $term_obj_list[0]->name; 
									if(strtolower(str_replace(' ', "", $term->name)) == strtolower(str_replace(' ', "", $c2))):
							?>

							<div class="boxes <?php echo $term_obj_list ? strtolower(str_replace(' ', "", $c2)) : ''; ?> ">
								<div class="image">
								
									<div class="wrapper">
										<div class="overlay" onclick="window.location = '<?php echo get_the_permalink();?>'" style="background: url(<?php echo $image;?>) no-repeat;"></div>
									</div>
									<img src="<?php echo $image;?>" alt="">
								</div>
								<div class="info">
									<a href="<?php echo get_the_permalink();?>"><h3 class="orange page-sub-title"><?php echo get_the_title();?></h3></a>
									<p class="date my-date"><img class="calendar-icon" src="../wp-content/themes/Divi-child/img/slicings/cal.png" alt="calendar"><span><?php echo get_the_date( 'F d, Y' ); ?></span></p>
									<div class="p">
										<?php echo $description; ?>
									</div>
									<a href="<?php echo get_the_permalink();?>" class="btn-green-o">Read More > </a>
								</div>
							</div>
						<?php endif ?>
						<?php } endwhile;?>
					</div>

					<script type="text/javascript">
						function initSlick<?php echo $mh; ?>() {
							jQuery('.top-recent-updates.<?php echo strtolower(str_replace(' ', "", $term->name)); ?>').slick({
							dots: true,
							infinite: false,
							speed: 500,
							arrows: false,
							pauseOnHover: false,
							autoplay: false,
							slidesToShow: 1,
								prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><i class='fa fa-chevron-left'></i></div></div>",
								nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><i class='fa fa-chevron-right'></i></div></div>",
							});
						}
						initSlick<?php echo $mh; ?>();
					</script>
				<?php endif ?>

			<?php endforeach ?>
			<?php endforeach ?>

			<?php } ?>

		</div><!-- filter-groups -->
        <script type="text/javascript">
			function initSlick() {
				jQuery('.top-recent-updates.unfiltered').slick({
				dots: true,
				infinite: false,
				speed: 500,
				arrows: false,
				pauseOnHover: false,
				autoplay: false,
				slidesToShow: 1,
					prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><i class='fa fa-chevron-left'></i></div></div>",
					nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><i class='fa fa-chevron-right'></i></div></div>",
				});
			}
			initSlick();
        </script>
		<div class="custom-grid"><!--  -->
			<?php
			
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			
			$args = array(
		        'post_type' => 'article',
		        'posts_per_page' => 6,
		        'post_status' => 'publish',
		        'orderby' => 'date',
		        'order' => 'desc',
		        'paged' => $paged,
			);
			
			if(isset($_REQUEST['m_year']) && $_REQUEST['m_year'] != ""){

        		$year = $_REQUEST['m_year'];
        
        		$args['date_query'] = array(
        			array(
              			'year' => $year
            		),
          		);
        	}
        
        	if(isset($_REQUEST['m_month']) && $_REQUEST['m_month'] != ""){
        
        		$month = $_REQUEST['m_month'];
        
        		$args['date_query'][0]['month'] = $month;
        	}

			$query = new WP_Query($args); 


			if($query->have_posts()){
			?>
			<div class="events-container">
				<div class="events row equal-heights">
					<?php
						
		  				while(($query->have_posts())):
		    			$query->the_post();

		    			$image = get_field('no_image', 'option');
		    			if (get_field('image')){
		    				$image = get_field('image');
		    			}

		    			if(get_field('short_description')){
		    				$description = get_field('short_description');
		    			}
		    			else{
		    				$description = get_the_content();
		    			}

		    			if(strlen($description) > 400){
		    				$description = substr($description, 0, 400);
		    			}
					?>
		    		<div class="boxes
						<?php 
							$term_obj_list = get_the_terms(get_the_ID(), 'category');
							$category2 = $term_obj_list[0]->name; 
							echo $term_obj_list ? strtolower(str_replace(' ', "", $category2)) : ''; ?>
					">

		    			<div class="image">
		    				<div class="wrapper">
		    					<a href="<?php echo get_the_permalink();?>"><img src="<?php echo $image;?>" class="img-responsive" alt="<?php echo get_the_title();?>"></a>
		    				</div>
		    			</div>
		    			<div class="info">
		    				<a href="<?php echo get_the_permalink();?>"><h4 class="orange "><?php echo get_the_title();?></h4></a>
		    				<div class="p">
		    					<?php echo $description;?>
		    				</div>
		    				<a href="<?php echo get_the_permalink();?>" class=" btn-green-o">Read More ></a>
		    			</div>
		    		</div>
		    		<?php endwhile;?>

				</div>
			</div>
			<div class="my-pagination col-md-12 col-sm-12 col-xs-12 nopaddingLR">
			    <?php

			    wp_reset_postdata();

			    $big = 999999999; // need an unlikely integer
			     echo paginate_links( array(
			        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			        'format' => '&paged=%#%',
			        'current' => max( 1, get_query_var('paged') ),
			        'total' => $query->max_num_pages,
			        'next_text' => __('>'),
			        'prev_text' => __('<'),
			    ));
			    ?>
			</div>
			<?php } ?>
		</div><!-- custom-grid -->
	</div><!-- container -->
</div> <!-- #main-content -->
<?php

get_footer();