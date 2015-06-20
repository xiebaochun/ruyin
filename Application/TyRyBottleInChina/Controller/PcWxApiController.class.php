<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/13
 * Time: 12:31
 */
namespace TyRyBottleInChina\Controller;
use Think\Controller;

class PcWxApiController extends Controller {

    private $url;
    private $wechat,$callback;

    public function __construct() {

        parent::__construct();
        $this->url = SITE_PROTOCOL.SITE_URL.'/'.MODULE_NAME.'/PcWxApi/scanLogin';
        $this->callback = SITE_PROTOCOL.SITE_URL.'/'.MODULE_NAME.'/PcWxApi/getOpenidnew';
        $this->wechat = new \Org\Sinre\TPWechat(C('wechat'));
    }

    //微信登录二维码
    public function qrcode() {
		
        $code = I('get.code');
        if($code){

            $qrurl = $this->url.'/code/'.$code;
            import("Org.Sinre.Qrcode");
            $errorCorrectionLevel = 'M';
            $matrixPointSize = 4;
            \QRcode::png($qrurl, false, $errorCorrectionLevel, $matrixPointSize);
            exit;
        }
    }

    //扫码登录
    public function scanLogin() {

        $code = I('get.code');

        //已登录
        if(session('user') && $code){

            $user = session('user');
            M('scanlogin_code')->add(array('userid'=>$user['id'],'scancode'=>$code));
            $this->assign('flag',1);
            $this->display('Pc_scanLogin');
        //未登录
        }else{
            if($code){

                session('auth_login_code', $code);
                //授权
                //$oauthurl = $this->wechat->getOauthRedirect($this->callback,'1','snsapi_base');

                $oauthurl = 'http://game.sinreweb.com/Oauth/Oauth/authorize_userinfo?url='.$this->callback;
                redirect($oauthurl);
            }
        }
    }

    //第三方获取用户信息
    public function getOpenidnew() {

        $sign = I('get.sign');
        if($sign){
            $Des = new \Org\Sinre\Crypt3Des('0E25CD08D6AB320B7FCCC0F42E6CBD12', 'ECB', 'off');
            $sign = $Des->decrypt($sign, 'hex');
            //解密数据
            if($sign){
                $userinfo = json_decode($sign, true);
                if($userinfo){

                    $userdb = M('user');
                    $userdb->startTrans();
                    $user = $userdb->where(array('openid'=>$userinfo['openid']))->field('id,openid,base64name,headimgurl')->find();
                    if($user) {

                        $userdb->where(array('id'=>$user['id']))->save(array('lastdate'=>date('Y-m-d H:i:s', SYS_TIME),'lastip'=>get_client_ip(0, true)));
                        $userdb->commit();
                    } else {

                        $useradd = array();
                        $user['nickname'] = $userinfo['nickname'];
                        $user['base64name'] = base64_encode($userinfo['nickname']);
                        $user['headimgurl'] = $userinfo['headimgurl'];
                        $user['openid'] = $userinfo['openid'];
                        $user['regdate'] = date('Y-m-d H:i:s', SYS_TIME);
                        $user['regip'] = get_client_ip(0, true);
                        $user['id'] = $userdb->add($user);
                        $userdb->commit();

                        if($user['id']){
                            $useradd['id'] = $user['id'];
                            $useradd['from'] = 'pc_scan';
                            $useradd['useragent'] = $_SERVER['HTTP_USER_AGENT'];
                            M('user_info')->add($useradd);
                        }
                    }

                    if($user['id'] && session('auth_login_code')){

                        //记录scanlogin_code表
                        M('scanlogin_code')->add(array('userid'=>$user['id'],'scancode'=>session('auth_login_code')?session('auth_login_code'):''));
                        $this->assign('flag',1);
                    } else {
                        $this->assign('flag',-1);
                    }

                    $this->display('Pc_scanLogin');
                    exit();
                }
            }
        }
        $oauthurl = 'http://game.sinreweb.com/Oauth/Oauth/authorize_userinfo?url='.$this->callback;
        redirect($oauthurl);
    }

