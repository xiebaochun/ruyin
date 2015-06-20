<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />

<body class="body_1 body_index" id="page_re">
<style>
	#page_re{position:fixed;}
</style>
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />

<script>
$(function(){
console.log('change')		
		var w=$(window).width(),h=$(window).height();
		if( w<=1650 && h<=1000){
			 $("#page_re .img_4").css('width','106%');
			 $("#page_re .img_4").css("height","100%");
			 $("#page_re .img_4").css("margin-top","-8%");
			 $("#page_re .img_6").css('top','52%');
			 $("#page_re .img_6").css("right","20%");
			 $("#page_re .img_6").css("width","5%");
		}else{
			
		}
		if( w<=1370 && h<=800){
			 $("#page_re .img_4").css('width','93%');
			 $("#page_re .img_4").css("height","76%");
			 $("#page_re .img_4").css("margin-top","-4%");
			 $("#page_re .img_6").css('top','41%');
			 $("#page_re .img_6").css("right","29%");
			 $("#page_re .img_6").css("width","4%");
		}else{
		
		}
		
		
})		
</script>
<div class="page_index page_cont_re">
    <div class="div_con_1">
        <div class="div_text_1">
            <div class="img_4">
			
                   <script>
		 	     var userAgent = navigator.userAgent; 
               var mac=userAgent.indexOf("Safari") > -1 && userAgent.indexOf("Chrome") < 1
              // mac=true;
               $(function(){
               	  if(mac){
               	   $(".cl_c").show();
               	   $("#FlashID").hide().remove();
               	   //$("#FlashID").html('a')
                 }
               })
               //alert(mac);
				
			
               </script>
            
               <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a2_06.png" class="cl_c" style="display:none;margin-left: -90px;margin-top: -14px;">              
               
               
               
               
		 		<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="184" height="590">
  <param name="movie" value="/Public/TyRyBottleInChina/images/flash.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  <param name="swfversion" value="15.0.0.0" />
  <!-- 此 param 标签提示使用 Flash Player 6.0 r65 和更高版本的用户下载最新版本的 Flash Player。如果您不想让用户看到该提示，请将其删除。 -->
  <param name="expressinstall" value="Scripts/expressInstall.swf" />
  <!-- 下一个对象标签用于非 IE 浏览器。所以使用 IECC 将其从 IE 隐藏。 -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="/Public/TyRyBottleInChina/images/flash.swf" width="184" height="590" id="not_ie">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    <param name="swfversion" value="15.0.0.0" />
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
    <div>
      <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="获取 Adobe Flash Player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
            </div>
			<!--
			<div class="img_8"></div>
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a2_03.png" class="img_5">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a2_09.png" class="img_7">
			-->
			<img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a2_13.png" class="img_6" onClick="location.href='__URL__/participation';">
        </div>
    </div>
</div>

<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />