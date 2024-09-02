<?php
/**
 * Template Name: login pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sydney
 */
$disable_title               = get_post_meta( $post->ID, '_sydney_page_disable_title', true );
$disable_featured            = get_post_meta( $post->ID, '_sydney_page_disable_post_featured', true );
$single_post_image_placement = get_theme_mod( 'single_post_image_placement', 'below' );
$single_post_meta_position   = get_theme_mod( 'single_post_meta_position', 'below-title' );

get_header( 'basic' ); ?>
<?php do_action( 'sydney_before_content' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		<div class="content-entry" <?php sydney_do_schema( 'entry_content' ); ?>>
			<?php the_content(); ?>
			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'sydney' ),
						'after'  => '</div>',
					)
				);
				?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
<?php do_action( 'sydney_after_content' ); ?>
<?php
get_footer( 'basic' );
