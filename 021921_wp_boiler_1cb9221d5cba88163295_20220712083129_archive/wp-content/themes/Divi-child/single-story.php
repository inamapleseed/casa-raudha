<?php get_header(); 
$page_id = 855;
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
                    <img src="<?php echo get_field('image_story'); ?>" alt="image">
                </div>
				
				<div class="content-container">
					<?php echo get_field('article_contents'); ?>
				</div>
			</div>
			<div class="share-this">
				<label class="text-label">Share</label><?php echo get_field('addthis_code', 'option');?>
			</div>
            <p class="date my-date"><img class="calendar-icon" src="../../wp-content/themes/Divi-child/img/slicings/cal.png" alt="calendar"><span><?php echo get_the_date( 'F d, Y' ); ?></span></p>
            <div class="p">
                <?php echo get_field('story'); ?>
            </div>
			<?php endwhile; ?>
		</div>
    </div>
    <?php endif; ?>
<?php get_footer(); ?>