    //监听登录
    public function listenlogin() {
    	
        $code = I('get.code');
        $ret['status'] = 1;
        if($code){
            $scaninfo = M('scanlogin_code')->where(array('scancode'=>$code))->field('id,userid')->order('id DESC')->find();
            if($scaninfo){

                $user = M('user')->where(array('id'=>$scaninfo['userid']))->field('id,openid,base64name,headimgurl')->find();
                if($user){

                    //记录日志
                    M('scanlogin_code')->where(array('id'=>$scaninfo['id']))->delete();
                    M('scanlogin_log')->add(array('userid'=>$user['id'],'scancode'=>$code,'ip'=>get_client_ip(0, true)));

                    session('user',array('id'=>$user['id'],'openid'=>$user['openid'],'nickname'=>base64_decode($user['base64name']),'headimgurl'=>$user['headimgurl']));
                    $ret['status'] = 0;
                    $ret['nickname'] = base64_decode($user['base64name']);
                    $ret['headimgurl'] = $user['headimgurl'];
                }
            }
        }

        $this->ajaxReturn($ret);
    }

    //拉取openid
    public function getOpenid() {

        $access_token = $this->wechat->getOauthAccessToken();

        if ($access_token['openid']){

            $access_token['state'] = I('get.state');

            $userid = $this->saveuserinfo($access_token);
            if($userid && session('auth_login_code')){

                //记录scanlogin_code表
                M('scanlogin_code')->add(array('userid'=>$userid,'scancode'=>session('auth_login_code')?session('auth_login_code'):''));
                $this->assign('flag',1);
            } else {
                $this->assign('flag',-1);
            }

            $this->display('Pc_scanLogin');
        } else {
            $oauthurl = $this->wechat->getOauthRedirect($this->callback,'1','snsapi_base');
            redirect($oauthurl);
        }
    }

    //保存用户信息
    private function saveuserinfo($access_token) {

        $userdb = M('user');
        $userdb->startTrans();
        $user = $userdb->where(array('openid'=>$access_token['openid']))->field('id,openid,base64name,headimgurl')->find();
        if($user) {
            $userdb->where(array('id'=>$user['id']))->save(array('lastdate'=>date('Y-m-d H:i:s', SYS_TIME),'lastip'=>get_client_ip(0, true)));
            $userdb->commit();
        } else {
            $useradd = array();
            //不授权拉取
            if ($access_token['state']==1){
                //拉取用户信息
                $userinfo = $this->wechat->getUserInfo($access_token['openid']);
                if($userinfo['subscribe']==1){
                    $user['subscribe'] = 1;
                } else {
                    $oauthurl = $this->wechat->getOauthRedirect($this->callback,'2','snsapi_userinfo');
                    redirect($oauthurl);
                }
                //授权拉取
            } else if ($access_token['state']==2){
                $userinfo = $this->wechat->getOauthUserinfo($access_token['access_token'],$access_token['openid']);
                if ($userinfo['openid']){
                    $user['subscribe'] = 0;
                } else {
                    $oauthurl = $this->wechat->getOauthRedirect($this->callback,'2','snsapi_userinfo');
                    redirect($oauthurl);
                }
                //状态不存在，获取用户信息
            } else {
                $oauthurl = $this->wechat->getOauthRedirect($this->callback,'1','snsapi_base');
                redirect($oauthurl);
            }

            $user['nickname'] = $userinfo['nickname'];
            $user['base64name'] = base64_encode($userinfo['nickname']);
            $user['headimgurl'] = $userinfo['headimgurl'];
            $user['openid'] = $access_token['openid'];
            $user['regdate'] = date('Y-m-d H:i:s', SYS_TIME);
            $user['regip'] = get_client_ip(0, true);
            $user['id'] = $userdb->add($user);
            $userdb->commit();

            if($user['id']){
                $useradd['id'] = $user['id'];
                $useradd['from'] = 'pc_scan';
                $useradd['useragent'] = $_SERVER['HTTP_USER_AGENT'];
                M('user_info')->add($useradd);
            }
        }

        return $user['id'];
    }

    private function ajaxret($data) {

        $callback = I('get.callback','','trim');
        exit($callback."(".json_encode($data).")");
    }
}