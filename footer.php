<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package regina-lite
 */
?>
<?php
$widget_args = array(
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'before_widget' => '<div id="%1$s" class="block %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6><small>',
    'after_title'   => '</small></h6>'
);
?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <?php if( is_active_sidebar( 'footer-sidebar-1' ) ): ?>
                <div class="col-sm-3">
                    <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                </div><!--.col-sm-3-->
            <?php else: ?>
                <div class="col-sm-3">
                    <?php the_widget( 'WP_Widget_Text', 'title=About Regina Lite&text=Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', $widget_args ); ?>
                </div><!--/.col-sm-3-->
            <?php endif; ?>

            <?php if( is_active_sidebar( 'footer-sidebar-2' ) ): ?>
                <div class="col-sm-3">
                    <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                </div><!--.col-sm-3-->
            <?php else: ?>
                <div class="col-sm-3">
                    <?php the_widget( 'WP_Widget_Meta', '', $widget_args ); ?>
                </div><!--.col-sm-3-->
            <?php endif; ?>

            <?php if( is_active_sidebar( 'footer-sidebar-3' ) ): ?>
                <div class="col-sm-3">
                    <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                </div><!--.col-lg-3-->
            <?php else: ?>
                <div class="col-sm-3">
                    <?php the_widget( 'Regina_Lite_Widget_Contact', 'title=Contact&phone=(650) 652-8500&email=contact@mediplus.com&facebook_link=#&twitter_link=#&linkedin_link=#&youtube_link=#', $widget_args ); ?>
                </div><!--.col-lg-3-->
            <?php endif; ?>

            <?php if( is_active_sidebar( 'footer-sidebar-4' ) ): ?>
                <div class="col-sm-3">
                    <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
                </div><!--.col-lg-3-->
            <?php else: ?>
                <div class="col-sm-3">
                    <?php the_widget( 'Regina_Lite_Widget_Address', 'title=Address&address=Medplus<br />33 Farlane Street<br />Keilor East<br />VIC 3033, New York', $widget_args ); ?>
                </div><!--.col-lg-3-->
            <?php endif; ?>
            <a href="#" class="back-to-top"><span class="nc-icon-glyph arrows-1_bold-up"></span></a>
        </div><!--.row-->
    </div><!--.container-->
</footer><!--#footer-->
<footer id="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php echo get_theme_mod('regina_lite_footer_copyright', sprintf( '&copy; %s', __('Macho Themes 2015. All Rights Reserved', 'regina-lite') ) ); ?>
                <ul class="link-list hidden-xs">
                    <?php
                    wp_nav_menu( array(
                        'theme_location'    => 'secondary',
                        'menu'              => '',
                        'container'         => '',
                        'container_class'   => '',
                        'container_id'      => '',
                        'menu_class'        => '',
                        'menu_id'           => '',
                        'items_wrap'        => '%3$s',
                        'walker'            => new MTL_Extended_Menu_Walker(),
                        'fallback_cb'       => 'MTL_Extended_Menu_Walker::fallback'
                    ) );
                    ?>
                </ul>
            </div>
        </div><!--.row-->
    </div><!--.container-->
</footer><!--#sub-footer-->
<?php get_search_form(); ?>
<?php wp_footer(); ?>
</body>
</html>