<?php

get_header();
?>
<?php
    $post_id=$post->ID;
    $content=$post->post_content;
    preg_match_all('/http:.*?"/',$content,$images);
    $images=array_unique($images[0]);

    ?>
    <div class="single1Wrapper">
        <div class="images">
            <div id="slider" class="flexslider">
                <ul class="slides">
                    <?php
                        foreach($images as $value){
                            ?>
                            <li>
                                <img src="<?php echo substr($value,0,-1) ?>" />
                            </li>

                            <?php
                        }
                    ?>
                </ul>
            </div>
            <div id="carousel" class="flexslider flex-carousel flexslider1">
                <ul class="slides">
                    <?php
                    foreach($images as $value){
                        ?>
                        <li>
                            <img src="<?php echo substr($value,0,-1) ?>" />
                        </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="info">
            <h3 class="title"><?php the_title(); ?></h3>
            <p class="intro"><?php echo get_the_excerpt(); ?></p>

            <?php
            $material=get_post_meta($post_id,"材质",true);
            $size=get_post_meta($post_id,"尺寸",true);
            ?>
            <p class="vars firstVar">
                <span class="name">材料</span>
                <?php echo $material; ?>
            </p>
            <p class="vars">
                <span class="name">尺寸</span>
                <?php echo $size; ?>
            </p>
        </div>
        <div class="moreProducts">
            <h3 class="title">类似产品</h3>

            <ul class="list4">

                <?php
                $current_category=get_the_category();
                print_r($current_category);
                $query = new WP_Query(array(
                    "cat"=>$current_category[0]->cat_ID,"posts_per_page"=>5,"orderby"=>'date',"order"=>'DESC'
                ));

                if ( $query->have_posts() ) {

                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $post_id=$post->ID;
                        $thumbSrc="";

                        if(has_post_thumbnail($post_id)){
                            $thumbnailId=get_post_thumbnail_id($post_id);
                            if(wp_get_attachment_metadata($thumbnailId)){

                                //如果存在保存媒体文件信息的metadata，那么系统是可以获取出缩略图的
                                $thumbSrc= wp_get_attachment_image_src($thumbnailId,"post-thumbnail");
                                $thumbSrc=$thumbSrc[0];
                            }
                        }
                        ?>

                        <li><a href="<?php the_permalink(); ?>">
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
                    <?php
                    }
                }

                wp_reset_postdata();
                ?>
            </ul>
        </div>
    </div>




    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/frontend/lib/jquery.flexslider-min.js"></script>
    <script>
        $(document).ready(function(){

            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 120,
                itemMargin: 5,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });

        });
    </script>

<?php get_footer(); ?>