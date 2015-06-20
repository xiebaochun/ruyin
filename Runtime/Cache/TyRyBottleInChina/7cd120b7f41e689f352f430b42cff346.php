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
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=109815&style=-1"></script>
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
<div class="page_index page_bg_4">
    <div class="page_post">
		<div class="page_post_left">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_07.png" class="prev_1">
            <img src="<?php echo ($works['centerimg']); ?>" 
            data-center="<?php echo ($works['centerimg']); ?>"
             data-right="<?php echo ($works['rightimg']); ?>"
              data-left="<?php echo ($works['leftimg']); ?>"  class="id_img_1">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_12.png" class="next_1">
        </div>
        <div class="page_post_left_2"  style="display:none;">			
			<iframe id="if_frame_canvas" style="display:none;"></iframe>
			 <script>
                var ie=navigator.appVersion.indexOf('IE')>-1;
                 var userAgent = navigator.userAgent; 
                var mac=userAgent.indexOf("Safari") > -1 && userAgent.indexOf("Chrome") < 1;
                if(Modernizr.canvas && !mac){
                    Main.imgbg='<?php echo ($works['img']); ?>';
                    $("#if_frame_canvas").attr('src','/Public/TyRyBottleInChina/ruyin/index.html?v='+Math.random()*1000).show();
                    $(".page_post_left_2").show();
                    $(".page_post_left").hide();
                }
            </script>
		</div>
        <div class="page_post_right">
            <p>
                <i>作者:</i><span><?php echo ($works['username']); ?></span><br>
                <i>作品名称:</i><span><?php echo ($works['workname']); ?></span><br>
                <i>发布时间:</i><span><?php echo ($works['date']); ?></span><br>
                <i>当前票数:</i><span><?php echo ($works['poll']); ?></span></p>
            <div style="padding-bottom:40px;clear:both;padding-left:145px;">

                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_03.png" >
                <div class="bdsharebuttonbox  bdshare-button-style0-32" data-bd-bind="1432278467271">
                    <a href="#" class="bds_more"  onclick="javascript:bShare.more(event);return false;" title="更多平台"></a>
                    <a href="#" class="bds_qzone" title="分享到QQ空间"  onclick="javascript:bShare.share(event,'qzone',0);return false;"></a>
                    <a href="#" class="bds_tsina" title="分享到新浪微博" onclick="javascript:bShare.share(event,'sinaminiblog',0);return false;"></a>
                    <a href="#" class="bds_weixin"   onclick="javascript:bShare.share(event,'weixin',0);return false;" title="分享到微信"></a>
                </div>

                <script type="text/javascript" charset="utf-8">
                    bShare.addEntry({
                        title: "#统一如饮【瓶上中国】#",
                        url:Main.url+'TyRyBottleInChina/Pc/workparticulars/id/'+<?php echo ($works['id']); ?>,
                        summary: "秀出最美中国风。小伙伴们快来戳一下我的作品，投票也能赢大奖！",
                        pic: Main.url+'<?php echo ($works['centerimg']); ?>'
                    });
                </script>
            </div>

            <a href="/TyRyBottleInChina/Pc/<?php echo ($name); ?>" style="margin-right:10px;"><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_09.png" ></a>
            <a href="/TyRyBottleInChina/Pc/worklist"><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_15.png" ></a>
        </div>
    </div>
</div>
<script>
    $(function(){
        var c = 1;
        $('.next_1').click(function(){
            if(c == 1) {
                var a = $('.id_img_1').attr('data-right');
                $('.id_img_1').attr('src', a);
                $(this).hide();
                c++;
            }else if(c == 0){
                var a = $('.id_img_1').attr('data-center');
                $('.id_img_1').attr('src', a);
                $('.prev_1').show();
                c++;
            }
        });
        $('.prev_1').click(function(){
            if(c == 2) {
                var b = $('.id_img_1').attr('data-center');
                $('.id_img_1').attr('src', b);
                c--;
            }else if(c == 1){
                var b = $('.id_img_1').attr('data-left');
                $('.id_img_1').attr('src', b);
                $(this).hide();
                $('.next_1').show();
                c--;
            }
        });
    });

</script>


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