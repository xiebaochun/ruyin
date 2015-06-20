<?php
/**
 * Created by PhpStorm.
 * User: handou
 * Date: 2015/4/26
 * Time: 14:25
 */
namespace TyRyBottleInChina\Classes;

class Lottery {

    private $card100 = 9900;
    private $card50 = 9800;
    private $ruyin1 = 9000;
    private $ruyin2 = 8000;
    private $ruyin3 = 7500;
    private $ruyin4 = 6000;
    private $canyu1 = 3500;
    private $canyu2 = 2000;
    //转盘抽奖
    public function Turnlottery($userid,$wid) {

        $max = 10000;
        $gift = $this->get_rand($max);


        //获取客户端ip
        $ip = get_client_ip(0, true);

        //库存验证
        if($gift > 0){
            $db = M('gift');
            //开始事务
            $db->startTrans();
            $prizenum = $db->lock(true)->where(array('id'=>$gift))->field('num')->find();
            if ($prizenum['num'] > 0) {
                $db->where(array('id'=>$gift))->setDec('num',1);
            } else {
                $gift = 0;
            }
            //提交事务
            $db->commit();
        }
        //记录抽奖日志

        M('user_gift_log')->add(array('userid'=>$userid,'gift'=>$gift,'ip'=>$ip,'type'=>2));

        if($gift > 0){

            $code = getRandChar(20);                                   //获取验证码
           
            $id = M('user_gift')->add(array('addtime'=>date('Y-m-d H:i:s'),'userid'=>$userid,'gift'=>$gift,'code'=>$code));
            M('user')->where(array('id'=>$userid))->save(array('turngift'=>','.$gift));
        }
        M('user_chou_log')->add(array('vid'=>$wid,'addtime'=>date('Y-m-d H:i:s'),'userid'=>$userid,'gift'=>$gift,'ip'=>$ip));
        M('vote_log')->where(array('userid'=>$userid,'wid'=>$wid))->save(array('status'=>1));
        $giftinfo['gift'] = $gift;
        $giftinfo['id'] = $id;
        $giftinfo['code'] = $code;

        return $giftinfo;
    }


    private function get_rand($max){

        $lottery = mt_rand(1, $max);

        switch($lottery){

            case $lottery >= $this->card100;   //充值卡100
                $gift = 1;
                break;

            case $lottery >= $this->card50;  //充值卡50
                $gift = 2;
                break;

            case $lottery >= $this->ruyin1;  //如饮1
                $gift = 3;
                break;

            case $lottery >= $this->ruyin2;  //如饮2
                $gift = 4;
                break;

            case $lottery >= $this->ruyin3;  //如饮3
                $gift = 5;
                break;

            case $lottery >= $this->ruyin4;  //如饮4
                $gift = 6;
                break;

            case $lottery >= $this->canyu1;  //参与1
                $gift = 0;
                break;

            case $lottery >= $this->canyu2;  //参与2
                $gift = 0;
                break;

            default:
                $gift = 0;
        }

        return $gift;
    }

    private function checkip($ip){

        $ip = M('gift_ip')->where(array('ip'=>$ip))->field('id')->find();
        if($ip){
            return true;
        }
        return false;
    }



}