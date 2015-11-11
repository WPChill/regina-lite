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
<?php global $container_class; ?>
<?php if( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2' ) || is_active_sidebar( 'footer-sidebar-3' ) || is_active_sidebar( 'footer-sidebar-4' ) ): ?>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <?php if( is_active_sidebar( 'footer-sidebar-1' ) ): ?>
                    <div class="col-sm-3">
                        <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                    </div><!--.col-lg-3-->
                <?php endif; ?>

                <?php if( is_active_sidebar( 'footer-sidebar-2' ) ): ?>
                    <div class="col-sm-3">
                        <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                    </div><!--.col-lg-3-->
                <?php endif; ?>

                <?php if( is_active_sidebar( 'footer-sidebar-3' ) ): ?>
                    <div class="col-sm-3">
                        <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                    </div><!--.col-lg-3-->
                <?php endif; ?>

                <?php if( is_active_sidebar( 'footer-sidebar-4' ) ): ?>
                    <div class="col-sm-3">
                        <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
                    </div><!--.col-lg-3-->
                <?php endif; ?>
                <a href="#" class="back-to-top"><span class="nc-icon-glyph arrows-1_bold-up"></span></a>
            </div><!--.row-->
        </div><!--.container-->
    </footer><!--#footer-->
<?php endif; ?>
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