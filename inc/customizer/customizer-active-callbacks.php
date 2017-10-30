<?php

function regina_lite_check_related_posts() {

	$related_posts = get_theme_mod( 'regina_lite_enable_related_blog_posts', true );
	if ( $related_posts ) {
		return true;
	}

	return false;

}

function regina_lite_check_blue_box() {

	$top_box = get_theme_mod( 'regina_lite_top_box_show', true );
	if ( $top_box ) {
		return true;
	}

	return false;

}

function regina_lite_check_breadcrumbs() {

	$breadcrumbs = get_theme_mod( 'regina_lite_enable_post_breadcrumbs', true );
	if ( $breadcrumbs ) {
		return true;
	}

	return false;

}

function regina_lite_check_postmeta() {

	$postmeta = get_theme_mod( 'regina_lite_enable_post_posted_on_blog_posts', true );
	if ( $postmeta ) {
		return true;
	}

	return false;

}
