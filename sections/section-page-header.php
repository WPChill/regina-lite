<?php
/**
 *	The template for displaying the Section: Page Header.
 *
 *	@package regina-lite
 */
?>
<header id="page-header" style="background-image:url('<?php echo get_template_directory_uri(); ?>/layout/images/page-headers/blog.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            	<?php if( is_singular() ): ?>
            		<h2 class="title"><?php the_title(); ?></h2>
                <?php elseif( is_category() ): ?>
                    <?php $category_id = get_query_var( 'cat' ); ?>
                    <h2 class="title"><?php echo get_cat_name( $category_id ); ?></h2>
                <?php elseif( is_search() ): ?>
                    <h2 class="title"><?php printf( __( 'Search results for: %s', 'regina-lite' ), get_search_query() ); ?></h2>
            	<?php else: ?>
            		<h2 class="title"><?php _e( 'Blog', 'regina-lite' ); ?></h2>
            	<?php endif; ?>
                <p class="description"><?php bloginfo( 'description' ); ?></p>
            </div><!--.col-xs-12-->
        </div><!--.row-->
    </div><!--.container-->
</header><!--#page-header-->