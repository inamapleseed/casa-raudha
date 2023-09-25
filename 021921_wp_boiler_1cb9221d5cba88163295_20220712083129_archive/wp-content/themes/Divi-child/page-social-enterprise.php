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

						<div class="top-con">
                            <h2 class="animate-up global-page-title"><?php echo get_field('page_title'); ?></h2>
                            <p class="animate-up description"><?php echo nl2br(get_field('description')); ?></p>
                        </div>

                        <div class="restoration-box-bottom social-box">
                            <div class="repeater-box-2">
                                <?php $repeater2 = get_field('repeater_social1');  foreach($repeater2 as $m => $r2): ?>
                                    <div class="repeater-2-inner <?php echo $m % 2 ? 'even' : 'odd'; ?>">
                                        <img class="animate-up " src="<?php echo $r2['r_image']; ?>" alt="image">
                                        <h3 class="animate-up page-sub-title orange"><?php echo $r2['r_title']; ?></h3>
                                        <p><?php echo nl2br($r2['r_description']); ?></p>

                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="repeater-box-2 image-2">
                                <?php $repeater2 = get_field('repeater_social2');  foreach($repeater2 as $m => $r3): ?>
                                    <div class="image-2-con">
                                        <div class="image-2-inner">
                                            <img class="animate-up " src="<?php echo $r3['image_1']; ?>" alt="image">
                                            <img class="animate-up " src="<?php echo $r3['image_2']; ?>" alt="image">
                                        </div>

                                        <div class="texts">
                                            <h3 class="animate-up page-sub-title orange"><?php echo $r3['title_2']; ?></h3>
                                            <p><?php echo nl2br($r3['description_2']); ?></p>
                                        </div>

                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="description-bottom social">
                            <p><?php echo get_field('page_bottom_description'); ?></p>
                        </div>
                        <div class="btn-con protect social">
                            <a class="btn-green" href="<?php echo get_field('button_link_1'); ?>"><?php echo get_field('button_name_1'); ?></a>
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
