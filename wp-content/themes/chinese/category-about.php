<?php
get_header();

while ( have_posts() ) : the_post();
?>

<div class="aboutWrapper">
    <?php the_content(); ?>
</div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>