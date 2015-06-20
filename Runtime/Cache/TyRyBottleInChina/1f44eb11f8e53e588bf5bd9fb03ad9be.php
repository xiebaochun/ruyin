<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>如饮</title>
    <meta name="description" content="" />
    <meta name="author" content="star" />
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/css/index.css">
    <script src="/Public/TyRyBottleInChina/js/jquery.1.js"></script>
    
    <script src="/Public/TyRyBottleInChina/js/modernizr.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.uploadify.min.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.event.ue.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.udraggable.js"></script>
    <script src="/Public/TyRyBottleInChina/js/esl.js"></script>
    <script>
        ie=0;
    </script>
    <script src="/Public/TyRyBottleInChina/js/main.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.transit.js"></script>
</head>

<body class="body_1">

<div class="page_header">
    <div class="header_con">
        <?php $user=session('user'); if($user){ ?>
            <span class="span_deng">
                <img src="<?php echo ($user["headimgurl"]); ?>" width="40" height="40" id="headurl">
                <em id="nickname"><?php echo ($user["nickname"]); ?></em>
                <a href="/TyRyBottleInChina/Pc/workshow">我的作品</a>
            </span>
        <?php }else{ ?>
            <span class="span_deng" style="display: none;">
                <img src="<?php echo ($user["headimgurl"]); ?>" width="40" height="40" id="headurl">
                <em id="nickname"><?php echo ($user["nickname"]); ?></em>
                <a href="/TyRyBottleInChina/Pc/workshow">我的作品</a>
            </span>
            <span class="span_login" >登录</span>
        <?php } ?>
        <span class="span_weixin">微信参与</span>
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a5_03.png" class="img_1">
    </div>
</div>

<?php $code=getRandChar(10); ?>
<div class="page_box_1" id="message_ma">
    <div class="div_box_ma">       
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/b4_05.jpg" class="close_ma">
        <div class="class_ma">
            <p style="text-align: center;font-weight: 600;">请使用微信扫一扫</p>
            <p style="text-align: center;font-weight: 600;">登录并参与活动</p>
            <img src="/TyRyBottleInChina/PcWxApi/qrcode/code/<?php echo ($code); ?>" class="img_2" data-code="<?php echo ($code); ?>">
        </div>
    </div>
</div>

<div class="page_loading">
	<div class="load_box">
		正在加载中...
	</div>
</div>	
	

<script>
    function polling(){

        var i = 0;
        var code = $('.img_2').data('code');
        interval = setInterval(function(){
            i = i +1;
            if(i < 30){

                $.get(Main.url+'TyRyBottleInChina/PcWxApi/listenlogin/code/'+code,function(data){
                    if(data.status == 0){
                       // parent.location.reload();
                       if(Main.worklist){
                           window.location.reload();
                       } else{
                           $(".but_1,.but_2,.span_tou,.tou_cc").data('flag','1');
                           $("#headurl").attr('src',data.headimgurl);
                           $('#nickname').html(data.nickname);
                           $('#author').html(data.nickname);
                           $('.span_deng').show();
                           $('.span_login').hide();
                           $("#message_ma").hide();
                       }
                        clearInterval(interval);
                    }
                });
            } else {
                clearInterval(interval);
            }},3000);
    }
</script>

