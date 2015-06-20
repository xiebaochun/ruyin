<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/4/26
 * Time: 13:22
 */
namespace TyRyBottleInChina\Controller;
use Think\Controller;
class PcTurntableController extends PcBaseController {

    public function __construct(){

        parent::__construct();
        if(!session('user')){
            $callback = trim(I('get.callback'));
            $error = "请先登录";
            exit($callback."(".json_encode($error).")");
        }
    }

    //抽奖
    public function turntlottery(){

        $ajaxret = array();
        $ajaxret['err'] = 1;
        $ajaxret['code'] = '';
        $callback = trim(I('get.callback'));
        $wid = trim(I('get.wid'));

        $vote = M('vote_log')->where(array('userid'=>$this->user['id'],'wid'=>$wid))->field('status')->find();
        //已抽奖
        if($vote['status'] == 1){
            $ajaxret['message'] = '您已经抽过奖了';
            exit($callback."(".json_encode($ajaxret).")");
        }

        if(empty($vote)){
            $ajaxret['message'] = '没有参与投票不允许抽奖';
            exit($callback."(".json_encode($ajaxret).")");
        }

        $where['userid'] = $this->user['id'];
        $count = M('user_chou_log')->where($where)->count();
        if($count >= 3){
            $ajaxret['message'] = '没有抽奖机会了';
            exit($callback."(".json_encode($ajaxret).")");
        }

        $lottery = new \TyRyBottleInChina\Classes\Lottery();
        $gift = $lottery->Turnlottery($this->user['id'],$wid);

        $ajaxret['err'] = 2;
        $ajaxret['gift'] = $gift['gift'];
        $ajaxret['id'] = $gift['id'];
        $ajaxret['code'] = $gift['code'];
        $rotate = 1080;
        $r_num=array_rand(array('67.5'=>'67.5','247.5'=>'247.5'));
        //转盘角度
        if($gift['gift']==0){
            $ajaxret['rotate'] = $rotate+$r_num;   //未中奖
            $ajaxret['err'] = 0;
        } elseif($gift['gift']==1){
            $ajaxret['rotate'] = $rotate+157.5;                             //100元充值卡
            $ajaxret['title'] = "恭喜您获得100元充值卡一张，请填写联系方式";
        } elseif($gift['gift']==2){
            $ajaxret['rotate'] = $rotate+337.5;                             //50元充值卡
            $ajaxret['title'] = "恭喜您获得50元充值卡一张，请填写联系方式";
        } elseif($gift['gift']==3){
            $ajaxret['rotate'] = $rotate+22.5;                              //如饮奖1
            $ajaxret['title'] = "恭喜您获得如饮奖1一份，请填写联系方式";
        } elseif($gift['gift']==4){
            $ajaxret['rotate'] = $rotate+112.5;                              //如饮奖2
            $ajaxret['title'] = "恭喜您获得如饮奖2一份，请填写联系方式";
        } elseif($gift['gift']==5){
            $ajaxret['rotate'] = $rotate+202.5;                              //如饮奖3
            $ajaxret['title'] = "恭喜您获得如饮奖3一份，请填写联系方式";
        }elseif($gift['gift']==6){
            $ajaxret['rotate'] = $rotate+292.5;                             //如饮奖4
            $ajaxret['title'] = "恭喜您获得如饮奖4一份，请填写联系方式";
        }

        exit($callback."(".json_encode($ajaxret).")");
    }
    //提交中奖信息
    public function phone() {

        $ajaxret = array();
        $ajaxret['err'] = 1;
        $callback = trim(I('get.callback'));
        $gid = trim($_GET['gid']);
        $tel = trim($_GET['tel']);
        $name = trim($_GET['name']);
        $address = trim($_GET['address']);

        //手机号
        if (isset($_GET['tel']) && $tel){
            if (!test_phone(I('get.tel'))) {
                $ajaxret['message'] = '请输入正确手机号！';
                exit($callback."(".json_encode($ajaxret).")");
            }
        }else{
            $ajaxret['message'] = '请填写手机号！';
            exit($callback."(".json_encode($ajaxret).")");
        }

        //姓名
        if (!isset($_GET['name']) || !$name){
            $ajaxret['message'] = '请填写姓名！';
            exit($callback."(".json_encode($ajaxret).")");
        }

        //地址
        if (!isset($_GET['address']) || !$address){
            $ajaxret['message'] = '请填写地址！';
            exit($callback."(".json_encode($ajaxret).")");
        }

        $data['phone'] = I('get.tel');
        $data['name'] = I('get.name');
        $data['address'] = I('get.address');
        $data['updatetime'] = date('Y-m-d H:i:s');
        $data['ip'] = get_client_ip(0, true);

        $statu =   M('user_gift')->where(array('userid'=>$this->user['id'],'id'=>$gid))->save($data);
        if($statu){
            $ajaxret['err'] = 0;
            exit($callback."(".json_encode($ajaxret).")");
        }else{
            $ajaxret['message'] = '信息错误！';
            exit($callback."(".json_encode($ajaxret).")");
        }


    }
}