<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package regina-lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function regina_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'regina_lite_body_classes' );

if( ! function_exists( 'regina_lite_breadcrumbs' ) ) {
    /**
     * Render the breadcrumbs with help of class-breadcrumbs.php
     *
     * @return void
     */
    function regina_lite_breadcrumbs() {
        $breadcrumbs = new Riba_Breadcrumbs();
        $breadcrumbs->get_breadcrumbs();
    }

    add_action( 'mtl_breadcrumbs', 'regina_lite_breadcrumbs');
}

if( !function_exists( 'regina_lite_get_number_of_comments' ) ) {
    /**
     * Simple function used to return the number of comments a post has.
     */
    function regina_lite_get_number_of_comments($post_id) {
        $num_comments = get_comments_number($post_id); // get_comments_number returns only a numeric value
        if ( comments_open() ) {
            if ( $num_comments == 0 ) {
                $comments = __('No Comments', 'regina-lite');
            } elseif ( $num_comments > 1 ) {
                $comments = $num_comments . __(' Comments', 'regina-lite');
            } else {
                $comments = __('1 Comment', 'regina-lite');
            }
            $write_comments = '<a href="' . get_comments_link() .'"><span class="nc-icon-outline ui-2_chat-round"></span>'. $comments.'</a>';
        } else {
            $write_comments =  __('Comments are off for this post.', 'regina-lite');
        }
        return $write_comments;
    }
}

if ( ! function_exists( 'regina_lite_content_nav' ) ) {
    /**
     * Display navigation to next/previous pages when applicable
     */
    add_action( 'mtl_single_after_content', 'regina_lite_content_nav', 2 );
    function regina_lite_content_nav()
    {
        global $wp_query, $post;

        // Don't print empty markup on single pages if there's nowhere to navigate.
        if (is_single()) {
            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next = get_adjacent_post(false, '', false);

            if (!$next && !$previous)
                return;
        }

        // Don't print empty markup in archives if there's only one page.
        if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search()))
            return;

        $nav_class = (is_single()) ? 'post-navigation clear' : 'paging-navigation clear';
        ?>
        <nav role="navigation" id="post-navigation" class="<?php echo $nav_class; ?>">
            <?php if (is_single()) : // navigation links for single posts ?>

                <?php previous_post_link('%link', '<span class="nc-icon-glyph arrows-1_bold-left"></span> %title'); ?>
                <?php next_post_link('%link', '%title <span class="nc-icon-glyph arrows-1_bold-right"></span>'); ?>

            <?php elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) : // navigation links for home, archive, and search pages ?>

                <?php if (get_next_posts_link()) : ?>
                    <?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'regina-lite')); ?>
                <?php endif; ?>

                <?php if (get_previous_posts_link()) : ?>
                    <?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'regina-lite')); ?>
                <?php endif; ?>

            <?php endif; ?>
            <div class="clear"></div>
        </nav><!-- #post-navigation -->
        <?php
    }
}

/**
 *  Social Share
 */
