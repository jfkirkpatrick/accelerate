<?php
/**
 * The template for displaying the homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 2.0
 */

get_header(); ?>

<section class="home-page">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="homepage-hero">
				<div class="site-content">
					<?php the_content(); ?>
					<a class="button" href="<?php echo home_url(); ?>/blog">View Our Work</a>
				</div><!-- .site-content -->
			</div>
		<?php endwhile; // end of the loop. ?>
</section><!-- Class = home-page -->

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div>
<?php endif; ?>

<?php get_footer(); ?>
