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
 <!--[if IE]>       
        <script type="text/javascript">           
            ie=true;
        </script>
    <![endif]-->
<body class="body_1">
<script>
//ie=true;
</script>

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
                <div id="upLoadPic_scale_bt"><button id="upLoad_scale_down">-</button><span id="upLoad_scale_text">100</span>%<button id="upLoad_scale_up">+</button></div>
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a13_10.png" class="img_21">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/s7_03b.png" class="img_21b">
                <div class="div_bg2"></div>
                <div class="drag_img arena" id="map-container">
                    <div id="drag_map">
                        <img src=''>
                    </div>
                </div>
                <!--<canvas id="id_canvas2" width="706" height="713"></canvas>-->
            </div>
            <div class="canvas_1_right">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a12b_06.png" class="img_22" id="clear_canvas2">
                <div class="div_d">
                    <a href="/TyRyBottleInChina/Pc/draw" class="link_4 "><i>自己绘制</i></a>
                    <a href="javascript:" class="link_5 current"><i>上传图片</i></a>
                    <a href="/TyRyBottleInChina/Pc/compound" class="link_6"><i>素材合成</i></a>
                </div>
                <div class="div_box2">
                    <div style="padding:15px; padding-left:20px;padding-right:0px;">
                        <input type="file" id="id_file">
                        <div id="file_upload_1">

                        </div>
                        <p class='p_5'>请选择喜欢的滤镜风格</p>
                        <ul class="ul_list_3">
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source.jpg" data-filter="source" title="原风格">
                            </li>
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source_Gotham.jpg" data-filter="Gotham" title="黑白">
                            </li>
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source_Lomo.jpg" data-filter="Lomo" title="饱和">
                            </li>
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source_Toaster.jpg" data-filter="Toaster" title="复古">
                            </li>
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source_Nashville.jpg" data-filter='Nashville' title="掉色">
                            </li>
                            <li>
                                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/source_TiltShift.jpg" data-filter="TiltShift" title="缩微">
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="con_post1">
                    <input type="type" class="input_1" placeholder="为你的作品起个名字">

                    <span class="but_1" data-type="2" data-flag="<?php echo ($user?1:0); ?>">预览</span>
                    <span class="but_2" data-type="2" data-flag="<?php echo ($user?1:0); ?>">提交</span>
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