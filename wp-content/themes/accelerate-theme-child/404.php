<?php
/**
 * The template for displaying 404 page (Not Found)
 *
 * This is the template that displays only 404 (Not Found) Page
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 2.0
 * * 
 * 2017-09-10  JFK  Created from Root 404 Page
 * 
 */
get_header();
?>

<section id="page-404">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <header class="page-header">
                <h1 class="page-title"><?php echo('Suddenly, it all went dark. '); ?></h1>
            </header>


            <div class="page-content-404">
                <p><?php echo('Looks like the page you\'re looking for isn\'t here anymore.'); ?></p>
                <p><?php echo('Sorry!'); ?> </p>
                <p><?php echo('Try returning to the Home Page and starting over!'); ?></p>
                <p><?php echo('Report any continuing errors to Support.'); ?></p>

            </div><!-- .page-content -->

        </div><!-- #content -->
    </div><!-- #primary -->
</section>

<?php
get_footer();
