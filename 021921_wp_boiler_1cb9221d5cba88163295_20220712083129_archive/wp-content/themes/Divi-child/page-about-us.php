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

                <div class="about-box">

                    <div class="mv-box">
                        <div class="m">
                            <img src="<?php echo get_field('tab_1_image'); ?>" alt="iamge">

                            <h3 class="orange page-sub-title"><?php echo get_field('tab_1_title'); ?></h3>

                            <p><?php echo nl2br(get_field('tab_1_description')); ?></p>
                        </div>

                        <div class="v">
                            <img src="<?php echo get_field('tab_2_image'); ?>" alt="iamge">

                            <h3 class="orange page-sub-title"><?php echo get_field('tab_2_title'); ?></h3>

                            <p><?php echo nl2br(get_field('tab_2_description')); ?></p>
                        </div>
                    </div>

                    <div class="roles-box">
                        <h2 class="global-page-title"><?php echo get_field('content_title'); ?></h2>

                        <div class="roles-con">
                            <?php $roles = get_field('content_repeater_row_2'); foreach($roles as $role): ?>
                                <div class="role-inner">
                                    <div class="img">
                                        <img src="<?php echo $role['r_image']; ?>" alt="image">
                                    </div>
                                    <h3 class="orange page-sub-title"><?php echo $role['r_title']; ?></h3>
                                    <p><?php echo $role['r_description']; ?></p>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    
                    <div class="pdf-con">
                        <h2 class="global-page-title"><?php echo get_field('pdf_section_title'); ?></h2>
                        <?php $pdfs = get_field('pdf_repeater'); ?>
                        
                        <div class="tab-btn">
                            <?php foreach($pdfs as $i => $pdf): ?>
                                <a class="tab-trigger <?php echo $i == 0 ? 'active hidden': 'hidden'; ?>" data-target="#tab<?php echo $i; ?>"><?php echo $pdf['tab_title']; ?></a>
                            <?php endforeach ?>
                        </div>

                        <div class="file-con">
                            <?php foreach($pdfs as $j => $pdf): ?>
                                <div id="tab<?php echo $j; ?>" class="file-inner <?php echo $j == 0 ? 'active': 'hidden'; ?>">
                                    <?php foreach($pdf['repeater_file'] as $files): ?>
                                        <div class="pdf-inner" >
                                            <a class="overlay-texts" target="_blank" href="<?php echo $files['file']; ?>">
                                                <?php if($files['title'] || $files['short_description']): ?>
                                                    <h4><?php echo $files['title']; ?></h4>
                                                    <p><?php echo $files['short_description']; ?></p>
                                                <?php else: ?>
                                                    <h4>Click to View</h4>
                                                <?php endif?>
                                            </a>

                                            <embed src="<?php echo $files['file']; ?>#toolbar=0" type="application/pdf">
                                            
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

                                // jQuery(this).removeClass('hidden');
                                jQuery(this).addClass('active');

                                // show active tab content
                                jQuery('.file-con > *').hide();
                                jQuery(target).css('display', 'flex');
                            })
                        </script>
                    </div>

                    <div class="team-box">
                        <h2 class="global-page-title"><?php echo get_field('content_title_3'); ?></h2>

                        <?php $people = get_field('content_repeater_3');?>

                        <div class="team-inner">
                            <div class="nav-box">
                                <?php foreach($people as $m => $p): ?>
                                    <div class="nav-inner <?php echo $m == 0 ? 'active hidden' : 'hidden'; ?>" data-target="#team<?php echo $m; ?>">
                                        <img src="<?php echo $p['content_3_tab_icon']; ?>" alt="<?php echo $p['content_3_tab_title']; ?>">
                                        <h4><?php echo $p['content_3_tab_title']; ?></h4>
                                    </div>
                                <?php endforeach ?>
                            </div>

                            <div class="e-outer">
                                <?php foreach($people as $h => $p2): ?>
                                    <div id="team<?php echo $h; ?>" class="e-inner <?php echo $h == 0 ? 'active': 'hidden'; ?>">
                                        <?php foreach($p2['repeater_employees'] as $mjh => $e): ?>
                                            <div style="background: url('<?php echo $e['e_image']; ?>'); background-repeat: no-repeat; background-position: center; background-size: cover" class="e-box <?php echo $p2['image_style']; ?>">

                                                <a class="overlay-text teammate" data-toggle="modal" data-target="#con<?php echo $h . '_' . $mjh; ?>" >
                                                    <h4><?php echo $e['e_title']; ?></h4>
                                                    <h5><?php echo $e['e_position']; ?></h5>
                                                </a>

                                                <div class="modal fade" id="con<?php echo  $h . '_' . $mjh; ?>" >
                                                    <div class="modal-content">
                                                        <div class="close-btn">&times;</div>

                                                        <div class="modal-body">
                                                            <h2><?php echo $e['e_position']; ?></h2>
                                                            <div class="content">
                                                                <div class="image">
                                                                    <img src="<?php echo $e['e_image']; ?>" alt="image">
                                                                </div>

                                                                <div class="texts">
                                                                    <h3 class="author"><?php echo $e['e_title']; ?></h3>
                                                                    <p><?php echo nl2br($e['e_description']); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>                                           
                                        <?php endforeach ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <script>
                            jQuery('.nav-inner.hidden').click(function(){
                                //get target
                                let target2 = jQuery(this).data('target');

                                //remove current active
                                jQuery(this).parent().find('.active').removeClass('active');

                                // jQuery(this).removeClass('hidden');
                                jQuery(this).addClass('active');

                                // show active tab content
                                jQuery('.e-outer > *').hide();
                                jQuery(target2).css('display', 'flex');
                            })
                        </script>
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
    jQuery('.teammate').click(function(){
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
