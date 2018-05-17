<?php

/**
 * Class MTL_Related_Posts_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author      Cristian Raiber
 * @copyright   (c) Copyright by Macho Themes
 * @link        http://www.machothemes.com
 * @package     Muscle Core Lite
 * @since       Version 1.0.0
 */
// @todo : more effects for hover images
// @todo: pull in more than post title & date

if ( ! class_exists( 'MTL_Related_Posts_Output' ) ) {

	/**
	 * Class MTL_Related_Posts_Output
	 */
	class MTL_Related_Posts_Output {

		/**
		 * @var Singleton The reference to *Singleton* instance of this class
		 */
		private static $instance;

		/**
		 *
		 */
		protected function __construct() {
			add_action( 'mtl_single_after_article', array( $this, 'output_related_posts' ), 2 );
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Singleton The *Singleton* instance.
		 */
		public static function get_instance() {
			if ( null === static::$instance ) {
				static::$instance = new static();
			}

			return static::$instance;
		}

		/**
		 * Private clone method to prevent cloning of the instance of the
		 * *Singleton* instance.
		 *
		 * @return void
		 */
		private function __clone() {
		}

		/**
		 * Private unserialize method to prevent unserializing of the *Singleton*
		 * instance.
		 *
		 * @return void
		 */
		private function __wakeup() {
		}


		/**
		 * Get related posts by category
		 * @param  integer  $post_id       current post id
		 * @param  integer  $number_posts  number of posts to fetch
		 * @return object                  object with posts info
		 */
		public function get_related_posts( $post_id, $number_posts = -1 ) {

			$related_postsquery = new WP_Query();
			$args               = '';

			if ( 0 == $number_posts ) {
				return $related_postsquery;
			}

			$args = wp_parse_args(
				$args, array(
					'category__in'        => wp_get_post_categories( $post_id ),
					'ignore_sticky_posts' => 0,
					'posts_per_page'      => $number_posts,
					'post__not_in'        => array( $post_id ),
					'meta_key'            => '_thumbnail_id',
				)
			);

			$related_postsquery = new WP_Query( $args );

			return $related_postsquery;
		}

		/**
		 * Render related posts carousel
		 *
		 * @return string                    HTML markup to display related posts
		 **/
		function output_related_posts() {

			// Check if related posts should be shown
			$related_posts = $this->get_related_posts( get_the_ID(), get_option( 'posts_per_page' ) );

			if ( ! $related_posts->have_posts() ) {
				return;
			}

			echo '<div id="related-posts" class="mt-related-posts">';

				// Number of posts to show / view
				$limit = get_theme_mod( 'regina_lite_howmany_blog_posts', 3 );

				// Auto play
				$auto_play = get_theme_mod( 'regina_lite_autoplay_blog_posts', 1 );

				// Pagination
				$pagination = get_theme_mod( 'regina_lite_pagination_blog_posts', 0 );

				/*
				 * Heading
				 */
				echo '<h3>' . __( 'Related posts: ', 'regina-lite' ) . '</h3>';
				echo sprintf( '<div class="owlCarousel" data-slider-id="%s" id="owlCarousel-%s" data-slider-items="%s" data-slider-speed="400" data-slider-auto-play="%s" data-slider-navigation="0" data-slider-pagination="%s">', get_the_ID(), get_the_ID(), $limit, $auto_play, $pagination );

			while ( $related_posts->have_posts() ) {
				$related_posts->the_post();
				$featured_image                  = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'regina-lite-related-posts' );
				$enable_related_title_blog_posts = get_theme_mod( 'regina_lite_enable_related_title_blog_posts', 1 );
				$enable_related_date_blog_posts  = get_theme_mod( 'regina_lite_enable_related_date_blog_posts', 1 );
				$url                             = get_permalink();
				echo '<div class="item clearfix">';
				echo '<div class="col-sm-12">';
				echo '<div class="post">';
					echo '<a href="' . $url . '" title="New medical researches has been found">';
				if ( $featured_image ) {
					echo '<img src="' . esc_url( $featured_image[0] ) . '" data-original="' . esc_url( $featured_image[0] ) . '" alt="' . esc_attr( get_the_title() ) . '" class="lazy">';
				}
						echo '<div class="inner">';
				if ( 1 == $enable_related_date_blog_posts ) {
					echo '<h6 class="date">' . get_the_date( get_option( 'date-format' ), get_the_ID() ) . '</h6>';
				}
				if ( 1 == $enable_related_title_blog_posts ) {
					echo '<p class="title">' . esc_html( get_the_title() ) . '</p>';
				}
						echo '</div><!--/.inner-->';
							echo '</a>';
							echo '</div>';
							echo '</div> <!--/.col-sm-12-->';
							echo '</div><!--/.item-->';
			}
				echo '</div>'; // owl Carousel
			echo '</div><!--/#related-posts.mt-related-posts-->';

			wp_reset_query();
			wp_reset_postdata();
		}
	}
}// End if().

if ( ! function_exists( 'call_related_post_class' ) ) {
	/**
	 *
	 * Gets called only if the "display related posts" option is checked
	 * in the back-end
	 *
	 * @since   1.0.0
	 *
	 */
	function call_related_post_class() {
		$display_related_blog_posts = get_theme_mod( 'regina_lite_enable_related_blog_posts', 1 );

		if ( 1 == $display_related_blog_posts ) {

			// instantiate the class & load everything else
			MTL_Related_Posts_Output::get_instance();
		}
	}
	add_action( 'wp_loaded', 'call_related_post_class' );
}
