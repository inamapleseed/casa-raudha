<?php get_header(); 
$page_id = 994;
?>

    <?php if(get_field('page_banner', $page_id) || get_field('mobile_page_banner', $page_id)){?>
        <div class="page-banner">
            <?php if(get_field('page_banner', $page_id)){?>
            <img src="<?php echo get_field('page_banner', $page_id);?>" class="img-responsive hidden-xs" alt="<?php echo get_the_title();?>">
            <?php } ?>
            <?php if(get_field('mobile_page_banner', $page_id)){?>
            <img src="<?php echo get_field('mobile_page_banner', $page_id);?>" class="img-responsive visible-xs" alt="<?php echo get_the_title();?>">
            <?php } ?>
        </div>
    <?php } ?>

    <?php
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div id="breadcrumbs" class="container"><div class="wrapper">','</div></div>' );
        }
    ?>
        
    <div class="single_news single-article" id="main-content">
		<div class="container main-container" style="padding-top: 0 !important;padding-bottom: 0 !important;padding-left: 0;padding-right: 0;">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h2 class="global-page-title"><?php echo get_the_title();?></h2>

			<div class="contents">
				<?php if (has_post_thumbnail( $post->ID ) ){ ?>
                    <div class="featured-image">
                        <img src="<?=get_the_post_thumbnail_url(get_the_ID(),'full');?>" class="img-responsive" alt="<?php the_title(); ?>">
                    </div>
				<?php } ?>
                
                <div class="gallery-con">
                    <div>
                        <img src="<?php echo get_field('image'); ?>" alt="image">
                    </div>

                    <?php $gall = get_field('gallery'); 
                        foreach ($gall as $gal):
                    ?>
                        <div>
                            <img src="<?php echo $gal['more_image']; ?>" alt="image">
                        </div>
                    <?php endforeach ?>
                </div>
				
				<div class="content-container">
					<?php echo get_field('article_contents'); ?>
				</div>
			</div>
			<div class="share-this">
				<label class="text-label">Share</label><?php echo get_field('addthis_code', 'option');?>
			</div>
            <p class="dates"><?php echo get_the_date( 'F d, Y' ); ?></p>
            <div class="p">
                <?php echo get_field('full_description'); ?>
            </div>

			<div class="le-navs">
				<div class=" btn-green">Previous<div class="art-btns"><?php previous_post_link(); ?></div></div>
				<div class=" btn-green">Next<div class="art-btns"><?php next_post_link(); ?></div></div>
			</div>
			<?php endwhile; ?>
		</div>
    </div>
    <?php endif; ?>


<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
function initSlick() {
    jQuery('.gallery-con').slick({
    dots: true,
    infinite: true,
    speed: 500,
    arrows: true,
    pauseOnHover: false,
    autoplay: false,
    slidesToShow: 1,
        prevArrow: "<div class='pointer slick-nav left prev absolute'><div class='absolute position-center-center'><img src='../../wp-content/themes/Divi-child/img/slicings/homepage/left2.png' alt='arrow'/></div></div>",
        nextArrow: "<div class='pointer slick-nav right next absolute'><div class='absolute position-center-center'><img src='../../wp-content/themes/Divi-child/img/slicings/homepage/right2.png' alt='arrow'/></div></div>",

    });
}
initSlick();
</script>
<?php get_footer(); ?>