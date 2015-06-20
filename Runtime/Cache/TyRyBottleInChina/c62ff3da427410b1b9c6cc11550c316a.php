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
    <div class="div_con_1">
        <div class="div_canvas_1">
            <div class="canvas_1_left">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a13_10.png" class="img_21">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s7_03b.png" class="img_21b">
                <div class="div_bg2"></div>
                <canvas id="id_canvas1" width="900" height="600"></canvas>
            </div>
            <div class="canvas_1_right">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a12b_06.png" class="img_22" id="img_clear_canvas">
                <div class="div_d">
                    <a href="javascript:" class="link_4 current"><i>自己绘制</i></a>
                    <a href="/TyRyBottleInChina/Pc/uploadpic" class="link_5"><i>上传图片</i></a>
                    <a href="/TyRyBottleInChina/Pc/compound" class="link_6"><i>素材合成</i></a>
                </div>
                <div class="div_box2">
                    <a href="javascript:" class="close_box2"></a>
                    <p class="p_1"><i class="icon_1"></i>点击选择画笔颜色</p>
                    <ul class="ul_li1">
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_17.png" data-color="e9db39"><span>柠檬黄</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_19.png" data-color="b49436"><span>姜黄</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_21.png" data-color="ce9335"><span>土黄</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_23.png" data-color="e47542"><span>雄精</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_25.png" data-color="cc3536"><span>艳红</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_12.png" data-color="4d1919"><span>铁红</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_14.png" data-color="d5b884"><span>卡其黄</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_28.png" data-color="b8844f"><span>棕茶</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_30.png" data-color="c1a299"><span>奶棕</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_41.png" data-color="aec4b7"><span>淡灰绿</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_42.png" data-color="008e59"><span>鹦鹉绿</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_44.png" data-color="006e5f"><span>翠绿</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_46.png" data-color="3d6e53"><span>老绿</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_48.png" data-color="748a8d"><span>织锦灰</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_50.png" data-color="1f3696"><span>宝蓝</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_52.png" data-color="0041a5"><span>孔雀蓝</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_54.png" data-color="a22076"><span>牵牛紫</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_56.png" data-color="704d4e"><span>绛紫</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_78.png" data-color="ffffff"><span>纯白</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_67.png" data-color="eeeeee"><span>灰白</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_79.png" data-color="cdcdcd"><span>淡灰</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_69.png" data-color="9a9a9a"><span>纯灰</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s6_71.png" data-color="8a9398"><span>深灰</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_81.png" data-color="555654"><span>灰黑</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_74.png" data-color="414143"><span>纯黑</span></li><li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_76.png" data-color="282829"><span>墨黑</span></li>
                        <li><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s5_77.png" data-color="181818"><span>深墨黑</span></li>
                    </ul>
                    <div class="p_2"><i class="icon_1"></i>点击选择笔刷大小
                        <ul class="ul_li2">
                            <li ></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>

                    <p class="p_3"><i class="icon_1"></i>点击选择橡皮擦
                        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a13_19.png" class="img_clear">
                    </p>
                </div>
                <div class="con_post1" style="margin-top:0px;">
                    <input type="type" class="input_1" placeholder="为你的作品起个名字">
                    <span class="but_1" data-type="1" data-flag="<?php echo ($user?1:0); ?>">预览</span>
                    <span class="but_2"  data-type="1" data-flag="<?php echo ($user?1:0); ?>">提交</span>
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