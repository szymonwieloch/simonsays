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
<script src="<?php echo get_template_directory_uri() ?>/js/bubbles.js" > </script>

<?php
$sticky = get_option( 'sticky_posts');
rsort( $sticky );
$args = array('post__in' => $sticky, 'ignore_sticky_posts' => 1, 'posts_per_page'   => 100 );
$myposts = get_posts( $args );
$myposts_ids = array();
$double_no = 0;
foreach ( $myposts as $post ) : setup_postdata( $post ); 
        $myposts_ids[] = $post->ID;
        $meta_map = simonsays_simplify_custom_fields(get_post_custom());
        //print_r(simonsays_simplify_custom_fields(get_post_custom()));
        if (!empty($meta_map) or has_post_thumbnail()): ?>
        <article class="wide-box double-box <?php echo (($double_no %2 ==0) ? 'even-box':'odd-box'); $double_no += 1;?>">
            <div class="half-box promo-img-half-box">
                <?php if (!empty($meta_map)) : ?>
                    <canvas id="canvas-<?php the_ID() ?>" width="800" height="600" class=""></canvas>
                    <script>
                        drawBubbles('canvas-<?php the_ID()?>', <?php echo json_encode($meta_map)?>);
                    </script>
                <?php else : ?>
                    <?php the_post_thumbnail('full', array('class' => 'promo-img fadein-on-scroll')); ?>
                <?php endif; ?>
            </div>
            <div class="half-box promo-text-half-box">
                <div class="promo-text-box">
                    <h1 class="wide-title" ><?php the_title();?></h1>
                    <div>
                        <?php the_content();?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </article>
        <?php else: ?>
            <article class="wide-box single-box">
                <div class="promo-text-box">
                    <h1 class="wide-title"><?php the_title();?></h1>
                    <div>
                        <?php the_content();?>
                    </div>
                </div>
                <div class="clear"></div>
            </article>
        <?php endif; ?>
        
    
<?php endforeach; 
wp_reset_postdata(); 
?>
<section class="wide-box single-box">
<h1 class="wide-title"> <?php esc_html_e( 'Random Posts', 'simonsays' ) ?></h1>

<?php 
    //how to disable the promo category?
    $args = array( 'posts_per_page' => 12, 'orderby' => 'rand', 'exclude' => $myposts_ids);
    $postslist = get_posts( $args );
    foreach ( $postslist as $post ) :
        setup_postdata( $post );
        require get_template_directory() . '/inc/post-list.php';
    endforeach; 
    wp_reset_postdata();
?>
<div class="clear"></div>
</section>

<?php get_footer(); ?>