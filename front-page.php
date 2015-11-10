<?php
/**
 *  The template for displaying the Front Page.
 *
 *  @package regina-lite
 */
?>
<?php get_header(); ?>


<?php if( 'page' == get_option( 'show_on_front' ) ): ?>
    <?php
    if( is_page_template( 'page-templates/blog-template.php' ) ):
        get_template_part( 'page-templates/blog', 'template' );
    elseif( is_page_template( 'page-templates/sidebar-left.php' ) ):
        get_template_part( 'page-templates/sidebar', 'left' );
    elseif( is_page_template( 'page-templates/sidebar-right.php' ) ):
        get_template_part( 'page-templates/sidebar', 'right' );
    else:
        get_template_part( 'page' );
    endif;
    ?>
<?php else: ?>
    <?php global $container_class; ?>
    <?php
    // Get Theme Mod for Subheader Panel
    $subheader_images_show = get_theme_mod( 'regina_lite_subheader_images_show', 1 );
    $subheader_images_image1 = get_theme_mod( 'regina_lite_subheader_images_image1', get_template_directory_uri() . '/layout/images/home/slide-1.jpg' );
    $subheader_box_show = get_theme_mod( 'regina_lite_subheader_box_show', 1 );
    $subheader_box_title = get_theme_mod( 'regina_lite_subheader_box_title', __( 'We help people, like you.', 'regina-lite' ) );
    $subheader_box_description = get_theme_mod( 'regina_lite_subheader_box_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'regina-lite' ) );
    $subheader_box_bookappointmenturl = get_theme_mod( 'regina_lite_subheader_box_bookappointmenturl', '#' );

    // Get Theme Mod for Features Panel
    $subheader_features_show = get_theme_mod( 'regina_lite_subheader_features_show', 1 );
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

    // Get Theme Mod for Our Team Panel
    $ourteam_general_show = get_theme_mod( 'regina_lite_ourteam_general_show', 1 );
    $ourteam_general_title = get_theme_mod( 'regina_lite_ourteam_general_title', __( 'Our team can help you!', 'regina-lite' ) );
    $ourteam_general_description = get_theme_mod( 'regina_lite_ourteam_general_description', __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
    $ourteam_teammember1_image = get_theme_mod( 'regina_lite_ourteam_teammember1_image', get_template_directory_uri() . '/layout/images/team/team-member-1.jpg' );
    $ourteam_teammember1_name = get_theme_mod( 'regina_lite_ourteam_teammember1_name', __( 'Dr. Steve Leeson', 'regina-lite' ) );
    $ourteam_teammember1_position = get_theme_mod( 'regina_lite_ourteam_teammember1_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
    $ourteam_teammember1_description = get_theme_mod( 'regina_lite_ourteam_teammember1_description', __( 'Dr. Steve Leeson was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
    $ourteam_teammember1_buttonurl = get_theme_mod( 'regina_lite_ourteam_teammember1_buttonurl', '#' );
    $ourteam_teammember2_image = get_theme_mod( 'regina_lite_ourteam_teammember2_image', get_template_directory_uri() . '/layout/images/team/team-member-2.jpg' );
    $ourteam_teammember2_name = get_theme_mod( 'regina_lite_ourteam_teammember2_name', __( 'Dr. Amanda Riss', 'regina-lite' ) );
    $ourteam_teammember2_position = get_theme_mod( 'regina_lite_ourteam_teammember2_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
    $ourteam_teammember2_description = get_theme_mod( 'regina_lite_ourteam_teammember2_description', __( 'Dr. Amanda Riss was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
    $ourteam_teammember2_buttonurl = get_theme_mod( 'regina_lite_ourteam_teammember2_buttonurl', '#' );
    $ourteam_teammember3_image = get_theme_mod( 'regina_lite_ourteam_teammember3_image', get_template_directory_uri() . '/layout/images/team/team-member-3.jpg' );
    $ourteam_teammember3_name = get_theme_mod( 'regina_lite_ourteam_teammember3_name', __( 'Dr. Mick Harold', 'regina-lite' ) );
    $ourteam_teammember3_position = get_theme_mod( 'regina_lite_ourteam_teammember3_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
    $ourteam_teammember3_description = get_theme_mod( 'regina_lite_ourteam_teammember3_description', __( 'Dr. Mick Harold was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
    $ourteam_teammember3_buttonurl = get_theme_mod( 'regina_lite_ourteam_teammember3_buttonurl', '#' );
    $ourteam_teammember4_image = get_theme_mod( 'regina_lite_ourteam_teammember4_image', get_template_directory_uri() . '/layout/images/team/team-member-4.jpg' );
    $ourteam_teammember4_name = get_theme_mod( 'regina_lite_ourteam_teammember4_name', __( 'Dr. Jenna Crew', 'regina-lite' ) );
    $ourteam_teammember4_position = get_theme_mod( 'regina_lite_ourteam_teammember4_position', __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ) );
    $ourteam_teammember4_description = get_theme_mod( 'regina_lite_ourteam_teammember4_description', __( 'Dr. Jenna Crew was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ) );
    $ourteam_teammember4_buttonurl = get_theme_mod( 'regina_lite_ourteam_teammember4_buttonurl', '#' );

    // Get Theme Mod for Testimonials Panel
    $testimonials_general_show = get_theme_mod( 'regina_lite_testimonials_general_show', 1 );
    $testimonials_general_image1 = get_theme_mod( 'regina_lite_testimonials_general_image1', get_template_directory_uri() . '/layout/images/home/testimonial-1.jpg' );
    $testimonials_general_image2 = get_theme_mod( 'regina_lite_testimonials_general_image2', get_template_directory_uri() . '/layout/images/home/testimonial-2.jpg' );
    $testimonials_general_image3 = get_theme_mod( 'regina_lite_testimonials_general_image3', get_template_directory_uri() . '/layout/images/home/testimonial-3.jpg' );
    $testimonials_general_image4 = get_theme_mod( 'regina_lite_testimonials_general_image4', get_template_directory_uri() . '/layout/images/home/testimonial-4.jpg' );
    $testimonials_testimonial1_description = get_theme_mod( 'regina_lite_testimonials_testimonial1_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
    $testimonials_testimonial1_image = get_theme_mod( 'regina_lite_testimonials_testimonial1_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
    $testimonials_testimonial1_name = get_theme_mod( 'regina_lite_testimonials_testimonial1_name', __( 'Jenny Royal', 'regina-lite' ) );
    $testimonials_testimonial1_position = get_theme_mod( 'regina_lite_testimonials_testimonial1_position', __( 'Manager @ REQ', 'regina-lite' ) );
    $testimonials_testimonial2_description = get_theme_mod( 'regina_lite_testimonials_testimonial2_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
    $testimonials_testimonial2_image = get_theme_mod( 'regina_lite_testimonials_testimonial2_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
    $testimonials_testimonial2_name = get_theme_mod( 'regina_lite_testimonials_testimonial2_name', __( 'Jenny Royal', 'regina-lite' ) );
    $testimonials_testimonial2_position = get_theme_mod( 'regina_lite_testimonials_testimonial2_position', __( 'Manager @ REQ', 'regina-lite' ) );
    $testimonials_testimonial3_description = get_theme_mod( 'regina_lite_testimonials_testimonial3_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
    $testimonials_testimonial3_image = get_theme_mod( 'regina_lite_testimonials_testimonial3_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
    $testimonials_testimonial3_name = get_theme_mod( 'regina_lite_testimonials_testimonial3_name', __( 'Jenny Royal', 'regina-lite' ) );
    $testimonials_testimonial3_position = get_theme_mod( 'regina_lite_testimonials_testimonial3_position', __( 'Manager @ REQ', 'regina-lite' ) );
    $testimonials_testimonial4_description = get_theme_mod( 'regina_lite_testimonials_testimonial4_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
    $testimonials_testimonial4_image = get_theme_mod( 'regina_lite_testimonials_testimonial4_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
    $testimonials_testimonial4_name = get_theme_mod( 'regina_lite_testimonials_testimonial4_name', __( 'Jenny Royal', 'regina-lite' ) );
    $testimonials_testimonial4_position = get_theme_mod( 'regina_lite_testimonials_testimonial4_position', __( 'Manager @ REQ', 'regina-lite' ) );
    $testimonials_testimonial5_description = get_theme_mod( 'regina_lite_testimonials_testimonial5_description', __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ) );
    $testimonials_testimonial5_image = get_theme_mod( 'regina_lite_testimonials_testimonial5_image', get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' );
    $testimonials_testimonial5_name = get_theme_mod( 'regina_lite_testimonials_testimonial5_name', __( 'Jenny Royal', 'regina-lite' ) );
    $testimonials_testimonial5_position = get_theme_mod( 'regina_lite_testimonials_testimonial5_position', __( 'Manager @ REQ', 'regina-lite' ) );

    // Get Theme Mod for Speak Panel
    $speak_general_show = get_theme_mod( 'regina_lite_speak_general_show', 1 );
    $speak_general_title = get_theme_mod( 'regina_lite_speak_general_title', __( 'Speak with our doctors', 'regina-lite' ) );
    $speak_general_description = get_theme_mod( 'regina_lite_speak_general_description', __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ) );
    $speak_general_buttonurl = get_theme_mod( 'regina_lite_speak_general_buttonurl', '#' );
    ?>
    <?php if( $subheader_images_show == 1 ): ?>
        <section id="home-slider" class="clear">
            <ul class="clear">
                <?php if( !empty( $subheader_images_image1 ) ): ?>
                    <li><img src="<?php echo esc_url( $subheader_images_image1 ); ?>" alt="<?php bloginfo( 'title' ); ?>" title="<?php bloginfo( 'title' ); ?>"></li>
                <?php endif; ?>
            </ul>
            <div class="clear"></div>
        </section><!--#home-slider-->
    <?php endif; ?>
    <?php if( $subheader_features_show == 1 ): ?>
        <div class="<?php echo $container_class; ?>">
            <div class="row">
                <?php if( $subheader_box_show == 1 ): ?>
                    <div class="col-lg-8 col-md-12 col-lg-offset-2">
                        <div id="call-out" class="clear">
                            <?php if( !empty( $subheader_box_title ) ): ?>
                                <h1><?php echo esc_html( $subheader_box_title ); ?></h1>
                            <?php endif; ?>
                            <?php if( !empty( $subheader_box_description ) ): ?>
                                <p><?php echo esc_html( $subheader_box_description ); ?></p>
                            <?php endif; ?>
                            <br>
                            <?php if( !empty( $subheader_box_bookappointmenturl ) ): ?>
                                <a href="<?php echo esc_url( $subheader_box_bookappointmenturl ); ?>" class="button white outline" rel="appointment-modal"><?php _e( 'Book Appointment', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                            <?php endif; ?>
                        </div><!--#call-out-->
                    </div><!--.col-md-8-->
                <?php endif; ?>
                <div class="col-xs-12">
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
    <?php endif; ?>
    <?php if( $ourteam_general_show == 1 ): ?>
        <?php
        $ourteam_teammembers = array( $ourteam_teammember1_image, $ourteam_teammember2_image, $ourteam_teammember3_image, $ourteam_teammember4_image );

        foreach( $ourteam_teammembers as $key => $ourteam_teammember ):
            if( !empty( $ourteam_teammember ) ):
                $ourteam_members[] = $ourteam_teammember;
            endif;
        endforeach;

        if( count( $ourteam_members ) == 1 ):
            $team_member_class = 'col-lg-12 col-sm-6';
        elseif( count( $ourteam_members ) == 2 ):
            $team_member_class = 'col-lg-6 col-sm-6';
        elseif( count( $ourteam_members ) == 3 ):
            $team_member_class = 'col-lg-4 col-sm-6';
        elseif ( count( $ourteam_members ) == 4 ):
            $team_member_class = 'col-lg-3 col-sm-6';
        endif;
        ?>
        <div class="clear"></div>
        <div class="bg-block">
            <div class="<?php echo $container_class; ?>">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section-info">
                            <?php if( !empty( $ourteam_general_title ) ): ?>
                            <h2><?php echo esc_html( $ourteam_general_title ); ?></h2>
                            <hr>
                        <?php endif; ?>
                        <?php if( !empty( $ourteam_general_description ) ): ?>
                            <p><?php echo esc_html( $ourteam_general_description ); ?></p>
                        <?php endif; ?>
                        </div><!--.section-info-->
                    </div><!--.col-xs-12-->
                    <section id="team-block">
                        <?php if( $ourteam_teammember1_image ): ?>
                            <div class="<?php echo $team_member_class; ?>">
                                <div class="team-member">
                                    <?php if( !empty( $ourteam_teammember1_image ) ): ?>
                                        <img data-original="<?php echo esc_url( $ourteam_teammember1_image ); ?>" alt="<?php if( !empty( $ourteam_teammember1_name ) ): echo esc_attr( $ourteam_teammember1_name ); endif; ?>" title="<?php if( !empty( $ourteam_teammember1_name ) ): echo esc_attr( $ourteam_teammember1_name ); endif; ?>" class="lazy">
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember1_name ) || !empty( $ourteam_teammember1_position ) ): ?>
                                        <div class="inner">
                                            <?php if( !empty( $ourteam_teammember1_name ) ): ?>
                                                <h4 class="name"><?php echo esc_html( $ourteam_teammember1_name ); ?></h4>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember1_position ) ): ?>
                                                <p class="position"><small><?php echo esc_html( $ourteam_teammember1_position ); ?></small></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember1_description ) || !empty( $ourteam_teammember1_buttonurl ) ): ?>
                                        <div class="hover">
                                            <?php if( !empty( $ourteam_teammember1_description ) ): ?>
                                                <div class="description">
                                                    <p><?php echo esc_html( $ourteam_teammember1_description ); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember1_buttonurl ) ): ?>
                                                <div class="read-more">
                                                    <a href="<?php echo esc_url( $ourteam_teammember1_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                                                </div>
                                            <?php endif; ?>
                                        </div><!--.hover-->
                                    <?php endif; ?>
                                </div><!--.team-member-->
                            </div><!--.col-lg-3-->
                        <?php endif; ?>
                        <?php if( $ourteam_teammember2_image ): ?>
                            <div class="<?php echo $team_member_class; ?>">
                                <div class="team-member">
                                    <?php if( !empty( $ourteam_teammember2_image ) ): ?>
                                        <img data-original="<?php echo esc_url( $ourteam_teammember2_image ); ?>" alt="<?php if( !empty( $ourteam_teammember2_name ) ): echo esc_attr( $ourteam_teammember2_name ); endif; ?>" title="<?php if( !empty( $ourteam_teammember2_name ) ): echo esc_attr( $ourteam_teammember2_name ); endif; ?>" class="lazy">
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember2_name ) || !empty( $ourteam_teammember2_position ) ): ?>
                                        <div class="inner">
                                            <?php if( !empty( $ourteam_teammember2_name ) ): ?>
                                                <h4 class="name"><?php echo esc_html( $ourteam_teammember2_name ); ?></h4>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember2_position ) ): ?>
                                                <p class="position"><small><?php echo esc_html( $ourteam_teammember2_position ); ?></small></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember2_description ) || !empty( $ourteam_teammember2_buttonurl ) ): ?>
                                        <div class="hover">
                                            <?php if( !empty( $ourteam_teammember2_description ) ): ?>
                                                <div class="description">
                                                    <p><?php echo esc_html( $ourteam_teammember2_description ); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember2_buttonurl ) ): ?>
                                                <div class="read-more">
                                                    <a href="<?php echo esc_url( $ourteam_teammember2_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                                                </div>
                                            <?php endif; ?>
                                        </div><!--.hover-->
                                    <?php endif; ?>
                                </div><!--.team-member-->
                            </div><!--.col-lg-3-->
                        <?php endif; ?>
                        <?php if( $ourteam_teammember3_image ): ?>
                            <div class="<?php echo $team_member_class; ?>">
                                <div class="team-member">
                                    <?php if( !empty( $ourteam_teammember3_image ) ): ?>
                                        <img data-original="<?php echo esc_url( $ourteam_teammember3_image ); ?>" alt="<?php if( !empty( $ourteam_teammember3_name ) ): echo esc_attr( $ourteam_teammember3_name ); endif; ?>" title="<?php if( !empty( $ourteam_teammember3_name ) ): echo esc_attr( $ourteam_teammember3_name ); endif; ?>" class="lazy">
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember3_name ) || !empty( $ourteam_teammember3_position ) ): ?>
                                        <div class="inner">
                                            <?php if( !empty( $ourteam_teammember3_name ) ): ?>
                                                <h4 class="name"><?php echo esc_html( $ourteam_teammember3_name ); ?></h4>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember3_position ) ): ?>
                                                <p class="position"><small><?php echo esc_html( $ourteam_teammember3_position ); ?></small></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember3_description ) || !empty( $ourteam_teammember3_buttonurl ) ): ?>
                                        <div class="hover">
                                            <?php if( !empty( $ourteam_teammember3_description ) ): ?>
                                                <div class="description">
                                                    <p><?php echo esc_html( $ourteam_teammember3_description ); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember3_buttonurl ) ): ?>
                                                <div class="read-more">
                                                    <a href="<?php echo esc_url( $ourteam_teammember3_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                                                </div>
                                            <?php endif; ?>
                                        </div><!--.hover-->
                                    <?php endif; ?>
                                </div><!--.team-member-->
                            </div><!--.col-lg-3-->
                        <?php endif; ?>
                        <?php if( $ourteam_teammember4_image ): ?>
                            <div class="<?php echo $team_member_class; ?>">
                                <div class="team-member">
                                    <?php if( !empty( $ourteam_teammember4_image ) ): ?>
                                        <img data-original="<?php echo esc_url( $ourteam_teammember4_image ); ?>" alt="<?php if( !empty( $ourteam_teammember4_name ) ): echo esc_attr( $ourteam_teammember4_name ); endif; ?>" title="<?php if( !empty( $ourteam_teammember4_name ) ): echo esc_attr( $ourteam_teammember4_name ); endif; ?>" class="lazy">
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember4_name ) || !empty( $ourteam_teammember4_position ) ): ?>
                                        <div class="inner">
                                            <?php if( !empty( $ourteam_teammember4_name ) ): ?>
                                                <h4 class="name"><?php echo esc_html( $ourteam_teammember4_name ); ?></h4>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember4_position ) ): ?>
                                                <p class="position"><small><?php echo esc_html( $ourteam_teammember4_position ); ?></small></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if( !empty( $ourteam_teammember4_description ) || !empty( $ourteam_teammember4_buttonurl ) ): ?>
                                        <div class="hover">
                                            <?php if( !empty( $ourteam_teammember4_description ) ): ?>
                                                <div class="description">
                                                    <p><?php echo esc_html( $ourteam_teammember4_description ); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if( !empty( $ourteam_teammember4_buttonurl ) ): ?>
                                                <div class="read-more">
                                                    <a href="<?php echo esc_url( $ourteam_teammember4_buttonurl ); ?>" class="button white outline"><?php _e( 'Read more', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                                                </div>
                                            <?php endif; ?>
                                        </div><!--.hover-->
                                    <?php endif; ?>
                                </div><!--.team-member-->
                            </div><!--.col-lg-3-->
                        <?php endif; ?>
                    </section><!--#team-block-->
                </div><!--.row-->
            </div><!--.container-->
        </div><!--.bg-block-->
    <?php endif; ?>
    <?php if( $testimonials_general_show == 1 ): ?>
        <section id="home-testimonials">
            <div class="testimonials">
                <span class="icon nc-icon-glyph ui-2_chat-round-content"></span>
                <div id="testimonials-slider">
                    <ul class="bxslider">
                        <?php if( !empty( $testimonials_testimonial1_description ) || !empty( $testimonials_testimonial1_description ) || !empty( $testimonials_testimonial1_image ) || !empty( $testimonials_testimonial1_name ) || !empty( $testimonials_testimonial1_position ) ): ?>
                            <li>
                                <?php if( !empty( $testimonials_testimonial1_description ) ): ?>
                                    <p class="quote"><?php echo esc_html( $testimonials_testimonial1_description ); ?></p>
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial1_image ) ): ?>
                                    <img src="<?php echo esc_url( $testimonials_testimonial1_image ); ?>" alt="<?php if( !empty( $testimonials_testimonial1_name ) ): echo esc_attr( $testimonials_testimonial1_name ); endif; ?>" title="<?php if( !empty( $testimonials_testimonial1_name ) ): echo esc_attr( $testimonials_testimonial1_name ); endif; ?>" width="90">
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial1_name ) ): ?>
                                    <h5 class="name"><?php echo esc_html( $testimonials_testimonial1_name ); ?></h5>
                                <?php endif ?>
                                <?php if( !empty( $testimonials_testimonial1_position ) ): ?>
                                    <p class="position"><?php echo esc_html( $testimonials_testimonial1_position ); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if( !empty( $testimonials_testimonial2_description ) || !empty( $testimonials_testimonial2_description ) || !empty( $testimonials_testimonial2_image ) || !empty( $testimonials_testimonial2_name ) || !empty( $testimonials_testimonial2_position ) ): ?>
                            <li>
                                <?php if( !empty( $testimonials_testimonial2_description ) ): ?>
                                    <p class="quote"><?php echo esc_html( $testimonials_testimonial2_description ); ?></p>
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial2_image ) ): ?>
                                    <img src="<?php echo esc_url( $testimonials_testimonial2_image ); ?>" alt="<?php if( !empty( $testimonials_testimonial2_name ) ): echo esc_attr( $testimonials_testimonial2_name ); endif; ?>" title="<?php if( !empty( $testimonials_testimonial2_name ) ): echo esc_attr( $testimonials_testimonial2_name ); endif; ?>" width="90">
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial2_name ) ): ?>
                                    <h5 class="name"><?php echo esc_html( $testimonials_testimonial2_name ); ?></h5>
                                <?php endif ?>
                                <?php if( !empty( $testimonials_testimonial2_position ) ): ?>
                                    <p class="position"><?php echo esc_html( $testimonials_testimonial2_position ); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if( !empty( $testimonials_testimonial3_description ) || !empty( $testimonials_testimonial3_description ) || !empty( $testimonials_testimonial3_image ) || !empty( $testimonials_testimonial3_name ) || !empty( $testimonials_testimonial3_position ) ): ?>
                            <li>
                                <?php if( !empty( $testimonials_testimonial3_description ) ): ?>
                                    <p class="quote"><?php echo esc_html( $testimonials_testimonial3_description ); ?></p>
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial3_image ) ): ?>
                                    <img src="<?php echo esc_url( $testimonials_testimonial3_image ); ?>" alt="<?php if( !empty( $testimonials_testimonial3_name ) ): echo esc_attr( $testimonials_testimonial3_name ); endif; ?>" title="<?php if( !empty( $testimonials_testimonial3_name ) ): echo esc_attr( $testimonials_testimonial3_name ); endif; ?>" width="90">
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial3_name ) ): ?>
                                    <h5 class="name"><?php echo esc_html( $testimonials_testimonial3_name ); ?></h5>
                                <?php endif ?>
                                <?php if( !empty( $testimonials_testimonial3_position ) ): ?>
                                    <p class="position"><?php echo esc_html( $testimonials_testimonial3_position ); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if( !empty( $testimonials_testimonial4_description ) || !empty( $testimonials_testimonial4_description ) || !empty( $testimonials_testimonial4_image ) || !empty( $testimonials_testimonial4_name ) || !empty( $testimonials_testimonial4_position ) ): ?>
                            <li>
                                <?php if( !empty( $testimonials_testimonial4_description ) ): ?>
                                    <p class="quote"><?php echo esc_html( $testimonials_testimonial4_description ); ?></p>
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial4_image ) ): ?>
                                    <img src="<?php echo esc_url( $testimonials_testimonial4_image ); ?>" alt="<?php if( !empty( $testimonials_testimonial4_name ) ): echo esc_attr( $testimonials_testimonial4_name ); endif; ?>" title="<?php if( !empty( $testimonials_testimonial4_name ) ): echo esc_attr( $testimonials_testimonial4_name ); endif; ?>" width="90">
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial4_name ) ): ?>
                                    <h5 class="name"><?php echo esc_html( $testimonials_testimonial4_name ); ?></h5>
                                <?php endif ?>
                                <?php if( !empty( $testimonials_testimonial4_position ) ): ?>
                                    <p class="position"><?php echo esc_html( $testimonials_testimonial4_position ); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                        <?php if( !empty( $testimonials_testimonial5_description ) || !empty( $testimonials_testimonial5_description ) || !empty( $testimonials_testimonial5_image ) || !empty( $testimonials_testimonial5_name ) || !empty( $testimonials_testimonial5_position ) ): ?>
                            <li>
                                <?php if( !empty( $testimonials_testimonial5_description ) ): ?>
                                    <p class="quote"><?php echo esc_html( $testimonials_testimonial5_description ); ?></p>
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial5_image ) ): ?>
                                    <img src="<?php echo esc_url( $testimonials_testimonial5_image ); ?>" alt="<?php if( !empty( $testimonials_testimonial5_name ) ): echo esc_attr( $testimonials_testimonial5_name ); endif; ?>" title="<?php if( !empty( $testimonials_testimonial5_name ) ): echo esc_attr( $testimonials_testimonial5_name ); endif; ?>" width="90">
                                <?php endif; ?>
                                <?php if( !empty( $testimonials_testimonial5_name ) ): ?>
                                    <h5 class="name"><?php echo esc_html( $testimonials_testimonial5_name ); ?></h5>
                                <?php endif ?>
                                <?php if( !empty( $testimonials_testimonial5_position ) ): ?>
                                    <p class="position"><?php echo esc_html( $testimonials_testimonial5_position ); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div><!--#testimonials-slider-->
            </div><!--.testimonials-->
            <ul class="images">
                <?php if( !empty( $testimonials_general_image1 ) ): ?>
                    <li><img data-original="<?php echo esc_url( $testimonials_general_image1 ); ?>" alt="<?php _e( 'Testimonials', 'regina-lite' ); ?>" title="<?php _e( 'Testimonials', 'regina-lite' ); ?>" class="lazy"></li>
                <?php endif; ?>
                <?php if( !empty( $testimonials_general_image2 ) ): ?>
                    <li><img data-original="<?php echo esc_url( $testimonials_general_image2 ); ?>" alt="<?php _e( 'Testimonials', 'regina-lite' ); ?>" title="<?php _e( 'Testimonials', 'regina-lite' ); ?>" class="lazy"></li>
                <?php endif; ?>
                <?php if( !empty( $testimonials_general_image3 ) ): ?>
                    <li><img data-original="<?php echo esc_url( $testimonials_general_image3 ); ?>" alt="<?php _e( 'Testimonials', 'regina-lite' ); ?>" title="<?php _e( 'Testimonials', 'regina-lite' ); ?>" class="lazy"></li>
                <?php endif; ?>
                <?php if( !empty( $testimonials_general_image4 ) ): ?>
                    <li><img data-original="<?php echo esc_url( $testimonials_general_image4 ); ?>" alt="<?php _e( 'Testimonials', 'regina-lite' ); ?>" title="<?php _e( 'Testimonials', 'regina-lite' ); ?>" class="lazy"></li>
                <?php endif; ?>
            </ul>
            <div class="clear"></div>
        </section><!--#home-testimonials-->
    <?php endif; ?>
    <?php if( $speak_general_show == 1 ): ?>
        <div class="<?php echo $container_class; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-info">
                        <?php if( !empty( $speak_general_title ) ): ?>
                            <h2><?php echo esc_html( $speak_general_title ); ?></h2>
                            <hr>
                        <?php endif; ?>
                        <?php if( !empty( $speak_general_description ) ): ?>
                            <p><?php echo esc_html( $speak_general_description ); ?></p>
                        <?php endif; ?>
                        <br>
                        <?php if( !empty( $speak_general_buttonurl ) ): ?>
                            <a href="<?php echo esc_url( $speak_general_buttonurl ); ?>" class="button" rel="appointment-modal"><?php _e( 'Book appointment', 'regina-lite' ); ?> <span class="nc-icon-glyph arrows-1_bold-right"></span></a>
                        <?php endif; ?>
                    </div><!--.section-info-->
                </div><!--.col-xs-12-->
            </div><!--.row-->
        </div><!--.container-->
    <?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>