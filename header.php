<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SimonSays
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Francois+One|Lato:400,400i,700,300" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri() ?>/js/jquery.mobile.custom.min.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'simonsays' ); ?></a>

	<header id="masthead" class="site-header">
	<?php if ( ! (is_front_page() && is_home() && has_header_image())) : ?>
		
	<?php endif; ?>

		<nav id="site-navigation" class="main-navigation">
			<a href="<?php echo esc_url( function_exists( 'pll_home_url' )? pll_home_url():home_url( ) ); ?>">
				<?php 
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
				?>
			</a>
			<a href="<?php echo esc_url( function_exists( 'pll_home_url' )? pll_home_url():home_url( ) ); ?>" class="menu-name">
				<?php bloginfo( 'name' ); ?>
			</a>
			
			
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">&#9776;</button>
			
			<div id="menu-widgets">
				<?php
					if(is_active_sidebar('menu-widgets')){
						dynamic_sidebar('menu-widgets');
					}
				?>
			</div>
			
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
		<div class="site-navigation-space"></div>
		<?php if ( is_front_page() && is_home() && has_header_image()) : ?>
			<div class="header-space">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php 
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : 
				?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
				<img src="<?php header_image(); ?>" class="header-custom-image" alt="" />

					<img src="<?php echo get_theme_file_uri("img/scroll.png")?>" alt="Scroll down" id="scroll-down-icon" />

			</div>
			<script>
				//disable the scroll icon on scrolling
				$(function(){
					$(window).on('scroll', function(){
						$('#scroll-down-icon').fadeOut();

					});
				});
			</script>
		<?php endif; ?>
	
	<script>
		$(function(){
			$('.menu-item-has-children > a').on('vclick', function(e){
				console.log('vclick');
				var parent = $(this).parent();
				parent.children('.sub-menu').slideToggle();
				$('.menu-item-has-children').not(parent).children('.sub-menu').slideUp();
				e.preventDefault();
			});
			$(document).on('vclick', function(e){
				var menu = $(e.target).parents().filter('.menu-item-has-children');
				if (menu.length == 0){
					console.log('empty');
					$('.menu-item-has-children').children('.sub-menu').slideUp();
				} else {
					(console.log('full'));
				}

			});
			
			
			
		});
	</script>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