<div class="page_index page_bg_3">
    <div class="div_con_1" style="width:1244px;">
        <div class="div_canvas_2">
            <div class="canvas_2_left">
                <img src="/Public/TyRyBottleInChina/images/s7_03b.png" class="img_21b">
                <div id="id_canvas3" style="width:900px;height:600px;"></div>
                <!--<canvas id="id_canvas3" width="900" height="596"></canvas>-->
            </div>
            <div class="canvas_2_right">
                <img src="/Public/TyRyBottleInChina/images/a12b_06.png" class="img_22" id="clear_canvas3">
                <div class="div_d div_d2">
                    <a href="/TyRyBottleInChina/Pc/draw" class="link_4 "><i>自己绘制</i></a>
                    <a href="/TyRyBottleInChina/Pc/uploadpic" class="link_5 "><i>上传图片</i></a>
                    <a href="javascript:" class="link_6 current"><i>素材合成</i></a>
                </div>
                <div class="div_box2 div_box2_b">
                    <ul class="ul_nav1">
                        <li class="current">场景</li><li>人物</li><li>动物</li><li>植物</li><li>装饰</li>
                    </ul>
                    <div class='tab_0 tab_1' style="display:block;">
                        <div >
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/1.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/1.jpg" data-type="1" data-id="1">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/2.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/2.jpg" data-type="1" data-id="2">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/3.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/3.jpg" data-type="1" data-id="3">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/4.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/4.jpg" data-type="1" data-id="4">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/5.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/5.jpg" data-type="1" data-id="5">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/6.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/6.jpg" data-type="1" data-id="6">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/7.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/7.jpg" data-type="1" data-id="7">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/8.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/8.jpg" data-type="1" data-id="8">
                            <img src="/Public/TyRyBottleInChina/sc/bg_min/9.jpg" data-src="/Public/TyRyBottleInChina/sc/bg/9.jpg" data-type="1" data-id="9">
                        </div>
                        <p style="display:none;"><span class="current">1</span><span>2</span></p>
                    </div>
                    <div class='tab_0 tab_2' >
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/1.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/1.png" data-type="2" data-id="1">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/2.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/2.png" data-type="2" data-id="2">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/3.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/3.png" data-type="2" data-id="3">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/4.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/4.png" data-type="2" data-id="4">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/5.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/5.png" data-type="2" data-id="5">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/6.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/6.png" data-type="2" data-id="6">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/7.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/7.png" data-type="2" data-id="7">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/8.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/8.png" data-type="2" data-id="8">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/9.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/9.png" data-type="2" data-id="9">
                        </div>
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/10.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/10.png" data-type="2" data-id="10">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/11.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/11.png" data-type="2" data-id="11">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/12.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/12.png" data-type="2" data-id="12">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/13.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/13.png" data-type="2" data-id="13">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/14.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/14.png" data-type="2" data-id="14">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/15.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/15.png" data-type="2" data-id="15">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/16.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/16.png" data-type="2" data-id="16">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/17.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/17.png" data-type="2" data-id="17">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/18.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/18.png" data-type="2" data-id="18">
                        </div>
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/19.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/19.png" data-type="2" data-id="19">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/20.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/20.png" data-type="2" data-id="20">
                            <img src="/Public/TyRyBottleInChina/sc/rw_min/21.jpg"  data-src="/Public/TyRyBottleInChina/sc/rw/21.png" data-type="2" data-id="21">
                        </div>
                        <p class="p_page_1"><span class="current">1</span><span>2</span><span>3</span></p>
                    </div>
                    <div class='tab_0 tab_3' >
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/1.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/1.png" data-type="3" data-id="1">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/2.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/2.png" data-type="3" data-id="2">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/3.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/3.png" data-type="3" data-id="3">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/4.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/4.png" data-type="3" data-id="4">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/5.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/5.png" data-type="3" data-id="5">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/6.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/6.png" data-type="3" data-id="6">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/7.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/7.png" data-type="3" data-id="7">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/8.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/8.png" data-type="4" data-id="8">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/9.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/9.png" data-type="4" data-id="9">
                        </div>
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/10.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/10.png" data-type="3" data-id="10">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/11.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/11.png" data-type="3" data-id="11">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/12.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/12.png" data-type="3" data-id="12">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/13.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/13.png" data-type="3" data-id="13">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/14.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/14.png" data-type="3" data-id="14">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/15.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/15.png" data-type="3" data-id="15">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/16.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/16.png" data-type="3" data-id="16">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/17.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/17.png" data-type="3" data-id="17">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/18.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/18.png" data-type="3" data-id="18">
                        </div>
                        <div class="fenye">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/19.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/19.png" data-type="3" data-id="19">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/20.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/20.png" data-type="3" data-id="20">
                            <img src="/Public/TyRyBottleInChina/sc/dw_min/21.jpg"  data-src="/Public/TyRyBottleInChina/sc/dw/21.png" data-type="3" data-id="21">
                        </div>
                        <p class="p_page_1"><span class="current">1</span><span>2</span><span>3</span></p>
                    </div>
                    <div class='tab_0 tab_4' >
                        <div >
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/1.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/1.png" data-type="4" data-id="1">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/2.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/2.png" data-type="4" data-id="2">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/3.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/3.png" data-type="4" data-id="3">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/4.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/4.png" data-type="4" data-id="4">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/5.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/5.png" data-type="4" data-id="5">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/6.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/6.png" data-type="4" data-id="6">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/7.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/7.png" data-type="4" data-id="7">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/8.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/8.png" data-type="4" data-id="8">
                            <img src="/Public/TyRyBottleInChina/sc/zw_min/9.jpg"  data-src="/Public/TyRyBottleInChina/sc/zw/9.png" data-type="4" data-id="9">
                        </div>
                        <p style="display:none;"><span class="current">1</span><span>2</span></p>
                    </div>
                    <div class='tab_0 tab_5' >
                        <div >
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/1.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/1.png" data-type="5" data-id="1">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/2.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/2.png" data-type="5" data-id="2">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/3.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/3.png" data-type="5" data-id="3">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/4.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/4.png" data-type="5" data-id="4">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/5.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/5.png" data-type="5" data-id="5">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/6.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/6.png" data-type="5" data-id="6">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/7.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/7.png" data-type="5" data-id="7">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/8.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/8.png" data-type="5" data-id="8">
                            <img src="/Public/TyRyBottleInChina/sc/zs_min/9.jpg"  data-src="/Public/TyRyBottleInChina/sc/zs/9.png" data-type="5" data-id="9">
                        </div>
                        <p style="display:none;"><span class="current">1</span><span>2</span></p>
                    </div>
                </div>
                <div class="con_post1" style="margin-top:0px;">
                    <input type="type" class="input_1" placeholder="为你的作品起个名字">
                    <span class="but_1" data-type="3" data-flag="<?php echo ($user?1:0); ?>">预览</span>
                    <span class="but_2" data-type="3" data-flag="<?php echo ($user?1:0); ?>">提交</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='div_box_1'>
    <div class="div_box_1_con1">
        <span class="box_1_close" id="id_box_1_color"></span>
        <div class="div_box_1_con1_left">
            <img src="" class="img_h1">
            <iframe id="if_frame_canvas" style="display:none;"></iframe>
            <!--<img src="" class="img_h3">-->
        </div>
        <div class="div_box_1_con1_right">
            <?php $user=session('user'); ?>
            <p>作者:  <span id="author"><?php echo ($user["nickname"]); ?></span><br>作品名称:  <span class="span_zp_name"></span></p>
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a14_06.png" class="but_img1">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a14_09.png" class="but_img2">
        </div>
    </div>
