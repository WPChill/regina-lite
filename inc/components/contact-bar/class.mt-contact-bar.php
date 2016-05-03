<?php
/**
 * Class MTL_Contact_Bar_Output
 *
 * This file does the handling of the contact bar displayed above the header
 *
 * @author		Cristian Raiber
 * @copyright	(c) Copyright by Macho Themes
 * @link		http://www.machothemes.com
 * @package 	Muscle Core Lite
 * @since		Version 1.0.1
 */
if( !function_exists('CallContactBarClassMTL' ) ) {
    /**
     *
     */
    function CallContactBarClassMTL()
    {
        // instantiate the class & load everything else
        MTL_Contact_Bar_Output::getInstance();
    }
    add_action( 'wp_loaded', 'CallContactBarClassMTL' );
}
if( !class_exists( 'MTL_Contact_Bar_Output' ) ) {
    class MTL_Contact_Bar_Output
    {
        /**
         * @var Singleton The reference to *Singleton* instance of this class
         */
        private static $instance;
        protected function __construct()
        {
            // quickly fetch some vars
            $this->facebook_url = get_theme_mod('regina_lite_contact_bar_facebook_url', '#');
            $this->twitter_url = get_theme_mod('regina_lite_contact_bar_twitter_url', '#');
            $this->youtube_url = get_theme_mod('regina_lite_contact_bar_youtube_url', '#');
            $this->pinterest_url = get_theme_mod('regina_lite_contact_bar_pinterest_url', '#');
            $this->linkedin_url = get_theme_mod('regina_lite_contact_bar_linkedin_url', '#');
            $this->email_addr = get_theme_mod('regina_lite_email', __( 'contact@site.com', 'regina-lite' ) );
            $this->phone_number = get_theme_mod('regina_lite_phone', '+0 332 548 954');
            // add the action hook to generate the HTML output
            add_action( 'mtl_before_header', array( $this, 'contact_bar_output' ), 1 );
        }
        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function getInstance()
        {
            if (null === static::$instance) {
                static::$instance = new static();
            }
            return static::$instance;
        }
        public function contact_bar_output() {
            echo '<header id="sub-header" class="visible-lg">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-xs-12">';
                            if( $this->phone_number ) {
                                echo '<p><span class="nc-icon-glyph tech_mobile-button"></span>&nbsp;&nbsp; '. esc_html( $this->phone_number ) .'</p>';
                            }
                            if( $this->email_addr ) {
                                echo '<p><span class="nc-icon-glyph ui-1_email-83"></span>&nbsp;&nbsp; <a href="mailto: '. sanitize_email( $this->email_addr ) .'" title="'. sanitize_email( $this->email_addr ) .'">'. sanitize_email( $this->email_addr ) .'</a></p>';
                            }
                            if( $this->facebook_url || $this->twitter_url || $this->linkedin_url || $this->youtube_url ) {
                                echo '<ul class="social-link-list">';
                                    if( $this->facebook_url ) {
                                        echo '<li><a href="'. esc_url( $this->facebook_url ) .'" title="'. __( 'Facebook', 'regina-lite' ) .'"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li>';
                                    }
                                    if( $this->twitter_url ) {
                                        echo '<li><a href="'. esc_url( $this->twitter_url ) .'" title="'. __( 'Twitter', 'regina-lite' ) .'"><span class="nc-icon-glyph socials-1_logo-twitter"></span></a></li>';
                                    }
                                    if( $this->linkedin_url ) {
                                        echo '<li><a href="'. esc_url( $this->linkedin_url ) .'" title="'. __( 'LinkedIn', 'regina-lite' ) .'"><span class="nc-icon-glyph socials-1_logo-linkedin"></span></a></li>';
                                    }
                                    if( $this->youtube_url ) {
                                        echo '<li><a href="'. esc_url( $this->youtube_url ) .'" title="'. __( 'YouTube', 'regina-lite' ) .'"><span class="nc-icon-glyph socials-1_logo-youtube"></span></a></li>';
                                    }
                                echo '</ul>';
                            }
                        echo '</div><!--/.col-xs-12-->';
                    echo '</div><!--/.row-->';
                echo '</div><!--/.container-->';
            echo '</header><!--/#sub-header.visible-lg-->';
        }
        /**
         * Private clone method to prevent cloning of the instance of the
         * *Singleton* instance.
         *
         * @return void
         */
        private function __clone()
        {
        }
        /**
         * Private unserialize method to prevent unserializing of the *Singleton*
         * instance.
         *
         * @return void
         */
        private function __wakeup()
        {
        }
    }
}