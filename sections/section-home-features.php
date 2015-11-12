<?php
/**
 *  The template for displaying the Features on Home page.
 *
 *  @package WordPress
 *  @subpackage regina-lite
 */
?>
<?php
// Get Theme Mod for Features Panel
$top_box_show = get_theme_mod( 'regina_lite_top_box_show', 1 );
$top_box_title = get_theme_mod( 'regina_lite_top_box_title', __( 'We help people, like you.', 'regina-lite' ) );
$top_box_description = get_theme_mod( 'regina_lite_top_box_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'regina-lite' ) );
$top_box_bookappointmenturl = get_theme_mod( 'regina_lite_top_box_bookappointmenturl', '#' );
$features_general_title = get_theme_mod( 'regina_lite_features_general_title', __( 'Why choose us?', 'regina-lite' ) );
$features_general_description = get_theme_mod( 'regina_lite_features_general_description', __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$features_feature1_title = get_theme_mod( 'regina_lite_features_feature1_title', __( 'Free Support', 'regina-lite' ) );
$features_feature1_description = get_theme_mod( 'regina_lite_features_feature1_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$features_feature1_buttonurl = get_theme_mod( 'regina_lite_features_feature1_buttonurl', '#' );
$features_feature2_title = get_theme_mod( 'regina_lite_features_feature2_title', __( 'Medical Care', 'regina-lite' ) );
$features_feature2_description = get_theme_mod( 'regina_lite_features_feature2_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$features_feature2_buttonurl = get_theme_mod( 'regina_lite_features_feature2_buttonurl', '#' );
$features_feature3_title = get_theme_mod( 'regina_lite_features_feature3_title', __( 'Life Care', 'regina-lite' ) );
$features_feature3_description = get_theme_mod( 'regina_lite_features_feature3_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$features_feature3_buttonurl = get_theme_mod( 'regina_lite_features_feature3_buttonurl', '#' );
$features_feature4_title = get_theme_mod( 'regina_lite_features_feature4_title', __( 'Nervous System', 'regina-lite' ) );
$features_feature4_description = get_theme_mod( 'regina_lite_features_feature4_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
$features_feature4_buttonurl = get_theme_mod( 'regina_lite_features_feature4_buttonurl', '#' );
?>
<div class="container">
    <div class="row">
        <?php if( $top_box_show == 1 ): ?>
            <div class="col-lg-8 col-md-12 col-lg-offset-2">
                <div id="call-out" class="clear">
                    <?php if( $top_box_title ): ?>
                        <h1><?php echo esc_html( $top_box_title ); ?></h1>
                    <?php endif; ?>
                    <?php if( $top_box_description ): ?>
                        <p><?php echo esc_html( $top_box_description ); ?></p>
                    <?php endif; ?>
                    <br />
                    <?php if( $top_box_bookappointmenturl ): ?>
                        <a href="<?php echo esc_url( $top_box_bookappointmenturl ); ?>" class="button white outline" rel="appointment-modal"><?php _e( 'Book Appointment', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                    <?php endif; ?>
                </div><!--#call-out-->
            </div><!--.col-md-8-->
        <?php endif; ?>
        <div class="col-xs-12" style="<?php if( $top_box_show != 1 ): echo 'margin-top: 100px;'; endif; ?>">
            <div class="section-info">
                <?php if( !empty( $features_general_title ) ): ?>
                    <h2><?php echo esc_html( $features_general_title ); ?></h2>
                    <hr>
                <?php endif; ?>
                <?php if( !empty( $features_general_description ) ): ?>
                    <p><?php echo esc_html( $features_general_description ); ?></p>
                <?php endif; ?>
            </div><!--.section-info-->
        </div><!--.col-xs-12-->
        <section id="services-block" class="home content-block">
            <div class="spacer-5x visible-sm visible-xs"></div>
            <div class="col-lg-3 col-sm-6">
                <div class="service">
                    <div class="icon">
                        <span class="nc-icon-outline health_heartbeat-16"></span>
                    </div>
                    <?php if( !empty( $features_feature1_title ) ): ?>
                        <h3><?php echo esc_html( $features_feature1_title ); ?></h3>
                    <?php endif; ?>
                    <?php if( !empty( $features_feature1_description ) ): ?>
                        <p><?php echo esc_html( $features_feature1_description ); ?></p>
                    <?php endif; ?>
                    <br>
                    <?php if( !empty( $features_feature1_buttonurl ) ): ?>
                        <a href="<?php echo esc_url( $features_feature1_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                    <?php endif; ?>
                </div><!--.service-->
            </div><!--.col-lg-3-->
            <div class="col-lg-3 col-sm-6">
                <div class="service">
                    <div class="icon">
                        <span class="nc-icon-outline food_apple"></span>
                    </div>
                    <?php if( !empty( $features_feature2_title ) ): ?>
                        <h3><?php echo esc_html( $features_feature2_title ); ?></h3>
                    <?php endif; ?>
                    <?php if( !empty( $features_feature2_description ) ): ?>
                        <p><?php echo esc_html( $features_feature2_description ); ?></p>
                    <?php endif; ?>
                    <br>
                    <?php if( !empty( $features_feature2_buttonurl ) ): ?>
                        <a href="<?php echo esc_url( $features_feature2_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                    <?php endif; ?>
                </div><!--.service-->
            </div><!--.col-lg-3-->
            <div class="col-lg-3 col-sm-6">
                <div class="service">
                    <div class="icon">
                        <span class="nc-icon-outline health_hospital-32"></span>
                    </div>
                    <?php if( !empty( $features_feature3_title ) ): ?>
                        <h3><?php echo esc_html( $features_feature3_title ); ?></h3>
                    <?php endif; ?>
                    <?php if( !empty( $features_feature3_description ) ): ?>
                        <p><?php echo esc_html( $features_feature3_description ); ?></p>
                    <?php endif; ?>
                    <br>
                    <?php if( !empty( $features_feature3_buttonurl ) ): ?>
                        <a href="<?php echo esc_url( $features_feature3_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                    <?php endif; ?>
                </div><!--.service-->
            </div><!--.col-lg-3-->
            <div class="col-lg-3 col-sm-6">
                <div class="service">
                    <div class="icon">
                        <span class="nc-icon-outline health_brain"></span>
                    </div>
                    <?php if( !empty( $features_feature4_title ) ): ?>
                        <h3><?php echo esc_html( $features_feature4_title ); ?></h3>
                    <?php endif; ?>
                    <?php if( !empty( $features_feature4_description ) ): ?>
                        <p><?php echo esc_html( $features_feature4_description ); ?></p>
                    <?php endif; ?>
                    <br>
                    <?php if( !empty( $features_feature4_buttonurl ) ): ?>
                        <a href="<?php echo esc_url( $features_feature4_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                    <?php endif; ?>
                </div><!--.service-->
            </div><!--.col-lg-3-->
            <div class="clear"></div>
        </section><!--#services-block-->
    </div><!--.row-->
</div><!--.container-->