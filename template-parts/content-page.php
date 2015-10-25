<?php
/**
 *  Template part for displaying single posts.
 *
 *  @link https://codex.wordpress.org/Template_Hierarchy
 *
 *  @package regina-lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
    <h2 class="title"><?php the_title(); ?></h2>
    <div class="body">
        <?php the_content(); ?>
    </div>
</article><!--.post-->