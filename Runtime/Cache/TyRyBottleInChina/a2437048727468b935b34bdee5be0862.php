<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="Cache-Control" content="must-revalidate" />
    <title>如饮</title>
    <meta name="description" content="如饮"  id="desc"/>
    <meta name="author" content="wangyuan" />
    <style>
        *{padding:0px;margin:0px;}
        html,body{width:100%;height:100%;position:relative;}
    </style>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/esl.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.1.js"></script>
    <script src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/js/jquery.transit.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/weixin.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/gesture.js"></script>
    <script src="/Public/TyRyBottleInChina/Wx/js/main.js"></script>

    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/main.css">
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/Wx/css/index.css">
</head>

<body class="bg3">
<div class="">
    <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/k-1_02.png" class="img_c_1">
    <div class="div_right1">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_03.png" class="link_url" data-url="/TyRyBottleInChina/Wx/participation">
        <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_05.png" class="link_url" data-url="" style="display:none;">
    </div>
    <div class="page_list">
        <ul class="nav_1">
            <li data-url="/TyRyBottleInChina/Wx/worklist/order/<?php echo ($data['order']); ?>/type/0" class="link_url <?php echo ($data['type']==0?'current':''); ?>">全部</li>
            <li data-url="/TyRyBottleInChina/Wx/worklist/order/<?php echo ($data['order']); ?>/type/2" class="link_url <?php echo ($data['type']==2?'current':''); ?>">上传</li>
            <li data-url="/TyRyBottleInChina/Wx/worklist/order/<?php echo ($data['order']); ?>/type/3" class="link_url <?php echo ($data['type']==3?'current':''); ?>">合成</li>
        </ul>
        <ul class="nav_2">
            <li  data-url="/TyRyBottleInChina/Wx/worklist/award/1" class="link_url <?php echo ($data['listtype']==1?'current':''); ?>">获奖作品</li>
            <li  data-url="/TyRyBottleInChina/Wx/worklist/award/2" class="link_url <?php echo ($data['listtype']==2?'current':''); ?>">我的作品</li>
        </ul>
        <ul class="nav_3">
            <li data-url="/TyRyBottleInChina/Wx/worklist/order/1/type/<?php echo ($data['type']); ?>" class="link_url <?php echo ($data['order']==1?'current':''); ?>">热度</li>
            <li data-url="/TyRyBottleInChina/Wx/worklist/order/2/type/<?php echo ($data['type']); ?>" class="link_url <?php echo ($data['order']==2?'current':''); ?>">三周</li>
        </ul>
    </div>
    <ul class="ullist_1">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                <?php if($vo["my"] == 0): ?><a href="/TyRyBottleInChina/Wx/workparticulars/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>
                <?php if($vo["my"] == 1): ?><a href="/TyRyBottleInChina/Wx/work/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>
                    <img src="<?php echo ($vo["centerimg"]); ?>"  style="width:40px; height:131px;" >
                    <?php if($vo["giftid"] == 1): ?><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/aa_1.png"><?php endif; ?>
                </a>
                <p><?php echo ($vo["username"]); ?></p>
                <p><?php echo ($vo["workname"]); ?></p>
                <b><?php echo ($vo["poll"]); ?>票</b>
                <?php if($vo["my"] == 0): ?><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_18.png" class="span_tou link_url" data-url="/TyRyBottleInChina/Wx/workparticulars/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>
                <?php if($vo["my"] == 1): ?><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/Wx/images/st_7_18.png" class="span_tou link_url" data-url="/TyRyBottleInChina/Wx/work/id/<?php echo ($vo["id"]); ?>"><?php endif; ?>

            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <div class="clear"></div>
    <div class="page_div_1">
        <div class="cuspages">
            <div class="pg">
                <?php echo ($page); ?>
            </div>
        </div>
    </div>
</div>
<div class="page_loading">
	<div class="load_box">
		正在加载中...
	</div>
</div>

</body>
</html>