if( !function_exists( 'regina_lite_social_share' ) ) {
    $social_sharing_position = get_theme_mod( 'regina_lite_social_sharing_position', 'after_content' );

    if( $social_sharing_position == 'after_content' ) {
        add_action( 'mtl_single_after_content', 'regina_lite_social_share', 3 );
    } elseif( $social_sharing_position == 'before_content' ) {
        add_action( 'mtl_single_before_content', 'regina_lite_social_share', 1 );
    }

    function regina_lite_social_share() {
        global $post;
        $sharing_bar_text = get_theme_mod( 'regina_lite_sharing_bar_text', __( 'Share this article', 'regina-lite' ) );
        $mail_visibility = get_theme_mod( 'regina_lite_mail_visibility', 1 );
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'regina-lite-blog' );

        $html = '<div id="share-post">';
            if( $sharing_bar_text ) {
                $html .= '<p class="left"><strong>'. esc_html( $sharing_bar_text ) .'</strong></p>';
            }
            $html .= '<ul class="social">';
                if( !empty( $featured_image[0] ) ) {
                    $html .= '<li class="facebook"><a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]='. esc_url( get_the_permalink() ) .'&p[images][0]='. esc_url( $featured_image[0] ) .'&p[title]='. esc_attr( get_the_title() ) .'&p[summary]='. get_the_excerpt() .'" title="'. __( 'Share on Facebook', 'regina-lite' ) .'" onclick="return !window.open(this.href, \'Facebook\', \'width=500, height=500\')" target="_blank"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li>';
                } else {
                    $html .= '<li class="facebook"><a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]='. esc_url( get_the_permalink() ) .'&p[title]='. esc_attr( get_the_title() ) .'&p[summary]='. get_the_excerpt() .'" title="'. __( 'Share on Facebook', 'regina-lite' ) .'" onclick="return !window.open(this.href, \'Facebook\', \'width=500, height=500\')" target="_blank"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li>';
                }
                $html .= '<li class="twitter"><a href="https://twitter.com/share?url='. esc_url( get_the_permalink() ) .'&amp;related='. esc_attr( get_the_author() ) .'&amp;text='. get_the_title() .'" title="'. __( 'Share on Twitter', 'regina-lite' ) .'" onclick="return !window.open(this.href, \'Facebook\', \'width=500, height=500\')" target="_blank"><span class="nc-icon-glyph socials-1_logo-twitter"></span></a></li>';
                $html .= '<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url='. esc_url( get_the_permalink() ) .'&title='. esc_attr( get_the_title() ) .'&source='. esc_attr( get_the_permalink() ) .'" title="'. __( 'Share on LinkedIn', 'regina-lite' ) .'" onclick="return !window.open(this.href, \'Facebook\', \'width=500, height=500\')" target="_blank"><span class="nc-icon-glyph socials-1_logo-linkedin"></span></a></li>';
                if( $mail_visibility == 1 ) {
                    $html .= '<li class="email"><a href="mailto:contact@machothemes.com" title="'. __( 'Share on E-mail', 'regina-lite' ) .'"><span class="nc-icon-glyph ui-1_email-83"></span></a></li>';
                }
            $html .= '</ul><!--/.social-->';
        $html .= '</div>';

        echo $html;
    }
}

/**
 *  Comment
 */
function regina_lite_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'regina-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'regina-lite' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

        <div id="comment-<?php comment_ID(); ?>" class="row">
            <div class="col-xs-2">
                <?php echo get_avatar( $comment, 100 ); ?>
            </div><!--.col-xs-1-->
            <div class="col-xs-10">
                <div class="content">
                    <p class="name"><?php printf( __( '%s', 'regina-lite' ), sprintf( '%s', get_comment_author_link() ) ); ?></p>
                    <p class="meta"><?php printf( __( '%1$s at %2$s', 'regina-lite' ), get_comment_date(), get_comment_time() ); ?></p>
                    <?php comment_text(); ?>
                    <?php
                    if(  $comment->comment_approved == '0' ):
                        _e( 'Your comment is awaiting moderation.', 'regina-lite' );
                    endif;
                    ?>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
        </div><!--.row-->

    <?php
            break;
    endswitch;
}

/**
 *  Upsell
 */
if( !function_exists( 'regina_lite_prefix_upsell_notice' ) ) {
    /**
     * Display upgrade notice on customizer page
     *
     * @since Riba Lite 1.0.3
     */
    function regina_lite_prefix_upsell_notice()
    {

        // Enqueue the script
        wp_enqueue_script(
            'regina-lite-customizer-upsell',
            get_template_directory_uri() . '/inc/customizer/assets/js/upsell/upsell.js',
            array(), '1.0.0',
            true
        );

        // Localize the script
        wp_localize_script(
            'regina-lite-customizer-upsell',
            'prefixL10n',
            array(
                # Upsell URL
                'prefixUpsellURL' => esc_url('http://www.machothemes.com/themes/regina-pro/'),
                'prefixUpsellLabel' => __('View PRO version', 'regina-lite'),

                # Documentation URLs
                'prefixDocURL' => esc_url('http://docs.machothemes.com/regina-lite/'),
                'prefixDocLabel' => __('Theme Documentation', 'regina-lite'),

                # Rate US URL
                'prefixRateURL' => esc_url('https://wordpress.org/support/view/theme-reviews/regina-lite#postform'),
                'prefixRateLabel' => __('If you like it, rate it !', 'regina-lite'),
            )
        );

    }

    add_action('customize_controls_enqueue_scripts', 'regina_lite_prefix_upsell_notice');
}