<include file="./Application/TyRyBottleInChina/View/Public/header.tpl" />
<body class="body_1">
{// 用户状态}
<include file="./Application/TyRyBottleInChina/View/Public/public_userstatus.tpl" />
<div class="page_index page_bg_2n">
    <div class="div_con_1">
        <div class="div_text_2">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/a18_02.png" class="img_14" style="opacity:1;-webkit-transform:translate(0px,0px);">
            <div class="page_zp">
                <ul class="ullist_5">
                    <volist name="works" id="vo">
                        <li>
                            <a href="__URL__/work/id/{$vo.id}">
                              <img src="{$vo.centerimg}" style="width:77px; height:251px;">
                              <if condition="$vo.giftid eq 1">
                        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/aa_1.png" class="img_u1">
                        </if>
                            </a>
                            <p>{$vo.username}</p>
                            <p>{$vo.workname}</p>
                            <span class="piao">{$vo.poll}票</span>
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

<include file="./Application/TyRyBottleInChina/View/Public/footer.tpl" />