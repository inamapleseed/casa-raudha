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

						<div class="prevention-box get-involved-box">
                            <h2 class="animate-up global-page-title"><?php echo get_field('page_title'); ?></h2>
                            <p class="animate-up description"><?php echo nl2br(get_field('description')); ?></p>

                            <div class="repeater-box">
                                <?php $repeater1 = get_field('repeater_involved');  foreach($repeater1 as $i => $r1): ?>
                                    <div class=" row-inner <?php echo $i % 2 ? 'even' : 'odd'; ?>">
                                        <div class="img animate-up">
                                            <img src="<?php echo $r1['image']; ?>" alt="image">
                                        </div>
                                        <div class="texts animate-up">
                                            <h3 class="page-sub-title orange"><?php echo $r1['r_title']; ?></h3>
                                            <div class="p">
                                                <p><?php echo nl2br($r1['r_description']); ?></p>
                                            </div>
                                            <div class="btn-con" style="<?php echo $r1['button_name'] ? '' : 'display: none !important'; ?>">
                                                <a class="btn-green"  <?php echo $r1['button_link'] ? 'href="'.$r1['button_link'].'"' :''; ?>><?php echo $r1['button_name']; ?></a>
                                            </div>
                                            <?php if($r1['second_set']): ?>
                                                <h3 style="margin-top: 40px;" class="page-sub-title orange"><?php echo $r1['title_2']; ?></h3>
                                                <div class="p">
                                                    <p><?php echo nl2br($r1['description_2']); ?></p>
                                                </div>
                                                <div class="btn-con" style="<?php echo $r1['button_name2'] ? '' : 'display: none !important'; ?>">
                                                <a class="btn-green" <?php echo $r1['button_link_2'] ? 'href="'.$r1['button_link_2'].'"' :''; ?>><?php echo $r1['button_name2']; ?></a>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
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
