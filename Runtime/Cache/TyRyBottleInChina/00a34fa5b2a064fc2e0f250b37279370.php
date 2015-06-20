<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>如饮</title>
    <meta name="description" content="" />
    <meta name="author" content="star" />
    <link rel="stylesheet" type="text/css" href="/Public/TyRyBottleInChina/css/index.css">
    <script src="/Public/TyRyBottleInChina/js/jquery.1.js"></script>
    
    <script src="/Public/TyRyBottleInChina/js/modernizr.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.uploadify.min.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.event.ue.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.udraggable.js"></script>
    <script src="/Public/TyRyBottleInChina/js/esl.js"></script>
    <script>
        ie=0;
    </script>
    <script src="/Public/TyRyBottleInChina/js/main.js"></script>
    <script src="/Public/TyRyBottleInChina/js/jquery.transit.js"></script>
</head>

<div class="page_index page_bg_4">
    <div class="div_con_1">
        <div class="div_info_1">
            <img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/u4_03.jpg" class="img_i1">
            <p class="p_8">恭喜您获得<?php echo ($jiang); ?>，感谢您参与本次活动，<br>请留下有效的联系方式，以便您能及时收到奖品。</p>
            <table class="table_1">
                <tbody>
                <tr>
                    <th>手机号码</th>
                    <td><input type="text" class="input_2" id="id_tel"></td>
                </tr>
                <tr>
                    <th>收件人姓名</th>
                    <td><input type="text" class="input_2" id="id_name"></td>
                </tr>
                <tr>
                    <th>收货地址</th>
                    <td><input type="text" class="input_2" id="id_add"></td>
                </tr>
                <tr>
                    <th><input type="hidden" value="<?php echo ($wid); ?>" id="gid"></th>
                    <td><img src="http://static.sinreweb.com/2015/TyRyBottleInChina/bottle/images/u10_09.jpg" class="but_info"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="page_footer">
    <ul class="footer_ul">
        <?php $action_name=$Think.ACTION_NAME ?>
        <li><a href="/TyRyBottleInChina/Pc/index" <?php echo ($action_name=='index'?'class="current"':''); ?>>首页</a></li>
        <li ><a href="/TyRyBottleInChina/Pc/introduction" <?php echo ($action_name=='introduction'?'class="current"':''); ?>>活动介绍</a></li>
        <li><a href="/TyRyBottleInChina/Pc/prodisplay" <?php echo ($action_name=='prodisplay'?'class="current"':''); ?>>产品展示</a></li>
        <li><a href="/TyRyBottleInChina/Pc/participation" <?php if(($action_name == 'participation') OR ($action_name == 'draw') OR ($action_name == 'uploadpic') OR ($action_name == 'compound')): ?>class="current"<?php endif; ?>>参与方式</a></li>
        <li><a href="/TyRyBottleInChina/Pc/worklist" <?php echo ($action_name=='worklist'?'class="current"':''); ?>>作品展示</a></li>
        <li><a href="/TyRyBottleInChina/Pc/rules" <?php echo ($action_name=='rules'?'class="current"':''); ?>>活动规则</a></li>
        <li><a href="/TyRyBottleInChina/Pc/prizes" <?php echo ($action_name=='prizes'?'class="current"':''); ?>>奖品设置</a></li>
    </ul>
</div>

</body>
</html>