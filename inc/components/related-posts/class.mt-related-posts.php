<?php
/**
 * Class MTL_Related_Posts_Output
 *
 * This file does the social sharing handling for the Muscle Core Lite Framework
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite
 * @since		Version 1.0.0
 */
// @todo : more effects for hover images
// @todo: pull in more than post title & date
if( !function_exists( 'CallRelatedPostsClassMTL' ) ) {
    /**
     *
     * Gets called only if the "display related posts" option is checked
     * in the back-end
     *
     * @since   1.0.0
     *
     */
    function CallRelatedPostsClassMTL()
    {
        $display_related_blog_posts = get_theme_mod('regina_lite_enable_related_blog_posts', 1);
        if ($display_related_blog_posts == 1) {
            // instantiate the class & load everything else
            MTL_Related_Posts_Output::getInstance();
        }
    }
    add_action( 'wp_loaded', 'CallRelatedPostsClassMTL');
}
if( !class_exists( 'MTL_Related_Posts_Output' ) ) {
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
			add_action( 'mtl_single_after_content_loop', array( $this, 'output_related_posts' ), 2 );
		}
		/**
		 * Returns the *Singleton* instance of this class.
		 *
		 * @return Singleton The *Singleton* instance.
		 */
		public static function getInstance() {
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
		 *
		 * @param  integer $post_id current post id
		 * @param  integer $number_posts number of posts to fetch
		 *
		 * @return object                  object with posts info
		 */
		public function get_related_posts( $post_id, $number_posts = - 1 ) {
			$related_postsuery = new WP_Query();
			$args              = '';
			if ( $number_posts == 0 ) {
				return $related_postsuery;
			}
			$current_page_id = get_the_id();
			$args = wp_parse_args( $args, array(
				'category__in'        => wp_get_post_categories( $post_id ),
				'ignore_sticky_posts' => 0,
				'posts_per_page'      => 3,
				'post__not_in'        => array( $current_page_id ),
			) );
			$related_postsuery = new WP_Query( $args );
			// reset post query
			wp_reset_postdata();
			wp_reset_query();
			return $related_postsuery;
		}
		/**
		 * Render related posts carousel
		 *
		 * @return string                    HTML markup to display related posts
		 **/
		function output_related_posts() {
			// Check if related posts should be shown
			$related_posts = $this->get_related_posts( $post->ID, get_option( 'posts_per_page' ) );
			// Number of posts to show / view
			$limit = get_theme_mod( 'regina_lite_howmany_blog_posts', 3 );

			if( $related_posts->have_posts() ) {
				echo '<div id="related-posts">';
					echo '<h3>'. __( 'Related Posts', 'regina-lite' ) .'</h3>';
					echo '<div class="row">';
					while( $related_posts->have_posts() ) {
						$related_posts->the_post();
						echo '<div class="col-sm-4">';
							echo '<div class="post">';
								echo '<a href="'. get_the_permalink() .'" title="'. get_the_title() .'">';
									$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'regina-lite-related-posts' );
									if( !empty( $featured_image[0] ) ) {
										echo '<img data-original="'. esc_url( $featured_image[0] ) .'" alt="'. get_the_title() .'" title="'. get_the_title() .'" class="lazy">';
									}
									echo '<div class="inner">';
										printf( '<h6 class="date">%s %s, %s</h6>', get_the_date( 'F' ), get_the_date( 'j' ), get_the_date( 'Y' ) );
										echo '<p class="title">'. get_the_title() .'</p>';
									echo '</div><!--/.inner-->';
								echo '</a>';
							echo '</div><!--/.post-->';
						echo '</div><!--/.col-sm-4-->';
					}
					echo '</div><!--/.row-->';
				echo '</div><!--/#related-posts-->';
			}
			wp_reset_query();
			wp_reset_postdata();
		}
	}
}