</div>
<form id="form_1" style="display:none;"  action="/TyRyBottleInChina/PcInterfaceImage/upload" method="post" >
    <textarea id="id_base64" name="base"></textarea>
    <input type="text" name="title" id="id_form_title">
    <input type="text" name="num" id="id_num">
    <input type="text" name="scale" id="id_scale">
    <input type="text" name="arr"  id="id_arr">
    <input type="text" name="class" id="id_class">
    <?php $action_name=$Think.ACTION_NAME ?>
    <input type="text" name="type" value="<?php if($action_name == draw): ?>1<?php elseif($action_name == uploadpic): ?>2<?php elseif($action_name == compound): ?>3<?php endif; ?>">

</form>


<div class="page_footer">
    <ul class="footer_ul">
        <?php $action_name=$Think.ACTION_NAME ?>
        <li><a href="/TyRyBottleInChina/Pc/index" <?php echo ($action_name=='index'?'class="current"':''); ?>>首页</a></li>
        <li ><a href="/TyRyBottleInChina/Pc/introduction" <?php echo ($action_name=='introduction'?'class="current"':''); ?>>活动介绍</a></li>
        <li><a href="/TyRyBottleInChina/Pc/prodisplay" <?php echo ($action_name=='prodisplay'?'class="current"':''); ?>>产品展示</a></li>
        <li><a href="/TyRyBottleInChina/Pc/participation" <?php if(($action_name == 'participation') OR ($action_name == 'draw') OR ($action_name == 'uploadpic') OR ($action_name == 'compound')): ?>class="current"<?php endif; ?>>参与方式</a></li>
        <li><a href="/TyRyBottleInChina/Pc/worklist" <?php echo ($action_name=='worklist'?'class="current"':''); ?>>作品展示</a></li>
        <li><a href="/TyRyBottleInChina/Pc/rules" <?php echo ($action_name=='rules'?'class="current"':''); ?>>活动规则</a></li>
        <li><a href="/TyRyBottleInChina/Pc/prizes" <?php echo ($action_name=='prizes'?'class="current"':''); ?>>奖品设置</a></li>
    </ul>
</div>

</body>
</html>