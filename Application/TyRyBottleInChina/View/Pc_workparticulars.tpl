<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=109815&style=-1"></script>
<body class="body_1">
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />
<div class="page_index page_bg_4">
    <div class="page_post">
        <div class="page_post_left">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_07.png" class="prev_1">
            <img src="{$works['centerimg']}"
                 data-center="{$works['centerimg']}"
                 data-right="{$works['rightimg']}"
                 data-left="{$works['leftimg']}"  class="id_img_1">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_12.png" class="next_1">
        </div>
        <div class="page_post_left_2"  style="display:none;">
            <iframe id="if_frame_canvas" style="display:none;"></iframe>
            <script>
                var ie=navigator.appVersion.indexOf('IE')>-1;
                 var userAgent = navigator.userAgent; 
                var mac=userAgent.indexOf("Safari") > -1 && userAgent.indexOf("Chrome") < 1;
                if(Modernizr.canvas && !mac){
                    Main.imgbg='{$works['img']}';
                    $("#if_frame_canvas").attr('src','/Public/TyRyBottleInChina/ruyin/index.html?v='+Math.random()*1000).show();
                    $(".page_post_left_2").show();
                    $(".page_post_left").hide();
                }
            </script>
        </div>

        <div class="page_post_right">
            <p>
                <i>作者:</i><span>{$works['username']}</span><br>
                <i>作品名称:</i><span>{$works['workname']}</span><br>
                <i>发布时间:</i><span>{$works['date']}</span><br>
                <i>当前票数:</i><span>{$works['poll']}</span>
            </p>
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
                        url:location.href,
                        summary: "秀出最美中国风。小伙伴们快来戳一下我的作品，投票也能赢大奖！",
                        pic: Main.url+'{$works['centerimg']}'
                    });
                </script>
            </div>

            <?php if($wtype == 0){ ?>
                <span class="tou_cc" data-id="{$works['id']}" data-flag="{$user?1:0}" style="float:left;margin-right:10px;">投票</span>
            <?php } ?>
            <a href="__URL__/worklist" style="margin-top:10px;"><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_15.png" ></a>

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
<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />