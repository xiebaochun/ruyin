<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Cache-Control" content="must-revalidate" />
    <title>如饮</title>
    <meta name="description" content="如饮"  id="desc"/>
    <meta name="author" content="wangyuan" />
    <style>
        *{padding:0px;margin:0px;}
        html,body{width:100%;height:100%;position:relative;}
    </style>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/esl.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.1.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.transit.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/main.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/weixin.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/main.css">
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/index.css">
</head>

<body class="bg3">
<div class="">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_19_02.png" class="img_c_1">
    <div class="div_right1">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_03.png" class="link_url" data-url="/TyRyBottleInChina/Wx/participation" style="margin-right:20px;height:30px;">

    </div>
    <div style="width:100%;position:relative;margin-top:9%;">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_20_02.png" class="img_j1" style="margin-top:0px;">
        <span style="width:50%;left:0px;top:0px;height:100%;display:block;position:absolute;"  class="left_1"></span>
        <span style="width:50%;left:50%;top:0px;height:100%;display:block;position:absolute;" class='right_1'></span>
    </div>
    
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/j2.png" class="img_j2">
     <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/j1.png" class="img_j2" style="display:none;">
    <p class="p_3">*更多参与方式请关注如饮官方网页</p>
</div>
<script>
$(function(){
    $('.left_1').on('touchend',function(){
        $(".img_j2").hide().eq(0).show();
    })
    $('.right_1').on('touchend',function(){
        $(".img_j2").hide().eq(1).show();
    })
})
</script>
<div class="page_loading">
	<div class="load_box">
		正在加载中...
	</div>
</div>

</body>
</html>