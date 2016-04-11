<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="webkit" name="renderer">
    <meta name="keywords" content="ShiMa">
    <meta name="description" content="ShiMa">
    <title><?php wp_title("|",true,"right"); ?></title>

    <link href="<?php echo get_template_directory_uri(); ?>/css/frontend/lib/flexslider.css" type="text/css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/frontend/src/main.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/frontend/lib/jquery-1.11.1.min.js"></script>
</head>
<body>
<div class="header">
    <h1 class="logo"><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo("name"); ?></a></h1>

    <span class="menuCtrl" id="menuCtrl">菜单</span>

    <?php wp_nav_menu(); ?>

    <form role="search" method="get" id="searchform" class="search" action="<?php echo home_url(); ?>">
        <input class="input" type="text" name="s" placeholder="Search...">
        <input type="hidden" name="cat" value="1" />
        <input type="submit" id="searchsubmit" class="btn" value="Search" />
    </form>

    <a class="langLink" href="<?php
    $mainBlog=get_blog_details(1);
    echo $mainBlog->siteurl;
    ?>">Chinese</a>
</div>
