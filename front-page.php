<?php 
get_header(); ?>

<script>
    $(function(){
        $('.fadein-on-scroll').css('opacity', 0);
    });
    $(window).on('scroll', function(){
        console.info('scroll!');
        $('#scroll-img').fadeOut();
        $('.fadein-on-scroll').each(function(){
            var object = $(this);
            if (object.css('opacity') == 0){
                var objectMiddle = object.offset().top + object.outerHeight()/2;
                var windowBottom = $(window).scrollTop() + $(window).height();
                if (objectMiddle<windowBottom){
                    object.animate({'opacity':1}, 2000);
                }
            }
        });
    });

</script>

<?php
$args = null;
$myposts = get_posts( $args );
$double_no = 0;
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
        <?php if (has_post_thumbnail()): ?>
        <article class="wide-box double-box <?php echo (($double_no %2 ==0) ? 'even-box':'odd-box'); $double_no += 1;?>">
            <div class="half-box promo-img-half-box">
                <?php the_post_thumbnail('full', array('class' => 'promo-img fadein-on-scroll'));?>
            </div>
            <div class="half-box promo-text-half-box">
                <div class="promo-text-box">
                    <h1><?php the_title();?></h1>
                    <div>
                        <?php the_content();?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </article>
        <?php else: ?>
            <article class="wide-box single-box ">
                <h1><?php the_title();?></h1>
                <div>
                    <?php the_content();?>
                </div>
                <div class="clear"></div>
            </article>
        <?php endif; ?>
        
    
<?php endforeach; 
wp_reset_postdata(); ?>
<section class="wide-box">
<h1> <?php echo __("Random posts") ?></h1>

<?php 
    //how to disable the promo category?
    $args = array( 'posts_per_page' => 12, 'orderby' => 'rand');
    $postslist = get_posts( $args );
    foreach ( $postslist as $post ) :
        setup_postdata( $post );
        require get_template_directory() . '/inc/post-list.php';
    endforeach; 
    wp_reset_postdata();
?>
</section>

<?php get_footer(); ?>