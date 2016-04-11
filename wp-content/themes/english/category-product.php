<?php
$product_roll_id=13;

$product_id=1;

get_header();

?>

<div class="categoryWrapper categoryWrapper1">

    <div id="slider" class="flexslider">
        <ul class="slides">
            <?php
            $query = new WP_Query(array(
                "cat"=>$product_roll_id,"posts_per_page"=>-1,"orderby"=>'date',"order"=>'DESC'
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
                        <img src="<?php echo $image; ?>" />
                        <div class="detail">
                            <h2 class="title"><?php the_title(); ?></h2>
                            <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="more">查看更多</a>
                        </div>
                    </li>
                <?php
                }
            }

            wp_reset_postdata();

            ?>
        </ul>
    </div>

    <ul class="list5">
<?php

$product_categories = get_categories(array(
    "parent"=>$product_id,
    "orderby"=>"id",
    "hide_empty"=>0
));

foreach($product_categories as $key =>$category){
    ?>

    <li>
        <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->name; ?></a>
    </li>

<?php
}
?>
    </ul>

    <ul class="list2">
        <?php while ( have_posts() ) : the_post();

            $thumbSrc="";
            $post_id=get_the_ID();

            if(has_post_thumbnail($post_id)){
                $thumbnailId=get_post_thumbnail_id($post_id);
                if(wp_get_attachment_metadata($thumbnailId)){

                    //如果存在保存媒体文件信息的metadata，那么系统是可以获取出缩略图的
                    $thumbSrc= wp_get_attachment_image_src($thumbnailId,"post-thumbnail");
                    $thumbSrc=$thumbSrc[0];
                }
            }
            ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo $thumbSrc; ?>">
                <h3 class="title"><?php the_title(); ?></h3>
                <p class="intro"><?php echo get_the_excerpt(); ?></p>
                <div class="info">
                    <?php
                    $material=get_post_meta($post_id,"材质",true);
                    $size=get_post_meta($post_id,"尺寸",true);
                    ?>
                    <span class="txt">材质：<?php echo $material; ?></span>
                    <span class="txt">尺寸：<?php echo $size; ?></span>
                </div>
            </a>
        </li>

        <?php endwhile;?>

    </ul>

    <!-- 分页-->
    <?php
    global $wp_query;
    $total = $wp_query->max_num_pages;
    if ($total > 1) {
        if (!$current_page = get_query_var('paged')) {
            $current_page = 1;
        }
        //获取路径
        $permalink_structure = get_option('permalink_structure');
        $format = empty($permalink_structure) ? '&page=%#%' : '/page/%#%/';
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => $format,
            'current' => $current_page,
            'total' => $total, 'mid_size' => 4,
            'type' => 'list',
            'prev_text'    => "上一页",
            'next_text'    => "下一页",
        ));
    }
    ?>
</div>



<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/frontend/lib/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
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