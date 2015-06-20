<div class='div_box_1'>
    <div class="div_box_1_con1">
        <span class="box_1_close" id="id_box_1_color"></span>
        <div class="div_box_1_con1_left">
            <img src="" class="img_h1">
            <iframe id="if_frame_canvas" style="display:none;"></iframe>
            <!--<img src="" class="img_h3">-->
        </div>
        <div class="div_box_1_con1_right">
            <php> $user=session('user'); </php>
            <p>作者:  <span id="author">{$user.nickname}</span><br>作品名称:  <span class="span_zp_name"></span></p>
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a14_06.png" class="but_img1">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a14_09.png" class="but_img2">
        </div>
    </div>
</div>
<form id="form_1" style="display:none;"  action="__MODULE__/PcInterfaceImage/upload" method="post" >
    <textarea id="id_base64" name="base"></textarea>
    <input type="text" name="title" id="id_form_title">
    <input type="text" name="num" id="id_num">
    <input type="text" name="scale" id="id_scale">
    <input type="text" name="arr"  id="id_arr">
    <input type="text" name="class" id="id_class">
    <php>$action_name=$Think.ACTION_NAME</php>
    <input type="text" name="type" value="<if condition='$action_name eq draw'>1<elseif condition="$action_name eq uploadpic"/>2<elseif condition="$action_name eq compound"/>3</if>">

</form>