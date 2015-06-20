<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />
 <!--[if IE]>       
        <script type="text/javascript">           
            ie=true;
        </script>
    <![endif]-->
<body class="body_1">
<script>
//ie=true;
</script>
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />

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
                    <a href="__URL__/draw" class="link_4 "><i>自己绘制</i></a>
                    <a href="javascript:" class="link_5 current"><i>上传图片</i></a>
                    <a href="__URL__/compound" class="link_6"><i>素材合成</i></a>
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

                    <span class="but_1" data-type="2" data-flag="{$user?1:0}">预览</span>
                    <span class="but_2" data-type="2" data-flag="{$user?1:0}">提交</span>
                </div>
            </div>
        </div>
    </div>
</div>

{//参与}
<include file="./Application/TyRyBottleInChina/View/Public/public_participation.tpl" />

<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />