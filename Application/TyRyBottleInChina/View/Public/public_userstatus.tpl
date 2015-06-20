<div class="page_header">
    <div class="header_con">
        <php> $user=session('user'); if($user){ </php>
            <span class="span_deng">
                <img src="{$user.headimgurl}" width="40" height="40" id="headurl">
                <em id="nickname">{$user.nickname}</em>
                <a href="__URL__/workshow">我的作品</a>
            </span>
        <php> }else{ </php>
            <span class="span_deng" style="display: none;">
                <img src="{$user.headimgurl}" width="40" height="40" id="headurl">
                <em id="nickname">{$user.nickname}</em>
                <a href="__URL__/workshow">我的作品</a>
            </span>
            <span class="span_login" >登录</span>
        <php> } </php>
        <span class="span_weixin">微信参与</span>
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a5_03.png" class="img_1">
    </div>
</div>

<php>$code=getRandChar(10);</php>
<div class="page_box_1" id="message_ma">
    <div class="div_box_ma">       
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/b4_05.jpg" class="close_ma">
        <div class="class_ma">
            <p style="text-align: center;font-weight: 600;">请使用微信扫一扫</p>
            <p style="text-align: center;font-weight: 600;">登录并参与活动</p>
            <img src="__MODULE__/PcWxApi/qrcode/code/{$code}" class="img_2" data-code="{$code}">
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