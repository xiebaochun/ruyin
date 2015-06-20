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
<script>Main.worklist=1;</script>

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
                <p class="p_n1">
                    <a href="/TyRyBottleInChina/Pc/worklist/order/1/type/<?php echo ($data['type']); ?>" class="<?php echo ($data['order']==1?'current':''); ?>">热度</a><a href="/TyRyBottleInChina/Pc/worklist/order/2/type/<?php echo ($data['type']); ?>" class="<?php echo ($data['order']==2?'current':''); ?>">最近三周</a>
                </p>
                <p class="p_n2">
                    <a href="/TyRyBottleInChina/Pc/worklist/order/<?php echo ($data['order']); ?>/type/0" class="<?php echo ($data['type']==0?'current':''); ?>">全部</a>
                    <a href="/TyRyBottleInChina/Pc/worklist/order/<?php echo ($data['order']); ?>/type/1" class="<?php echo ($data['type']==1?'current':''); ?>">手绘</a>
                    <a href="/TyRyBottleInChina/Pc/worklist/order/<?php echo ($data['order']); ?>/type/2" class="<?php echo ($data['type']==2?'current':''); ?>">上传</a>
                    <a href="/TyRyBottleInChina/Pc/worklist/order/<?php echo ($data['order']); ?>/type/3" class="<?php echo ($data['type']==3?'current':''); ?>">合成</a>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/b2_03.png" onclick="location.href='/TyRyBottleInChina/Pc/worklist/award/1';">
                </p>
                <ul class="ullist_5">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <?php if($vo["my"] == 0): ?><a href="/TyRyBottleInChina/Pc/workparticulars/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>
                        <?php if($vo["my"] == 1): ?><a href="/TyRyBottleInChina/Pc/work/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>

                        <img src="<?php echo ($vo["centerimg"]); ?>"  style="width:77px; height:251px;" >
                         <?php if($vo["giftid"] == 1): ?><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/aa_1.png" class="img_u1"><?php endif; ?>
                        </a>
                        <p><?php echo ($vo["username"]); ?></p>
                        <p><?php echo ($vo["workname"]); ?></p>
                        <span class="piao"><?php echo ($vo["poll"]); ?>票</span>
                        <?php if($vo["flag"] == 0): ?><span class="span_tou" data-id="<?php echo ($vo["id"]); ?>" data-flag="<?php echo ($user?1:0); ?>" >投票</span><?php endif; ?>
                        <?php if($vo["flag"] == 1): ?><span  data-id="<?php echo ($vo["id"]); ?>"  class="span_touend"  data-flag="<?php echo ($user?1:0); ?>">投票</span><?php endif; ?>
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

<div class="page_box_1" id="box_jiang">
    <div class="box_jiang_con">
        <span class="box_1_close box_1_close2"></span>
        <h2>投票成功！</h2>
        <p class="p1">感谢您的参与，点击抽奖有机会获得小礼品</p>
        <div class='div_cou2'>
            <span class="img_b1"></span>
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/b10_06.png" class="img_b2"  data-id="">
        </div>
        <div id="id_con" style="display:none;">
            <p class="p2"></p>
            <p class="p3"></p>
            <a href="" id="id_jiang" style="display:block;"><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/u10_09.jpg" class="img_post1"></a>
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