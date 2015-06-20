<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />

<body class="body_1">
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />

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
                    <a href="__URL__/uploadpic" class="link_5"><i>上传图片</i></a>
                    <a href="__URL__/compound" class="link_6"><i>素材合成</i></a>
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
                    <span class="but_1" data-type="1" data-flag="{$user?1:0}">预览</span>
                    <span class="but_2"  data-type="1" data-flag="{$user?1:0}">提交</span>
                </div>
            </div>
        </div>
    </div>
</div>

{//参与}
<include file="./Application/TyRyBottleInChina/View/Public/public_participation.tpl" />

<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />