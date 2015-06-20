
<div class="page_footer">
    <ul class="footer_ul">
        <php>$action_name=$Think.ACTION_NAME</php>
        <li><a href="__URL__/index" {$action_name=='index'?'class="current"':''}>首页</a></li>
        <li ><a href="__URL__/introduction" {$action_name=='introduction'?'class="current"':''}>活动介绍</a></li>
        <li><a href="__URL__/prodisplay" {$action_name=='prodisplay'?'class="current"':''}>产品展示</a></li>
        <li><a href="__URL__/participation" <if condition="($action_name eq 'participation') OR ($action_name eq 'draw') OR ($action_name eq 'uploadpic') OR ($action_name eq 'compound')">class="current"</if>>参与方式</a></li>
        <li><a href="__URL__/worklist" {$action_name=='worklist'?'class="current"':''}>作品展示</a></li>
        <li><a href="__URL__/rules" {$action_name=='rules'?'class="current"':''}>活动规则</a></li>
        <li><a href="__URL__/prizes" {$action_name=='prizes'?'class="current"':''}>奖品设置</a></li>
    </ul>
</div>

</body>
</html>