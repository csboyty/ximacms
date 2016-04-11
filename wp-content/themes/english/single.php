<?php
$product_id=1;
get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
        if( in_category($product_id )) {
            get_template_part('single-product' );
        }else{
            ?>

            <div class="singleWrapper">
                <div class="content">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <span class="date"><?php the_date(); ?></span>

                    <?php the_content(); ?>
                </div>
            </div>

            <?php
        }
    ?>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>