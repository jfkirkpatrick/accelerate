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
        <section>
            <article>
                <div class="about-page-sections">              
                    <p class="our-services">Our Services</p>
                    <p class="our-services-text">We take pride in our clients and the content we create for them.</br>
                        Here is a brief overview of our offered services</p> 
                    <?php
                    while (have_posts()) : the_post();
                        $content_strategy_text = get_field('content_strategy_text');
                        //                      $content_strategy_image = get_field('content_strategy_image');
                        $size = "medium";
                        ?>
                        <div class="content-strategy-images">
                            <div class="content-strategy-image">
                                <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2017/08/bullseye.png"></img>
                            </div> 

                            <p class="content_strategy_text"><?php echo $content_strategy_text; ?></p>
                        </div>
                </article>

            <?php endwhile; // end of the loop.   ?>
        </section><!-- End of About Page Section -->
    </div><!-- #content -->
</div><!-- End of Main Content Class  -->
</div><!-- End of Primary Class  -->

<?php get_footer(); ?>

