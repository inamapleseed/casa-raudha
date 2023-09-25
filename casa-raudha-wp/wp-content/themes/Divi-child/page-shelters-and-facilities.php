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

        <div class="top-con shelter-box">
            <h2 class="global-page-title"><?php echo get_field('page_title'); ?></h2>
            <p class="description"><?php echo nl2br(get_field('description')); ?></p>

            <div class="animate-up repeater-content">
                <?php $repeater1 = get_field('repeater_shelters');  foreach($repeater1 as $i => $r1): ?>
                    <div class="column-inner">
                        <div >
                            <div class="img">
                                <img src="<?php echo $r1['icon']; ?>" alt="image">
                            </div>

                            <div class="texts">
                                <h3 class="page-sub-title orange"><?php echo nl2br($r1['title']); ?></h3>

                                <div class="inner-texts">
                                    <?php if($r1['repeater_inner1']): ?>
                                        <ul <?php echo !$r1['content_title_1'] && count($r1['repeater_inner1']) > 2 ? 'style="column-count: 2"' : '';?>>

                                            <h5 style="transform: translateX(-16px); <?php echo $r1['content_title_1'] ? '' : 'display: none'; ?>"><?php echo $r1['content_title_1']; ?></h5>

                                            <?php foreach($r1['repeater_inner1'] as $ss => $ri1): ?>
                                                <!-- <div> -->
                                                    <?php foreach($ri1 as $text): ?>
                                                        <li><span><?php echo nl2br($text); ?></span></li>
                                                    <?php endforeach ?>
                                                <!-- </div> -->
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif ?>

                                    <?php if($r1['content_repeater_2']): ?>
                                        <ul>
                                            <h5 style="transform: translateX(-16px); <?php echo $r1['content_title_2'] ? '' : 'display: none'; ?>"><?php echo $r1['content_title_2']; ?></h5>

                                            <?php foreach($r1['content_repeater_2'] as $oo => $ri2): ?>

                                                <?php if($ri2): ?>
                                                    <!-- <div style="<?php echo $oo > 2 ? 'column-count: 2' : ''; ?>"> -->
                                                        <?php foreach($ri2 as $text): ?>
                                                            <li><span><?php echo nl2br($text); ?></span></li>
                                                        <?php endforeach ?>
                                                    <!-- </div> -->
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif ?>
                                </div>
                            </div>
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
