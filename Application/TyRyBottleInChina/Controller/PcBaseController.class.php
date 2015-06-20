<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/11
 * Time: 16:27
 * Des: PC端
 */
namespace TyRyBottleInChina\Controller;
use Think\Controller;

class PcBaseController extends Controller {

    public $user;

    public function __construct() {

        parent::__construct();
        session('user',array('id'=>4,'nickname'=>'宇','openid'=>'oxUWZuEKQ3rqxXf2fcMsQbkGpGDo','headimgurl'=>'http://wx.qlogo.cn/mmopen/sLvzfiaFkjma7orpK2OxQicDUdWEFNHCcUkxkg2ohHSOqNJia318LdJW3nM2OtFblhBwVLt42NbWChyyC2CJBHfPA/0'));
        $this->user = array('id'=>4,'nickname'=>'宇','openid'=>'oxUWZuEKQ3rqxXf2fcMsQbkGpGDo','headimgurl'=>'http://wx.qlogo.cn/mmopen/sLvzfiaFkjma7orpK2OxQicDUdWEFNHCcUkxkg2ohHSOqNJia318LdJW3nM2OtFblhBwVLt42NbWChyyC2CJBHfPA/0');
        if(is_mobile_request()) {

            if(ACTION_NAME == 'workparticulars' ||  ACTION_NAME == 'work') {

                $url = $_SERVER['REQUEST_URI'];
                $str = str_replace('TyRyBottleInChina/Pc/', "TyRyBottleInChina/Wx/", $url);
                if ($str != $url) {
                    $this->redirect($str);
                } else {
                    $this->redirect('Wx/index', array('from' => I('get.from')));
                }
            }else {
                $this->redirect('Wx/index', array('from' => I('get.from')));
            }
            
        }
        $this->user = session('user');

    }



}
