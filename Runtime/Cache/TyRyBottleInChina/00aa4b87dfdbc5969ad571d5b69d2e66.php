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
    <script src="/Public/TyRyBottleInChina/Wx/js/weixin.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/gesture.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/main.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/main.css">
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/index.css">
</head>

<script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.uploadify.min.js"></script>
<script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.event.ue.js"></script>
<script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.udraggable.js"></script>

<body>
<div class="page_index bg_1">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_2_02.png" class="img_c_1">
    <div class="nav_top">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_03.png" class="img_t1">
        <div >
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_11sy.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_07.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/introduction">


            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_09.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/prodisplay">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_11zp.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/worklist/award/2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_10.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/rules">
            
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_11.png" class="img_t2 link_url"  data-url="/TyRyBottleInChina/Wx/prizes">
        </div>
    </div>
    <div class="canvas1">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/s2.png" class='img_c1'>
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/c-2_03.png" class="img_c2">
        <div class="div_file">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/c-3_03.jpg" class="img_c3">
            <input type="file" id="id_file">
            <div id="file_upload_1">
                
            </div>
        </div>
        <div class="drag_img arena" id="map-container">
            <div id="drag_map">
                <img src=''>
            </div>
        </div>
        <div id="upLoadPic_scale_bt"><button id="upLoad_scale_down">-</button><span id="upLoad_scale_text">100</span>%<button id="upLoad_scale_up">+</button></div>
        <div class="div_2">
            <!--<img src="images/c-4_06.jpg">-->
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/source.jpg" class='cur_img' data-filter="source">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/source_Gotham.jpg" class='cur_img' data-filter="Gotham">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/source_Lomo.jpg" class='cur_img' data-filter="Lomo">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/source_Toaster.jpg" class='cur_img' data-filter="Toaster">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/source_Nashville.jpg" class='cur_img' data-filter="Nashville">
        </div>
        <div class="div_3">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/c-5_07.jpg" class="but_1" data-type="2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/c-5_09.png" class="but_2" data-type="2">
        </div>
    </div>
    <div class="box_con1" id="id_box_1">
        <div class="box_txt_1" >
        
      <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/w1_06.png" id="cc_clo" style="position: absolute;right: 6%;top: -20px;width: 20px;">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_03.jpg" class="img_d2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_3_03.png" class="img_d1 img_h1" >
        </div>
        <div class="div_3">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_07.jpg" class="but_3 but_img1" >
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_1_09.jpg" class="but_4 but_img2">
        </div>
    </div>
    <div class="box_con1" id="id_box_2">
        <p class="p_c1">为您的作品起个名字</p>
        <input type="text" id="id_title">
        <img src='http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_10_03.png' class="but_post">
    </div>
    <form id="form_1" style="display:none;"  action="/TyRyBottleInChina/WxInterfaceImage/upload" method="post" >
        <textarea id="id_base64" name="base"></textarea>
        <input type="text" id="id_form_title" name="title">
        <input type="text" id="id_num" name="num">
        <input type="text" id="id_class" name="class">
        <input type="text" name="type" value="2">
        <input type="text" name="mobile" value="mobile">
    </form>
<script>
$(function(){
    $("#cc_clo").on('touchend',function(){
        $("#id_box_1").hide();
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