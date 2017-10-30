<?php
/**
 *  Template name: Homepage Template
 *
 * @package regina-lite
 */
?>
<?php get_header(); ?>
<?php

// Get Theme Mod
$subheader_features_show   = get_theme_mod( 'regina_lite_subheader_features_show', 1 );
$ourteam_general_show      = get_theme_mod( 'regina_lite_ourteam_general_show', 1 );
$testimonials_general_show = get_theme_mod( 'regina_lite_testimonials_general_show', 1 );
$speak_general_show        = get_theme_mod( 'regina_lite_speak_general_show', 1 );
$blog_news_general_show    = get_theme_mod( 'regina_lite_news_general_show', 1 );

get_template_part( 'sections/section', 'home-slider' );

if ( 1 == $subheader_features_show ) :
	get_template_part( 'sections/section', 'home-features' );
endif;

if ( 1 == $ourteam_general_show ) :
	get_template_part( 'sections/section', 'home-our-team' );
endif;

if ( 1 == $testimonials_general_show ) :
	get_template_part( 'sections/section', 'home-testimonials' );
endif;

if ( 1 == $speak_general_show ) :
	get_template_part( 'sections/section', 'home-speak' );
endif;

if ( 1 == $blog_news_general_show ) :
	get_template_part( 'sections/section', 'news' );
endif;

?>
<?php
get_footer();
