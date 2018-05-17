<?php

if ( ! class_exists( 'MTL_Entry_Meta_Output' ) ) {
	class MTL_Entry_Meta_Output {

		/**
		 * @var Singleton The reference to *Singleton* instance of this class
		 */
		private static $instance;
		protected function __construct() {
			add_action( 'mtl_entry_meta', array( $this, 'entry_meta_output' ), 1 );
			add_action( 'mtl_single_after_content', array( $this, 'entry_footer_output' ), 1 );
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
		public function entry_meta_output() {
			// quickly fetch some vars
			$display_post_posted_on_meta = get_theme_mod( 'regina_lite_enable_post_posted_on_blog_posts', 1 );
			$display_post_esrt_meta      = get_theme_mod( 'regina_lite_enable_post_esrt_blog_posts', 1 );

			if ( 1 == $display_post_posted_on_meta ) {
				echo '<div class="entry-meta">';
				echo $this->posted_on_output();
				echo '</div>';
			}

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
		 * Function to estimate the reading time of a post, based on the average reading speed of 200 words / minute
		 */
		function reading_time_output() {
			$post    = get_post();
			$words   = str_word_count( strip_tags( $post->post_content ) );
			$minutes = floor( $words / 200 );
			if ( $minutes >= 1 ) {
				$estimated_time = $minutes . __( ' min. read', 'regina-lite' );
			} else {
				$estimated_time = sprintf( '%s', __( '1 min. read', 'regina-lite' ) );
			}
			echo '<span class="riba-lite-estimated-reading-time">' . $estimated_time . '</span>';
		}
		/**
		 * Prints HTML with meta information for the current post-date/time and author.
		 */
		function posted_on_output() {
			global $post;

			echo '<p class="meta">';

			if ( get_post_format() !== false ) {
				$display_author = get_theme_mod( 'regina_lite_post_' . esc_attr( get_post_format( $post->ID ) ) . '_enable_author', 1 );
				$display_date   = get_theme_mod( 'regina_lite_post_' . esc_attr( get_post_format( $post->ID ) ) . '_enable_posted', 1 );
			} else {
				$display_author = get_theme_mod( 'regina_lite_post_standard_enable_author', 1 );
				$display_date   = get_theme_mod( 'regina_lite_post_standard_enable_posted', 1 );
			}
			$posted_on = sprintf(
				esc_html_x( '%s ago', '%s = human-readable time difference', 'regina-lite' ),
				human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
			);
			$byline    = sprintf(
				'%s',
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			printf( '%s %s, %s  -  ', get_the_date( 'F' ), get_the_date( 'j' ), get_the_date( 'Y' ) );

			if ( 1 == $display_author ) {
				printf( '%s ', $byline ); // WPCS: XSS OK.
			}

			$enable_post_category_blog_posts = get_theme_mod( 'regina_lite_enable_post_category_blog_posts', 0 );
			if ( 1 == $enable_post_category_blog_posts ) {
				printf( '- in category %s', get_the_category_list( ', ' ) );
			}

			echo '</p>';

			printf( '<p class="comments">%s</a></p>', regina_lite_get_number_of_comments( $post->ID ) );

			/*
			if( $display_date == 1 ) {
				echo '<span class="posted-on">' . $posted_on . '</span>';
			}
			*/
		}
		/**
		 * Prints HTML with meta information for the categories, tags and comments.
		 */
		public function entry_footer_output() {
			$display_tags_post_meta = get_theme_mod( 'regina_lite_enable_post_tags_blog_posts', 1 );
			# Hide category and tag text for pages.
			if ( 'post' == get_post_type() ) {
				# check if tags post meta is enabled
				if ( 1 == $display_tags_post_meta ) {
					$tags = get_tags();
					if ( $tags ) {
						echo '<ul class="post-tags">';
							echo '<li><p>' . esc_html( 'Tags:', 'regina-lite' ) . '</p></li>';
						foreach ( $tags as $tag ) {
							$tag_link = get_tag_link( $tag->term_id );
							echo '<li><a href="' . esc_url( $tag_link ) . '" title="' . esc_attr( $tag->name ) . '">' . esc_html( $tag->name ) . '</a></li>';
						}
						echo '</ul><!--/.post-tags-->';
					}
				}
			}
		}
	}
}// End if().

if ( ! function_exists( 'call_entry_meta_class' ) ) {


	function call_entry_meta_class() {
		// instantiate the class & load everything else
		MTL_Entry_Meta_Output::get_instance();
	}
	add_action( 'wp_loaded', 'call_entry_meta_class' );
}
