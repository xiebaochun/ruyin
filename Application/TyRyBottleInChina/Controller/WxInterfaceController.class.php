<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/13
 * Time: 11:27
 */

namespace TyRyBottleInChina\Controller;
use Think\Controller;

class WxInterfaceController extends WxBaseController {

    public function __construct() {

        parent::__construct();
    }

    //投票
    public function votework(){

        $ajaxret = array();
        $ajaxret['err'] = 1;
        $callback = trim(I('get.callback'));
        $wid = trim(I('get.wid'));

        $userarr = M('user')->where(array('id'=>$this->user['id']))->field('votenum')->find();

        if(!$userarr){
            $ajaxret['message'] = '用户信息出错';
            exit($callback."(".json_encode($ajaxret).")");
        }else{
            if($userarr['votenum']){
                $votes = explode(',',$userarr['votenum']);

                if($votes[0] >= 10 && ($votes[1] <= date('Y-m-d 23:59:59') && $votes[1] >=date('Y-m-d 00:00:00'))){
                    $ajaxret['message'] = '你的投票次数已达上限';
                    exit($callback."(".json_encode($ajaxret).")");
                }
            }else{
                $votes = array(0,date('Y-m-d H:i:s'));
            }
        }

        $work = M('work')->where(array('id'=>$wid))->field('id,poll,votestr,userid')->find();

        if(empty($work)){
            $ajaxret['message'] = '没有这个作品';
            exit($callback."(".json_encode($ajaxret).")");
        }

        if($work['userid'] == $this->user['id']){
            $ajaxret['message'] = '不能给自己投票';
            exit($callback."(".json_encode($ajaxret).")");
        }

        if($work['votestr']){
            $votesArr = explode(',',$work['votestr']);
            if(in_array($this->user['id'],$votesArr)){
                $ajaxret['message'] = '你已经投过票了';
                exit($callback."(".json_encode($ajaxret).")");
            }
        }
        M('work')->where(array('id'=>$wid))->save(array('poll'=>$work['poll']+1,'votestr'=>$work['votestr'].','.$this->user['id']));

        M('vote_log')->add(array('userid'=>$this->user['id'],'wid'=>$wid,'status'=>0,'addtime'=>date('Y-m-d H:i:s')));

        if($votes[1]>date('Y-m-d 23:59:59') || $votes[1] <date('Y-m-d 00:00:00')) {
            $votes[0] = 1;
            $votes[1] = date('Y-m-d H:i:s');
        }else{
            $votes[0] = $votes[0] + 1;
        }

        $newvote = implode(',',$votes);

        M('user')->where(array('id'=>$this->user['id']))->save(array('votenum'=>$newvote));

        $ajaxret['err'] = 0;
        $random = rand(1,100);
        $count = M('vote_log')->where(array('userid'=>$this->user['id']))->count();
        if($count == 1 || $count == 8){
            $random = rand(1,50);
        }
        if($random <=10) {
            $where['userid'] = $this->user['id'];
            $count = M('user_chou_log')->where($where)->count();
            if($count < 3){
                $ajaxret['chou'] = 1;
            }
        }

        $ajaxret['piao'] = $work['poll']+1;

        exit($callback."(".json_encode($ajaxret).")");

    }

    //创建作品
    public function creatework(){

        $ajaxret = array();
        $ajaxret['err'] = 1;
        $callback = trim(I('get.callback'));
        $adate['userid'] = $this->user['id'];
        $adate['username'] = $this->user['username'];
        $adate['type'] = I('get.type');
        $adate['type'] = I('get.type');
        $adate['leftimg'] = I('get.leftimg');
        $adate['rightimg'] = I('get.rightimg');
        $adate['centreimg'] = I('get.centreimg');
        $adate['img'] = I('get.img');
        $adate['subjoin'] = $_GET['subjoin'];
        $adate['workname'] = I('get.workname');
        $adate['ip'] = get_client_ip(0,true);
        $adate['addtime'] = date('Y-m-d H:i:s');

        if(strlen($adate['workname'])>5){
            $this->data['message'] = '标题不能长于五个字！';
            exit($this->callback."(".json_encode($this->data).")");
        }

        $wid = M('work')->lock(true)->add($adate);

        if(empty($wid)){
            $ajaxret['message'] = '创建失败';
            exit($callback."(".json_encode($ajaxret).")");
        }else{
            $ajaxret['err'] = 0;
            exit($callback."(".json_encode($ajaxret).")");
        }

    }

}

