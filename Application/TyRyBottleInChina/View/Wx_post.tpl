<include file="./Application/TyRyBottleInChina/View/Public/Wx_header.tpl" />

<body>
<div class="page_index bg3">
    <div class="page_show">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_11_02.png" class="img_s1">
        <div>
        
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_07.png" class="prev_1">
            <img src="{$works['centerimg']}"
                 data-center="{$works['centerimg']}"
                 data-right="{$works['rightimg']}"
                 data-left="{$works['leftimg']}"  class="img_s2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a15_12.png" class="next_1">

            <p class="pb1">
                <i>作者:</i><span>{$works['username']}</span>
                <i>作品名称:</i><span>{$works['workname']}</span>
                <i>发布时间:</i><span>{$works['date']}</span>
                <em>当前票数:  {$works['poll']} </em>
            </p>
           

        </div>
         <p class="pb2">
                <?php if($my == 1){ ?>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_6_06.png" class='link_url' data-url='__URL__/worklist/award/2'>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_6_03.png" class='link_url' data-url='__URL__/index' data-share="1">
                <?php }else{ ?>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/h-1_06.png" class='link_url' data-url='__URL__/worklist'>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/h-2_03.png" class='link_url' data-url='__URL__/{$name}'>
                <?php }?>
            </p>
    </div>
</div>
<div class="page_f">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_03.png">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_07.png" class='f_prev'>
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_8_11.png">
</div>
<script>
    $(function(){
        dataForWeixin.url=location.href;
        var c = 1;
        $('.next_1').click(function(){
            if(c == 1) {
                var a = $('.img_s2').attr('data-right');
                $('.img_s2').attr('src', a);
                $(this).hide();
                c++;
            }else if(c == 0){
                var a = $('.img_s2').attr('data-center');
                $('.img_s2').attr('src', a);
                $('.prev_1').show();
                c++;
            }
        });
        $('.prev_1').click(function(){
            if(c == 2) {
                var b = $('.img_s2').attr('data-center');
                $('.img_s2').attr('src', b);
                c--;
            }else if(c == 1){
                var b = $('.img_s2').attr('data-left');
                $('.img_s2').attr('src', b);
                $(this).hide();
                $('.next_1').show();
                c--;
            }
        });
    });
</script>
<include file="./Application/TyRyBottleInChina/View/Public/Wx_footer.tpl" />