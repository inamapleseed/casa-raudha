<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content" class="restoration-us">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

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
            ?>

            <div class="end-box">
                <h2 class="global-page-title"><?php echo get_field('page_title'); ?></h2>

                <div class="pdfs">
                    <h3 class="section-titleu"><?php echo get_field('pdf_section_title'); ?></h3>
                    <?php $pdfs = get_field('pdf_repeater'); ?>

                    <div class="pdf-outer">
                        <?php foreach($pdfs as $i => $pdf): ?>
                            <div class="pdf-con">
                                <h4><?php echo $pdf['pdf_title']; ?></h4>

                                <a class="overlay-texts" target="_blank" href="<?php echo $pdf['pdf_file']; ?>">
                                    <?php if($pdf['pdf_title']): ?>
                                        <p><?php echo $pdf['pdf_title']; ?></p>
                                    <?php else: ?>
                                        <h4>Click to View</h4>
                                    <?php endif?>
                                </a>

                                <embed src="<?php echo $pdf['pdf_file']; ?>#toolbar=0" type="application/pdf">
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="videos">
                    <h3 class="section-titleu"><?php echo get_field('videos_section_title'); ?></h3>
                    <p class="desc"><?php echo nl2br(get_field('videos_description')); ?></p>
                    
                    <div class="tab-btn">
                        <?php $vids = get_field('video_repeater'); 
                            foreach($vids as $i => $pdf):
                        ?>
                            <a class="tab-trigger <?php echo $i == 0 ? 'active hidden': 'hidden'; ?>" data-target="#tab<?php echo $i; ?>"><?php echo $pdf['tab_title']; ?></a>
                        <?php endforeach ?>
                    </div>

                    <div class="file-con">
                        <?php foreach($vids as $j => $vid): ?>
                            <div id="tab<?php echo $j; ?>" class="file-inner <?php echo $j == 0 ? 'active': 'hidden'; ?>">
                                <?php foreach($vid['videos'] as $video): ?>
                                    <div class="video-inner" >
                                        <?php echo html_entity_decode($video['video']); ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <script>
                        jQuery('.tab-trigger.hidden').click(function(){
                            //get target
                            let target = jQuery(this).data('target');

                            //remove current active
                            jQuery(this).parent().find('.active').removeClass('active');

                            jQuery(this).removeClass('hidden');
                            jQuery(this).addClass('active');

                            // show active tab content
                            jQuery('.file-con > *').hide();
                            jQuery(target).css('display', 'flex');
                            jQuery(target).css('flex-wrap', 'wrap');
                        })
                    </script>
                </div>

                <div class="end-arts">
                    <h2 class="section-titleu"><?php echo get_field('articles_section_title'); ?></h2>
                    <p class="desc"><?php echo nl2br(get_field('articles_section_description')); ?></p>

    <div>
        <?php
			
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			
			$args = array(
		        'post_type' => 'story',
		        'posts_per_page' => 6,
		        'post_status' => 'publish',
		        'orderby' => 'date',
		        'order' => 'desc',
		        'paged' => $paged,
			);
			
			$query = new WP_Query($args); 


			if($query->have_posts()){
			?>
			<div class="events-container stories-con">
				<div class="events row equal-heights">
					<?php
						
		  				while(($query->have_posts())):
		    			$query->the_post();

		    			$image = get_field('no_image', 'option');
		    			if (get_field('image_story')){
		    				$image = get_field('image_story');
		    			}

		    			if(get_field('story')){
		    				$description = get_field('story');
		    			}
		    			else{
		    				$description = get_the_content();
		    			}

		    			if(strlen($description) > 400){
		    				$description = substr($description, 0, 400);
		    			}
					?>
		    		<div class="boxes ">

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

</div>
                </div>
            </div>
        </div> <!-- .entry-content -->

    <?php
        if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
    ?>

    </article> <!-- .et_pb_post -->

<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->
<script>
	if(navigator.userAgent.match(/Trident\/7\./)) {
		document.body.addEventListener("mousewheel", function() {
			event.preventDefault();
			var wd = event.wheelDelta;
			var csp = window.pageYOffset;
			window.scrollTo(0, csp - wd);
		});
	}

	jQuery(window).on('load', function(){
		
		AOS.init({
			duration: 1000
		});
	});	

	jQuery(".animate-up").attr('data-aos', 'fade-up');
</script>
<?php

get_footer();
