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

class PcImageController extends PcBaseController {


    public function __construct() {
        parent::__construct();
    }

    public function index(){

    }

    //如果上传的文件不为空,跳转到_upload方法
    public function upload(){

        //如果不为空
        if(!empty($_FILES))
        {
            $this->_upload();
        }

    }

    /***
     * 实现图片上传
     */
    public function _upload()
    {

        //宽：900px   高：600px

        $upload = new \Think\Upload();                                              // 实例化上传类
        $upload->maxSize = 3145728;                                                 // 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');                         // 设置附件上传类型
        $upload->savePath = '/TyRyBottleInChina/';                                  // 设置附件上传目录
        $upload->subName = date('Y-m-d').'/'.$this->user['id'];                                      //设置子目录

        $size = getimagesize($_FILES['photo']['tmp_name']);                         //获取图片的尺寸
        // 上传文件
        $info = $upload->uploadOne($_FILES['photo']);
        $img = './Uploads'.$info['savepath'].$info['savename'];


        if (!$info) {// 上传错误提示错误信息
            $this->error($upload->getErrorMsg());
        } else {
            $image = new \Think\Image();
            $image->open($img);

            $add['userid'] = $this->user['id'];
            $add['imgname'] = $info['name'];
            $add['imgtype'] = $info['type'];

            $add['url'] = $info['savepath'].$info['savename'];
            $add['addtime'] = date('Y-m-d H:i:s');
            $add['ip'] = get_client_ip(0, true);


            $insertid = M('upload')->add($add);
            $tmpimg = 'Uploads'.$info['savepath'].$insertid.'tmp.'.$info['ext'];
            $left = 'Uploads'.$info['savepath'].$insertid.'leftiimg.'.$info['ext'];
            $right = 'Uploads'.$info['savepath'].$insertid.'rightimg.'.$info['ext'];
            $centre = 'Uploads'.$info['savepath'].$insertid.'centreimg.'.$info['ext'];

            $image->thumb(900,600,\Think\Image::IMAGE_THUMB_FIXED)->save($img);
            $image->crop(900,600)->save($tmpimg);
            $image->open($img);
            $image->crop(300,600)->save($left);
            $image->open($img);
            $image->crop(300,600,300,0)->save($centre);
            $image->open($img);
            $image->crop(300,600,600,0)->save($right);

            if ($insertid !== false) {

                $this->assign('url', $tmpimg);
                $this->assign('centre', $centre);
                $this->assign('left', $left);
                $this->assign('right', $right);
                $this->display('Pc_uploadpic');
            } else {
                $this->display('Pc_uploadpic');

            }


        }
    }

}
