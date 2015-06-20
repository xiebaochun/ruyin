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
<div class="page_index page_bg_2n">
    <div class="div_con_1">
        <div class="div_text_2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a18_02.png" class="img_14" style="opacity:1;-webkit-transform:translate(0px,0px);">
            <div class="page_zp">
                <ul class="ullist_5">
                    <?php if(is_array($works)): $i = 0; $__LIST__ = $works;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="/TyRyBottleInChina/Pc/work/id/<?php echo ($vo["id"]); ?>">
                              <img src="<?php echo ($vo["centerimg"]); ?>" style="width:77px; height:251px;">
                              <?php if($vo["giftid"] == 1): ?><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/aa_1.png" class="img_u1"><?php endif; ?>
                            </a>
                            <p><?php echo ($vo["username"]); ?></p>
                            <p><?php echo ($vo["workname"]); ?></p>
                            <span class="piao"><?php echo ($vo["poll"]); ?>票</span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="page_div_1">
                    <div class="cuspages">
                        <div class="pg">
                            <?php echo ($page); ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


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