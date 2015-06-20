<include file="./Application/TyRyBottleInChina/View/Public/Wx_header.tpl" />

<body class="bg3">
<div class="">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_19_02.png" class="img_c_1">
    <div class="div_right1">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_03.png" class="link_url" data-url="__URL__/participation" style="margin-right:20px;height:30px;">

    </div>
    <div style="width:100%;position:relative;margin-top:9%;">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_20_02.png" class="img_j1" style="margin-top:0px;">
        <span style="width:50%;left:0px;top:0px;height:100%;display:block;position:absolute;"  class="left_1"></span>
        <span style="width:50%;left:50%;top:0px;height:100%;display:block;position:absolute;" class='right_1'></span>
    </div>
    
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/j2.png" class="img_j2">
     <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/j1.png" class="img_j2" style="display:none;">
    <p class="p_3">*更多参与方式请关注如饮官方网页</p>
</div>
<script>
$(function(){
    $('.left_1').on('touchend',function(){
        $(".img_j2").hide().eq(0).show();
    })
    $('.right_1').on('touchend',function(){
        $(".img_j2").hide().eq(1).show();
    })
})
</script>
<include file="./Application/TyRyBottleInChina/View/Public/Wx_footer.tpl" />