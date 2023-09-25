<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<div id="main-content" class="">

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

            <div class="home-box">
                <div class="slideshow" style="background: <?php echo get_field('background_color_section_1'); ?>">
                    <?php $sliders = get_field('slider_banner'); 
                        foreach($sliders as $slider): 
                    ?>
                    <div class="slideshow-inner" style="background: <?php echo $slider['mobile_background_color']; ?>">
                        <div class="description">
                            <div class="title"><?php echo html_entity_decode($slider['title']); ?></div>
                            <div class="desc"><?php echo html_entity_decode($slider['description']); ?></div>
                        </div>
                        <img src="<?php echo $slider['desktop_banner']; ?>" alt="" class="desktop">
                        <img src="<?php echo $slider['mobile_banner']; ?>" alt="" class="mobile">
                        
                    </div>
                    <?php endforeach ?>
                </div>

                <div class="section-1" style="background: <?php echo get_field('background_color_section_1'); ?>">
                    <div class="inner">
                        <h2 class="section-title global-page-title"><?php echo get_field('title_section_1'); ?></h2>
                        <p class="section-desc"><?php echo get_field('description_section_1'); ?></p>

                        <?php $repeaters1 = get_field('repeater_section_1'); 
                            if($repeaters1):
                        ?>
                            <div class="repeater-con-outer">
                                <?php foreach($repeaters1 as $s1): ?>
                                    <div class="box-outer animate-up">
                                        <?php foreach ($s1['repeater_inner_1'] as $r1): ?>
                                            <div class="box">
                                                <div class="box-inner">
                                                    <?php if($r1['include_icon']): ?>
                                                        <img src="<?php echo $r1['icon']; ?>" alt="image">
                                                    <?php endif ?>

                                                    <div class="text1 text"><?php echo $r1['text_1']; ?></div>
                                                    <div class="count <?php echo strlen($r1['count']) > 5 ? 'smaller' : ''; ?>"><?php echo $r1['count']; ?></div>
                                                    <div class="text2 text <?php echo strlen($r1['count']) > 5 ? 'smaller' : ''; ?>"><?php echo $r1['text_2']; ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                        <a href="<?php echo $s1['button_link']; ?>" class="animate-up" style="background: #3D4423"><?php echo $s1['button_label']; ?></a>
                                    </div>
                                <?php endforeach?>
                            </div>
                        <?php endif?>
                    </div>
                </div>

                <div class="section-2">
                    <?php $rep2 = get_field('repeater_section_2'); 
                        foreach($rep2 as $r2):
                    ?>
                        <div class="inner " style="background: <?php echo $r2['mobile_background_color22']; ?>">
                            <div class="texts <?php echo $r2['text_position'] == 'RIght' ? 'right' : ''; ?>">
                                <h2 style="color:<?php echo $r2['title_2_color']; ?> "><?php echo $r2['title_2']; ?></h2>
                                
                                <p style="color:<?php echo $r2['description_2_color']; ?>"><?php echo $r2['description_2']; ?></p>
                                
                                <a class="btn-green" style="background: <?php echo $r2['button_color']; ?>; color: <?php echo $r2['button_text_color']; ?>" href="<?php echo $r2['button_link_2']; ?>"><?php echo $r2['button_label_2']; ?></a>
                            </div>
                            
                            <img src="<?php echo $r2['mobile_image_2']; ?>" alt="image" class="mobile ">
                            <img src="<?php echo $r2['desktop_image_2']; ?>" alt="image" class="desktop">
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="section-3" style="color: <?php echo get_field('text_section_3_color'); ?>;background: <?php echo get_field('background_color_section_3'); ?>">
                    <div class="inner">
                        <h2 class="global-page-title" style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo get_field('title_section_3'); ?></h2>
                        <p style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo get_field('description_section_3'); ?></p>
                        
                        <div class="content">
                            <?php $re3 = get_field('repeater_section_3'); if($re3): ?>
                                <?php foreach($re3 as $r3): ?>
                                    <div class="content-inner animate-up">
                                        <div class="texts desktop" style="max-width: <?php echo $r3['text_width']; ?>">
                                            <h3 style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo $r3['content_title']; ?></h3>

                                            <p style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo $r3['content_description']; ?></p>

                                            <a style="text-align: center" href="<?php echo $r3['content_button_link']; ?>" class="btn-green"><?php echo $r3['content_button_label']; ?></a>
                                        </div>

                                        <div class="mobile-texts texts">
                                            <div class="top-con">
                                                <img src="<?php echo $r3['mobile_top_image']; ?>" class="mobile">
                                                <h3 style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo $r3['content_title']; ?></h3>
                                            </div>

                                            <div style="background: <?php echo $r3['mobile_body_background_color']; ?>">
                                                <p style="color: <?php echo get_field('text_section_3_color'); ?>"><?php echo $r3['content_description']; ?></p>
                                            </div>

                                            <div class="bottom-con">
                                                <img src="<?php echo $r3['mobile_bottom_image']; ?>" class="mobile">
                                                <a style="text-align: center" href="<?php echo $r3['content_button_link']; ?>" class="btn-green"><?php echo $r3['content_button_label']; ?></a>
                                            </div>
                                        </div>
                                        
                                        <img src="<?php echo $r3['desktop_image3']; ?>" class="desktop">
                                        
                                    </div>
                                <?php endforeach ?>
                            <?php endif?>
                        </div>
                    </div>
                </div>

                <div class="section-4" style="background: <?php echo get_field('background_color_news'); ?>">
                    <?php echo do_shortcode('[homepage_testimonials]')?>
                </div>

                <div class="section-5" style="background: <?php echo get_field('background_color'); ?>">
                    <div class="outer">
                        <h2 class="global-page-title"><?php echo get_field('contact_us'); ?></h2>

                        <div class="map">
                            <?php echo html_entity_decode(get_field('google_map')); ?>
                        </div>

                        <div class="bottom">
                            <div class="info">
                                <h3>Contact Information</h3>
                                <div class="p">
                                    <?php echo html_entity_decode(get_field('contact_information')); ?>
                                </div>
                            </div>

                            <div class="image animate-up">
                                <img src="<?php echo get_field('contact_us_background'); ?>" alt="image">
                            </div>

                            <div class="form">
                                <h3>Message Us</h3>
                                <?php echo do_shortcode(get_field('contact_form_code')); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-6" style="background: <?php echo get_field('background_color_section_6'); ?>;">
                    <div class="outer animate-up">
                        <div class="image">
                            <img src="<?php echo get_field('image_section_6'); ?>" alt="<?php echo get_field('title_section_6'); ?>">
                        </div>

                        <div class="texts">
                            <h2 class="global-page-title" style="color: <?php echo get_field('text_color_section_6'); ?>"><?php echo get_field('title_section_6'); ?></h2>

                            <p style="color: <?php echo get_field('text_color_section_6'); ?>"><?php echo get_field('description_section_6'); ?></p>

                            <a class="btn-green" style="background: <?php echo get_field('button_color'); ?>" href="<?php echo get_field('button_link'); ?>"><?php echo get_field('button_label'); ?></a>
                        </div>
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

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript">
  function initSlick() {
    jQuery('.slideshow').slick({
      dots: false,
      infinite: true,
      speed: 500,
      arrows: true,
      pauseOnHover: false,
      autoplay: false,
      slidesToShow: 1,
		prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='wp-content/themes/Divi-child/img/slicings/general/left1.png'/></div></div>",
		nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='wp-content/themes/Divi-child/img/slicings/general/right1.png'/></div></div>",

    });
  }
  initSlick();
</script>

<?php

get_footer();
