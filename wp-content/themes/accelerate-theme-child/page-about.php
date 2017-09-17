<?php
/**
 * Template Name: Our Services
 * The template for displaying custom posts
 *
 * @package WordPress
 * @subpackage Accelerate Theme
 * @since Accelerate Theme 1.1
 * 
 * * 2017-09-09  JFK  Created our_services.php 
 *   2017-09-11  JFK Renamed page-about.php
 * 
 */
get_header();
?>

<div id="primary" class="site-content">
    <div class="main-content" role="main">
        <div class="about-page-sections">             <section>        
                <p class="our-services">Our Services</p>
                <p class="our-services-text">We take pride in our clients and the content we create for them.<br>
                    Here is a brief overview of our offered services</p> 
            </section>
                <?php query_posts('post_type=our_services&orderby=title&order=ASC'); ?>
                <?php
                $cntr = 0;
                while (have_posts()) : the_post();
                    $services_title = get_field('services_title');
                    $services_text = get_field('services_text');
                    $services_image = get_field('services_image');
                    $size = "medium";
                    
                    ?>

                    <article class="content-strategy-main clearfix"> 
                      <?php $cntr = $cntr + 1;  ?>  
                        <?php if ($cntr % 2 == 0) { ?>  <!-- Even  -->
                           <figure class="content-strategy-image-right">
                            <?php
                            if ($services_image) {
                                echo wp_get_attachment_image($services_image, $size);
                            }
                            ?>
                            </figure>
                            <div class="content-strategy-content-left">
                                <p class="content-strategy-title"><?php echo $services_title; ?> </p>
                                <p class="content-strategy-text"><?php echo $services_text; ?> </p>
                            </div>
                            <?php
                        } else { ?> <!-- Odd  -->
                            <figure class="content-strategy-image-left">
                            <?php
                            if ($services_image) {
                                echo wp_get_attachment_image($services_image, $size);
                            }
                            ?>
                            </figure>
                            <div class="content-strategy-content-right">
                                <p class="content-strategy-title"><?php echo $services_title; ?> </p>
                                <p class="content-strategy-text"><?php echo $services_text; ?> </p>
                            </div>
                            <?php } ?>
                    </article>
                    <br>
                <?php endwhile; // end of the loop.    ?>
                <?php wp_reset_query(); ?>
                <div class="call-to-action">
                   <div class="align-center vertical-middle">
                       <span class="call-to-action-text">Interested in working for us?</span>
                        <a class="call-to-action-button" href="<?php echo site_url(); ?>/contact-us">Contact Us</a>
                    </div>
                </div>
              
        </div><!-- End of About Page Div -->
        
    </div><!-- End of Main Content Class  -->
</div><!-- End of Primary Class  -->

<?php get_footer(); ?>