<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />

<body class="body_1">
<script>Main.worklist=1;</script>
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />
<div class="page_index page_bg_2n">
    <div class="div_con_1">
        <div class="div_text_2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a18_02.png" class="img_14" style="opacity:1;-webkit-transform:translate(0px,0px);">
            <div class="page_zp">
                <p class="p_n1">
                    <a href="__URL__/worklist/order/1/type/{$data['type']}" class="{$data['order']==1?'current':''}">热度</a><a href="__URL__/worklist/order/2/type/{$data['type']}" class="{$data['order']==2?'current':''}">最近三周</a>
                </p>
                <p class="p_n2">
                    <a href="__URL__/worklist/order/{$data['order']}/type/0" class="{$data['type']==0?'current':''}">全部</a>
                    <a href="__URL__/worklist/order/{$data['order']}/type/1" class="{$data['type']==1?'current':''}">手绘</a>
                    <a href="__URL__/worklist/order/{$data['order']}/type/2" class="{$data['type']==2?'current':''}">上传</a>
                    <a href="__URL__/worklist/order/{$data['order']}/type/3" class="{$data['type']==3?'current':''}">合成</a>
                    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/b2_03.png" onclick="location.href='__URL__/worklist/award/1';">
                </p>
                <ul class="ullist_5">
                    <volist name="list" id="vo">
                    <li>
                        <if condition="$vo.my eq 0">
                            <a href="__URL__/workparticulars/id/{$vo.id}">
                        </if>
                        <if condition="$vo.my eq 1">
                            <a href="__URL__/work/id/{$vo.id}">
                        </if>

                        <img src="{$vo.centerimg}"  style="width:77px; height:251px;" >
                         <if condition="$vo.giftid eq 1">
                        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/aa_1.png" class="img_u1">
                        </if>
                        </a>
                        <p>{$vo.username}</p>
                        <p>{$vo.workname}</p>
                        <span class="piao">{$vo.poll}票</span>
                        <if condition="$vo.flag eq 0"><span class="span_tou" data-id="{$vo.id}" data-flag="{$user?1:0}" >投票</span></if>
                        <if condition="$vo.flag eq 1"><span  data-id="{$vo.id}"  class="span_touend"  data-flag="{$user?1:0}">投票</span></if>
                    </li>
                    </volist>
                </ul>
                <div class="page_div_1">
                    <div class="cuspages">
                        <div class="pg">
                            {$page}
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

<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />