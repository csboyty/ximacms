<?php
    get_header();
?>

<div class="categoryWrapper">
    <div class="categoryNames">
        <h4 class="name">搜索</h4>
        <span class="sp">&gt</span>
        <h5 class="name name1"><?php  echo get_search_query(); ?></h5>
    </div>

<?php if ( have_posts() ) :?>
    <ul class="list2">
        <?php while ( have_posts() ) : the_post();
            $postId=get_the_ID();
            $thumbSrc="";
            if(has_post_thumbnail($postId)){
                $thumbnailId=get_post_thumbnail_id($postId);
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
                        $material=get_post_meta($postId,"材质",true);
                        $size=get_post_meta($postId,"尺寸",true);
                        ?>
                        <span class="txt">材质：<?php echo $material; ?></span>
                        <span class="txt">尺寸：<?php echo $size; ?></span>
                    </div>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

    <!-- 分页-->
    <?php
    global $wp_query;
    $total = $wp_query->max_num_pages;
    //print_r($total);
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

<?php else : ?>
    <p style="text-align: center">没有搜索到您所需的信息！</p>
<?php endif; ?>
</div>


<?php get_footer(); ?>