<include file="./Application/TyRyBottleInChina/View/Public/Wx_header.tpl" />

<body class="bg3">
<div class="">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/k-1_02.png" class="img_c_1">
    <div class="div_right1">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_03.png" class="link_url" data-url="__URL__/participation">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_05.png" class="link_url" data-url="" style="display:none;">
    </div>
    <div class="page_list">
        <ul class="nav_1">
            <li data-url="__URL__/worklist/order/{$data['order']}/type/0" class="link_url {$data['type']==0?'current':''}">全部</li>
            <li data-url="__URL__/worklist/order/{$data['order']}/type/2" class="link_url {$data['type']==2?'current':''}">上传</li>
            <li data-url="__URL__/worklist/order/{$data['order']}/type/3" class="link_url {$data['type']==3?'current':''}">合成</li>
        </ul>
        <ul class="nav_2">
            <li  data-url="__URL__/worklist/award/1" class="link_url {$data['listtype']==1?'current':''}">获奖作品</li>
            <li  data-url="__URL__/worklist/award/2" class="link_url {$data['listtype']==2?'current':''}">我的作品</li>
        </ul>
        <ul class="nav_3">
            <li data-url="__URL__/worklist/order/1/type/{$data['type']}" class="link_url {$data['order']==1?'current':''}">热度</li>
            <li data-url="__URL__/worklist/order/2/type/{$data['type']}" class="link_url {$data['order']==2?'current':''}">三周</li>
        </ul>
    </div>
    <ul class="ullist_1">
        <volist name="list" id="vo">
            <li>
                <if condition="$vo.my eq 0">
                    <a href="__URL__/workparticulars/id/{$vo.id}">
                </if>
                <if condition="$vo.my eq 1">
                    <a href="__URL__/work/id/{$vo.id}">
                </if>
                    <img src="{$vo.centerimg}"  style="width:40px; height:131px;" >
                    <if condition="$vo.giftid eq 1">
                        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/aa_1.png">
                    </if>
                </a>
                <p>{$vo.username}</p>
                <p>{$vo.workname}</p>
                <b>{$vo.poll}票</b>
                <if condition="$vo.my eq 0">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_18.png" class="span_tou link_url" data-url="__URL__/workparticulars/id/{$vo.id}">
                </if>
                <if condition="$vo.my eq 1">
                <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_18.png" class="span_tou link_url" data-url="__URL__/work/id/{$vo.id}">
                </if>

            </li>
        </volist>
    </ul>
    <div class="clear"></div>
    <div class="page_div_1">
        <div class="cuspages">
            <div class="pg">
                {$page}
            </div>
        </div>
    </div>
</div>
<include file="./Application/TyRyBottleInChina/View/Public/Wx_footer.tpl" />