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

            <div class="awareness-box reflection-box">
                <h2 class="animate-up global-page-title"><?php echo get_field('page_title'); ?></h2>
                <p class="animate-up description"><?php echo nl2br(get_field('description')); ?></p>

                <div class="repeater-box">
                    <?php
                        /* 
                        * Paginatation on Advanced Custom Fields Repeater
                        */
                        if( get_query_var('paged') ) { 
                            $page = get_query_var( 'paged' );
                        } else {
                            $page = 1;
                        }

                        // Variables
                        $row              = 0;
                        $content_per_page  = 4; // How many images to display on each page
                        $reflection           = get_field( 'repeater_reflections' );
                        $total            = count( $reflection );
                        $pages            = ceil( $total / $content_per_page );
                        $min              = ( ( $page * $content_per_page ) - $content_per_page ) + 1;
                        $max              = ( $min + $content_per_page ) - 1;

                    // ACF Loop
                    if( have_rows( 'repeater_reflections' ) ) : ?>

                        <?php foreach ($reflection as $i => $r1): 
                            $row++;

                            // Ignore this image if $row is lower than $min
                            if($row < $min) { continue; }

                            // Stop loop completely if $row is higher than $max
                            if($row > $max) { break; } 									
                            ?>
                                    
                            <div class=" row-inner">
                                <div class="img animate-up">
                                    <img src="<?php echo $r1['r_preview_image']; ?>" alt="image">
                                </div>
                                <div class="texts animate-up">
                                    <h3 class="page-sub-title orange"><?php echo $r1['r_title']; ?></h3>
                                    <div class="author"><?php echo $r1['r_author']; ?></div>
                                    <p><?php echo nl2br($r1['r_preview_description']); ?></p>
                                    <?php if($r1['r_pop-up_image'] && $r1['full_text_content']): ?>
                                        <button type="button" data-toggle="modal" data-target="#con<?php echo $i; ?>" class="btn-green-o">Read more ></button>
                                    <?php endif ?>
                                </div>

                                <div class="modal fade" id="con<?php echo $i; ?>" >
                                    <div class="modal-content">
                                        <div class="close-btn">&times;</div>

                                        <div class="modal-body">
                                            <h2><?php echo $r1['r_title']; ?></h2>
                                            <div class="author"><?php echo $r1['r_author']; ?></div>
                                            <img src="<?php echo $r1['r_pop-up_image']; ?>" alt="image">
                                            <p><?php echo nl2br($r1['full_text_content']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ;

                    // Pagination
                    echo paginate_links( array(
                        'base' => get_permalink() . 'page/%#%' . '/',
                        'current' => $page,
                        'total' => $pages,
                        'format' => '%#%/'.$pages,
                        'prev_text' => '<',
                        'next_text' => '>',
                        'show_all' => true,
                    ) );
                    ?>

                    <?php else: ?>
                        No content found
                    <?php endif; ?>    
                </div>
            </div>
        
        </div> <!-- .entry-content -->

    <?php
        if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
    ?>

    </article> <!-- .et_pb_post -->

<?php endwhile; ?>

<script>
    jQuery('.modal').hide();
    jQuery('.btn-green-o').click(function(){
        let target = jQuery(this).data('target');
        jQuery(target).show();
    })
    jQuery('.close-btn').click(function(){
        jQuery(this).parent().parent().hide();
    })
</script>

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
