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

<body>
<div class="page_index bg3">
    <div class="page_show">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_11_02.png" class="img_s1">
        <div>
        
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_07.png" class="prev_1">
            <img src="<?php echo ($works['centerimg']); ?>"
                 data-center="<?php echo ($works['centerimg']); ?>"
                 data-right="<?php echo ($works['rightimg']); ?>"
                 data-left="<?php echo ($works['leftimg']); ?>"  class="img_s2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_12.png" class="next_1">

            <p class="pb1">
                <i>作者:</i><span><?php echo ($works['username']); ?></span>
                <i>作品名称:</i><span><?php echo ($works['workname']); ?></span>
                <i>发布时间:</i><span><?php echo ($works['date']); ?></span>
                <em>当前票数:  <?php echo ($works['poll']); ?> </em>
            </p>
           

        </div>
         <p class="pb2">
                <?php if($my == 1){ ?>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_6_06.png" class='link_url' data-url='/TyRyBottleInChina/Wx/worklist/award/2'>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_6_03.png" class='link_url' data-url='/TyRyBottleInChina/Wx/index' data-share="1">
                <?php }else{ ?>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/h-1_06.png" class='link_url' data-url='/TyRyBottleInChina/Wx/worklist'>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/h-2_03.png" class='link_url' data-url='/TyRyBottleInChina/Wx/<?php echo ($name); ?>'>
                <?php }?>
            </p>
    </div>
</div>
<div class="page_f">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_03.png">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_07.png" class='f_prev'>
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_11.png">
</div>
<script>
    $(function(){
        dataForWeixin.url=location.href;
        var c = 1;
        $('.next_1').click(function(){
            if(c == 1) {
                var a = $('.img_s2').attr('data-right');
                $('.img_s2').attr('src', a);
                $(this).hide();
                c++;
            }else if(c == 0){
                var a = $('.img_s2').attr('data-center');
                $('.img_s2').attr('src', a);
                $('.prev_1').show();
                c++;
            }
        });
        $('.prev_1').click(function(){
            if(c == 2) {
                var b = $('.img_s2').attr('data-center');
                $('.img_s2').attr('src', b);
                c--;
            }else if(c == 1){
                var b = $('.img_s2').attr('data-left');
                $('.img_s2').attr('src', b);
                $(this).hide();
                $('.next_1').show();
                c--;
            }
        });
    });
</script>
<div class="page_loading">
	<div class="load_box">
		正在加载中...
	</div>
</div>

</body>
</html>