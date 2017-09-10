<?php
/**
 * The template for displaying case studies
 *
 *
 * @package WordPress
 * @subpackage Accelerate Theme
 * @since Accelerate Theme 1.1
 * 
 * * 2017-09-09  JFK  Created single-our_services.php from single-case_studies.php
 * 
 */
get_header();
?>

<div id="primary" class="site-content">
    <div class="main-content" role="main">
        <section>
            <div class="about-page-sections">              
                <p class="our-services">Our Services</p>
                <p class="our-services-text">We take pride in our clients and the content we create for them.</br>
                    Here is a brief overview of our offered services</p> 

                <?php query_posts('post_type=our_services'); ?>
                <?php
                $cntr = 0;
                while (have_posts()) : the_post();
                    $services_title = _field('services_title');
                    $services_text = get_field('services_text');
                    $services_image = get_field('services_image');
                    $size = "medium";
                    $cntr = $cntr = 1;
                    ?>

                    <article class="content-strategy-main">
                        <?php if ($cntr % 2 == 0) { ?>
                            <p class="content-strategy-title"><?php echo $services_title; ?> </p>
                            <p class="content-strategy-text"><?php echo $services_text; ?> </p>
                            <div class="content-strategy-image-left">
                                <?php
                                if ($services_image) {
                                    echo wp_get_attachment_image($services_image, $size);
                                }
                            } else {
                                ?>
                                <div class="content-strategy-image-right">
                                    <?php
                                    if ($services_image) {
                                        echo wp_get_attachment_image($services_image, $size);
                                    }
                                }
                                ?>
                                <p class="content-strategy-title"><?php echo $services_title; ?></p>
                                <p class="content-strategy-text"><?php echo $services_text; ?></p>

                            </div>
                    </article>

<?php endwhile; // end of the loop.    ?>
<?php wp_reset_query(); ?>
            </div>
        </section><!-- End of About Page Section -->
    </div><!-- #content -->
</div><!-- End of Main Content Class  -->
</div><!-- End of Primary Class  -->

<?php get_footer(); ?>