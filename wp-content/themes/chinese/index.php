<?php
$index_roll_id=11;
$about_id=9;
$products_id=1;
$news_id=8;

get_header();
?>

<div id="slider" class="flexslider">
    <ul class="slides">
<?php
$query = new WP_Query(array(
    "cat"=>$index_roll_id,"posts_per_page"=>-1,"orderby"=>'date',"order"=>'DESC'
));

if ( $query->have_posts() ) {

    while ( $query->have_posts() ) {
        $query->the_post();
        $post_id=$post->ID;
        $link=get_post_meta($post_id,"link",true);
        $content=$post->post_content;
        preg_match('/http:.*?"/',$content,$image);
        //print_r($content);
        $image=substr($image[0],0,-1);
        ?>

        <li>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo $image; ?>" />
                <div class="detail">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                </div>
            </a>
        </li>
    <?php
    }
}

wp_reset_postdata();

?>

    </ul>
</div>

<ul class="list">
    <?php
    $about_category=get_category($about_id);
    print_r($about_category);
    ?>
    <li>
        <a href="<?php echo get_category_link($about_category->cat_ID); ?>">
            <h3 class="title"><?php echo $about_category->name; ?>
                <span class="slug"><?php echo $about_category->slug; ?></span></h3>
            <img class="thumb" src="<?php echo z_taxonomy_image_url($about_category->term_id); ?>">
            <p class="intro"><?php echo $about_category->category_description; ?></p>
            <div class="border">右边的border</div>
            <div class="bg"></div>
        </a>
    </li>
    <?php
    $products_category=get_category($products_id);
    ?>
    <li>
        <a href="<?php echo get_category_link($products_category->cat_ID); ?>">
            <h3 class="title"><?php echo $products_category->name; ?>
                <span class="slug"><?php echo $products_category->slug; ?></span></h3>
            <img class="thumb" src="<?php echo z_taxonomy_image_url($products_category->term_id); ?>">
            <p class="intro"><?php echo $products_category->category_description; ?></p>
            <div class="border">右边的border</div>
            <div class="bg"></div>
        </a>
    </li>
    <?php
    $news_category=get_category($news_id);
    ?>
    <li>
        <a href="<?php echo get_category_link($news_category->cat_ID); ?>">
            <h3 class="title"><?php echo $news_category->name; ?>
                <span class="slug"><?php echo $news_category->slug; ?></span></h3>
            <img class="thumb" src="<?php echo z_taxonomy_image_url($news_category->term_id); ?>">
            <p class="intro"><?php echo $news_category->category_description; ?></p>
            <div class="border">右边的border</div>
            <div class="bg"></div>
        </a>
    </li>

    </ul>


    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/frontend/lib/jquery.flexslider-min.js"></script>
    <script>
        $(document).ready(function(){

            $('#slider').flexslider({
                animation: "slide",
                controlNav: true,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });

    </script>

<?php get_footer(); ?>