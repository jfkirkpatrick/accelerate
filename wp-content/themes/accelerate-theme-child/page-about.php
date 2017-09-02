<?php
/**
 * The My About Page
 *
 * This is the template that displays the About Page.
 * Was created from the Page.php Template and modified as needed.
 * 
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 2.0
 * 
 * * 2017-08-31  JFK  Created about-me.php from child theme page.php
 * * 2017-09-02 JFK Renamed to page-about.php
 */
get_header();
?>

<div id="primary" class="site-content">
    <div class="main-content" role="main">
        <section class="about-page">
            <div class="site-content">
                <div class="about-page-sections">              
                    <p class="our-services">Our Services</p>
                    <p class="our-services-text">We take pride in our clients and the content we create for them.  Here is a brief overview of our offered services</p> 
                    <div class="content-stratery">
                        <div class="content-strategy-image">
                            <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2017/08/bullseye.png>"></img>
                        </div> 
                        <div>
                            <p class="content-strategy-text">Bacon ipsum dolor sit amet strip steak jowl pancetta, cow turkey salami saugage fastback boudin bitong frankfurter shoulder pork turducken spare ribs</p>

                        </div>
                    </div> <!-- End of Content Strategy -->
                </div> <!-- End of About Page Sections -->
            </div> <!-- End of Site Content -->
        </section><!-- End of About Page Section -->

    </div><!-- #content -->

</div><!-- #primary -->

<?php get_footer(); ?>


