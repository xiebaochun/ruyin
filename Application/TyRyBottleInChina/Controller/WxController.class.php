<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/13
 * Time: 11:21
 */
namespace TyRyBottleInChina\Controller;

class WxController extends WxBaseController {

    public function __construct() {

        parent::__construct();
    }

    //首页
    public function index() {

        $this->display('Wx_index');
    }

    //活动介绍
    public function introduction() {

        $this->display('Wx_introduction');
    }

    //产品展示
    public function prodisplay() {

        $this->display('Wx_prodisplay');
    }

    //作品展示
    public function workshow() {

        $count = M('work')->where(array('userid'=>$this->user['id']))->count();
        $page = new \Think\Page($count, 10);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $page->rollPage = 10;
        $show = $page->show();

        $works = M('work')->where(array('userid'=>$this->user['id']))->limit($page->firstRow.','.$page->listRows)->order('poll DESC ')->field('id,type,userid,username,giftid,centerimg,workname,votestr,poll,LEFT(`addtime`, 10) as date')->select();

        $this->assign('page', $show);
        $this->assign('works', $works);
        $this->display('Wx_workshow');
    }

    //作品展示
    public function work() {

        $id = I('get.id');
        $works = M('work')->where(array('id'=>$id))->field('id,type,userid,username,centerimg,rightimg,leftimg,workname,poll,LEFT(`addtime`, 10) as date')->find();
        if($works['userid'] == $this->user['id']){
            $my = 1;
        }else{
            $my = 0;
        }
        switch($works['type']){
            case 1:
                $name = 'draw';
                break;
            case 2:
                $name = 'uploadpic';
                break;
            case 3:
                $name = 'compound';
                break;
            default:
                $name = 'draw';
                break;
        }
        $this->assign('works', $works);
        $this->assign('name', $name);
        $this->assign('my', $my);
        $this->display('Wx_post');
    }

    //作品展示
    public function workparticulars() {
        $id = I('get.id');
        $wtype = 0;
        $votes = array();
        $works = M('work')->where(array('id'=>$id))->field('id,type,userid,votestr,username,centerimg,rightimg,leftimg,workname,poll,LEFT(`addtime`, 10) as date')->find();

        $votes = explode(',',$works['votestr']);
        if($works['userid'] == $this->user['id'] || in_array($this->user['id'],$votes)){
            $wtype = 1;
        }else{
            $wtype = 0;
        }
        switch($works['type']){
            case 2:
                $name = 'uploadpic';
                break;
            case 3:
                $name = 'compound';
                break;
            default:
                $name = 'uploadpic';
                break;
        }
        $this->assign('works', $works);
        $this->assign('wtype', $wtype);
        $this->assign('name', $name);
        $this->display('Wx_workparticulars');
    }

    //作品展示列表
    public function worklist() {

        $votes = $workmy = array();
        $data['type'] = $_GET['type'] ? $_GET['type'] : 0;
        $data['order'] = $_GET['order'] ? $_GET['order'] : 1;
        $data['listtype'] =$_GET['award'] ? $_GET['award'] : 0;

        if($data['order']){
            if($data['order'] == 1) {
                $order = ' poll DESC ';
            }else{
                $order = ' id DESC,poll DESC ';
            }
        }
        if($data['type']){
            $where['type'] = $data['type'];
        }

        if($data['listtype']){
            if($data['listtype'] == 1){
                $where['giftid'] = array('gt','0');
            }elseif($data['listtype'] == 2){
                $where['userid'] = $this->user['id'];
            }
        }

        if($data['order'] == 2){
            $where['addtime'] = array('gt',date('Y-m-d 00:00:00' ,strtotime('-20 day')));
        }

        $count = M('work')->where($where)->count();
        $page = new \Think\Page($count, 6);
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $page->rollPage=10;

        $show = $page->show();
        $tops = M('work')->where($where)->order($order)->limit($page->firstRow.','.$page->listRows)->field('id,type,userid,username,giftid,centerimg,workname,votestr,poll,LEFT(`addtime`, 10) as date')->select();

        foreach($tops as $k=>$v){

            $votes = explode(',',$v['votestr']);
            if($v['userid'] == $this->user['id'] || in_array($this->user['id'],$votes)){
                $tops[$k]['flag'] = 1;
            }else{
                $tops[$k]['flag'] = 0;
            }

            if($v['userid'] == $this->user['id']){
                $tops[$k]['my'] = 1;
            }else{
                $tops[$k]['my'] = 0;
            }
        }

        $this->assign('page', $show);
        $this->assign('data', $data);
        $this->assign('list', $tops);
        $this->display('Wx_worklist');
    }

    //提交获奖信息
    public function myinfo() {

        $wid = $_GET['id'];
        $usergift = M('user_gift')->where(array('id'=>$wid,'userid'=>$this->user['id'],'status'=>0))->field('gift')->find();

        if($usergift['gift']) {
            $this->assign('wid', $wid);
            $this->assign('jiang', $usergift['gift']);
            $this->display('Wx_myinfo');
        }else{
            $this->display('Wx_index');
        }
    }

    //活动规则
    public function rules() {

        $this->display('Wx_rules');
    }

    //奖品设置
    public function prizes() {

        $this->display('Wx_prizes');
    }

    //参与
    public function participation() {

        $this->display('Wx_participation');
    }

    //上传图片
    public function uploadpic() {

        $this->display('Wx_uploadpic');
    }

    //素材合成
    public function compound() {

        $this->display('Wx_compound');
    }

}