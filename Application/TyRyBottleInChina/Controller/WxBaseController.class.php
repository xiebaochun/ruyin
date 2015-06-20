<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/11
 * Time: 16:28
 * Des: 移动端
 */
namespace TyRyBottleInChina\Controller;
use Think\Controller;

class WxBaseController extends Controller {

    public $user;
    public $wechat,$callback;

    public function __construct() {

        parent::__construct();

        if(!is_mobile_request()) $this->redirect( 'Pc/index', array('from' => I('get.from')));
        $this->user = session('wx_user');
        $this->wechat = new \Org\Sinre\TPWechat(C('wechat'));
        $this->callback = SITE_PROTOCOL.SITE_URL.'/'.MODULE_NAME.'/WxBase/getOpenidnew';
        $ip = get_client_ip(0, true);
//        if($ip=='223.223.198.211'){
        	$this->user = array('id'=>4,'nickname'=>'王远','openid'=>'ooIDjjnVihhMf4Tc-lPKPdP-0Roo','headimgurl'=>'http://wx.qlogo.cn/mmopen/EWo3hwIVSD253W1Knibiaib9eXiccK0LXmVhiaibLuBqcNp4Ju0YEPia6dtjweicCLmicWShzfScic7ZwcDBGtlcQG5jal1Q/0');
  //      }
        self::check_user();
        //$this->user = array('id'=>4,'nickname'=>'宇','openid'=>'oxUWZuEKQ3rqxXf2fcMsQbkGpGDo','headimgurl'=>'http://wx.qlogo.cn/mmopen/sLvzfiaFkjma7orpK2OxQicDUdWEFNHCcUkxkg2ohHSOqNJia318LdJW3nM2OtFblhBwVLt42NbWChyyC2CJBHfPA/0');
    }

    //验证用户
    public function check_user() {

        if (CONTROLLER_NAME=='WxBase' && in_array(ACTION_NAME, array('getOpenid','createuser','getopenid','getOpenidnew','getopenidnew'))){
            return true;
        }

        if(!$this->user){

            session('wx_from',I('get.from'));
            session('jumpurl',SITE_PROTOCOL.SITE_URL.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            //授权
            //$oauthurl = $this->wechat->getOauthRedirect($this->callback,'1','snsapi_base');

            $oauthurl = 'http://game.sinreweb.com/Oauth/Oauth/authorize_userinfo?url='.$this->callback;
            redirect($oauthurl);
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
                            $useradd['from'] = session('wx_from') ? session('wx_from') : 0;
                            $useradd['useragent'] = $_SERVER['HTTP_USER_AGENT'];
                            M('user_info')->add($useradd);
                        }
                    }
					session('wx_user',array('id'=>$user['id'],'openid'=>$user['openid'],'nickname'=>base64_decode($user['base64name']),'headimgurl'=>$user['headimgurl']));
                    redirect(session('jumpurl'));
                }
            }
        }
        $oauthurl = 'http://game.sinreweb.com/Oauth/Oauth/authorize_userinfo?url='.$this->callback;
        redirect($oauthurl);
    }

    //拉取openid
    public function getOpenid() {

        $access_token = $this->wechat->getOauthAccessToken();

        if ($access_token['openid']){
            $access_token['state'] = I('get.state');
            $this->saveuserinfo($access_token);
            redirect(session('jumpurl'));
        } else {
            $oauthurl = $this->wechat->getOauthRedirect($this->callback,'1','snsapi_base');
            redirect($oauthurl);
        }
    }

    //保存用户信息
    private function saveuserinfo($access_token) {

        $userdb = M('bottle_user');
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
                if (!$userinfo['openid']){
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
                $useradd['from'] = session('wx_from') ? session('wx_from') : 0;
                $useradd['useragent'] = $_SERVER['HTTP_USER_AGENT'];
                M('bottle_user_info')->add($useradd);
            }
        }
        session('wx_user',array('id'=>$user['id'],'openid'=>$user['openid'],'nickname'=>base64_decode($user['base64name']),'headimgurl'=>$user['headimgurl']));
    }
    public function createuser(){

        session('wx_user',array('id'=>1,'openid'=>'ooIDjjou55LkoXpnHuCxvVq-l2s4','nickname'=>base64_decode('6buR6Imy55qE6aOO'),'headimgurl'=>'http://wx.qlogo.cn/mmopen/EWo3hwIVSD0XvicB46aQCImdsjStlGGKjzsRHMQWCqFjHwlE8td3KAQLSFAV2Gp3pibfcw5N5ZsHVhZ8BmBibNyAsicUGdibw33qg/0'));
    }
}