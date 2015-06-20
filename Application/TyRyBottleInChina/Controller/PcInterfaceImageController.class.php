<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/5/13
 * Time: 11:27
 */

namespace TyRyBottleInChina\Controller;

class PcInterfaceImageController extends PcBaseController {

    public $ping,$leng,$logo,$biglogo,$font,$fontfile,$baidi,$bigfont;

    public function __construct() {

        parent::__construct();

        if(!session('user') && ACTION_NAME!='filter'){
            $this->ajaxReturn(array('err'=>1, 'msg'=>'请先登录'));
        }

        $this->ping = './Public/TyRyBottleInChina/sc/ping.png';
        $this->leng = './Public/TyRyBottleInChina/sc/leng.png';
        $this->logo = './Public/TyRyBottleInChina/sc/logo.png';
        $this->biglogo = './Public/TyRyBottleInChina/sc/biglogo.png';
        $this->font = './Public/TyRyBottleInChina/sc/font.png';
        $this->fontfile = './Public/TyRyBottleInChina/sc/SIMSUN.TTC';
        $this->baidi = './Public/TyRyBottleInChina/sc/baidi.png';
        $this->bigfont = './Public/TyRyBottleInChina/sc/bigfont.png';
    }

    //针对IE上传图片处理
    public function uploadify() {

        //文件
        $upload = new \Think\Upload();

        $upload->maxSize = C('upload_maxsize'); //3M
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); //上传类型
        $upload->savePath = 'uploadswf/';
        $upload->rootPath = './Public/TyRyBottleInChina/';

        $info = $upload->upload(); //上传文件
        
        if(!$info){
            exit(json_encode(array('err'=>1, 'msg'=>$upload->getError())));
        }

        $filepath = $upload->rootPath.$info['Filedata']['savepath'].$info['Filedata']['savename'];

        list($img_width,$img_height,$img_type) = getimagesize($filepath);

        if($img_width < 900 || $img_height < 600){
            exit(json_encode(array('err'=>1, 'msg'=>'图片宽高不达标准，请选择大于900*600的图')));
        }

        $this->ajaxReturn(array('err'=>0, 'src'=>substr($filepath,1), 'width'=>$img_width, 'height'=>$img_height));

    }

    //预览
    public function preview() {

        if(IS_POST) {

            $base64_img = I('post.base');
            $previewtype = I('post.type', 1);

            //base64上传
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $imgs)) {

                $type = $imgs[2];
                $path = './Public/TyRyBottleInChina/preview/' . date('Y-m-d') . '/';
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $filename = md5(uniqid(rand(), true));
                $filepath = $path . $filename . '.' . $type;
                $size = strlen(base64_decode(str_replace($imgs[1], '', $base64_img))); 
                if($size > C('upload_maxsize')){
                    exit(json_encode(array('err' => 1,'msg'=>'图片不可大于3M')));
                }
                if (!file_put_contents($filepath, base64_decode(str_replace($imgs[1], '', $base64_img)))) {
                    exit(json_encode(array('err' => 1,'msg'=>'异常001')));
                }

            //swf控件上传
            } else if(strpos($base64_img, 'Public/TyRyBottleInChina')){

                $filepath = '.'.$base64_img;
                $filename = basename($filepath,strstr(substr($filepath,1),'.'));
                $type = substr(strstr($base64_img,'.'),1);
                if(!file_exists($filepath)){
                    exit(json_encode(array('err' => 1,'msg'=>'异常001')));
                }
            //不存在
            } else {

                exit(json_encode(array('err' => 1,'msg'=>'异常001')));
            }

            $param = array();
            if($previewtype==2){
                $location = explode(',', I('post.num')); //位置
                $param['location'] = array('x'=>$location[0]?abs($location[0]):0,'y'=>$location[1]?abs($location[1]):0);
                $param['scale'] = I('post.scale');
            }
            //生成图片
            $imgurl = $this->makepictures($previewtype, $filepath, $filename, $type, 1, $param);

            $add['from'] = 1;
            if(is_mobile_request())$add['from'] = 2;
            $add['userid'] = $this->user['id'];
            $add['centerurl'] = substr($imgurl['center'], 1);
            $add['type'] = $previewtype;

            $add['url'] = substr($imgurl['imgurl'],1);
            $add['addtime'] = date('Y-m-d H:i:s');
            $add['ip'] = get_client_ip(0, true);

            M('preview')->add($add);
			
            exit(json_encode(array('err' => 0, 'img' => substr($imgurl['center'], 1), 'bigimg'=>substr($imgurl['imgurl'], 1))));

        }
        exit(json_encode(array('err' => 1,'msg'=>'异常001')));
    }

    //上传
    public function upload() {

        if(IS_POST) {

            $base64_img = I('post.base');
            $uploadtype = I('post.type');
            $title = I('post.title');

            //base64上传
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $imgs)) {

                $type = $imgs[2];
                $path = './Public/TyRyBottleInChina/upload/' . date('Y-m-d') . '/';
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $filename = md5(uniqid(rand(), true));
                $filepath = $path . $filename . '.' . $type;
            	$size = strlen(base64_decode(str_replace($imgs[1], '', $base64_img))); 
                if($size > C('upload_maxsize')){
                    exit(json_encode(array('err' => 1,'msg'=>'图片不可大于3M')));
                }
                if (!file_put_contents($filepath, base64_decode(str_replace($imgs[1], '', $base64_img)))) {
                    exit(json_encode(array('err' => 1,'msg'=>'异常001')));
                }
            //swf控件上传
            } else if (strpos($base64_img, 'Public/TyRyBottleInChina')){

                $filepath = '.'.$base64_img;
                $filename = basename($filepath,strstr(substr($filepath,1),'.'));
                $type = substr(strstr($base64_img,'.'),1);

                if(!file_exists($filepath)){
                    exit(json_encode(array('err' => 1,'msg'=>'异常001')));
                }
            //不存在
            } else {

                exit(json_encode(array('err' => 1,'msg'=>'异常001')));
            }

            $param = array();
            if($uploadtype==2){
                $location = explode(',',I('post.num'));
                $param['location'] = array('x'=>$location[0]?abs($location[0]):0,'y'=>$location[1]?abs($location[1]):0);
                $param['scale'] = I('post.scale');
            }

            //生成图片
            $imgurlarr = $this->makepictures($uploadtype, $filepath, $filename, $type, 0, $param);

            $add['from'] = 1;
            if(is_mobile_request())$add['from'] = 2;
            $add['userid'] = $this->user['id'];
            $add['type'] = $uploadtype;
            $add['username'] = $this->user['nickname'];
            $add['workname'] = $title;
            $add['leftimg'] =  substr($imgurlarr['left'],1);
            $add['rightimg'] = substr($imgurlarr['right'],1);
            $add['centerimg'] = substr($imgurlarr['center'],1);
            $add['img'] = substr($imgurlarr['img'],1);
            if($uploadtype == 2) {$add['subjoin'] = I('post.subjoin');}
            $add['addtime'] = date('Y-m-d H:i:s');
            $add['ip'] = get_client_ip(0, true);

            $insertid = M('work')->add($add);

            //记录

            $this->redirect('Pc/work',array('id'=>$insertid));
        }
        exit(json_encode(array('err' => 1,'msg'=>'异常003')));
    }

    //滤镜
    public function filter() {

        if(IS_POST) {

            $base64_img = I('post.base');
            $filter = I('post.filter');

            if(!in_array($filter, array('source','TiltShift','Lomo','Gotham','Kelvin','Toaster','Nashville'))){
                exit(json_encode(array('err' => 1, 'msg' => '异常f001')));
            }

            //base64上传
            if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_img, $imgs)) {

                $type = $imgs[2];
                $path = './Public/TyRyBottleInChina/upload/' . date('Y-m-d') . '/';
                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }
                $filename = md5(uniqid(rand(), true));
                $filepath = $path . $filename . '.' . $type;
            	$size = strlen(base64_decode(str_replace($imgs[1], '', $base64_img))); 
                if($size > C('upload_maxsize')){
                    exit(json_encode(array('err' => 1,'msg'=>'图片不可大于3M')));
                }
                if (!file_put_contents($filepath, base64_decode(str_replace($imgs[1], '', $base64_img)))) {
                    exit(json_encode(array('err' => 1, 'msg' => '异常f002')));
                }

                //滤镜
                $filepath = $this->instagram($filepath, $filter);

                //swf控件上传
            } else if (strpos($base64_img, 'Public/TyRyBottleInChina')) {

                $filepath = '.' . $base64_img;
                $filename = basename($filepath, strstr(substr($filepath, 1), '.'));
                if (!file_exists($filepath)) {
                    exit(json_encode(array('err' => 1, 'msg' => '异常f003')));
                }

                //滤镜
                $filepath = $this->instagram($filepath, $filter);


                //不存在
            } else {

                exit(json_encode(array('err' => 1, 'msg' => '异常f004')));
            }

            exit(json_encode(array('err' => 0, 'img' => substr($filepath, 1))));
        }
    }

    //合成图片
    private function makepictures($patticipationtype ,$filepath, $name, $type, $ispreview, $param=array()) {

        if(file_exists($filepath)){

            if($patticipationtype==1 || $patticipationtype==3){

            }

            $image = new \Think\Image();
            //预览
            if($ispreview){

                $path = './Public/TyRyBottleInChina/preview/'.date('Y-m-d').'/crop/';
                if(!is_dir($path)){
                    mkdir($path, 0777, true);
                }
                $cropimage =  $path.$this->user['id'].$name.'_crop.'.$type;
                $center = $path.'/'.$this->user['id'].$name.'_center.'.$type;

                //上传图片-处理
                if($patticipationtype==2){

                    $filepath_crop = '.'.strstr(substr($filepath,1),'.',true).'_crop'.strstr(substr($filepath,1),'.');
                    $image->open($filepath)->thumb($param['scale']/100*$image->width(), $param['scale']/100*$image->height())->save($filepath_crop,$type,100,true);

                    $image->open($filepath_crop);
                    $width = $image->width()-$param['location']['x'] > 900 ? 900 : $image->width()-$param['location']['x'];
                    $height = $image->height()-$param['location']['y'] > 600 ? 600 : $image->height()-$param['location']['y'];
                                                        
                    $image->crop($width, $height, $param['location']['x'], $param['location']['y'])->save($filepath_crop,$type,100,true);
                    $image->open($this->baidi)->water($filepath_crop,array(0,0),100)->save($filepath_crop,$type,100,true);
                    $filepath = $filepath_crop;
                }

                //中间图片
                $image->open($filepath)->crop(208, 600, 346, 0)->save($cropimage,$type,100,true);
                $image->open($this->ping)->water($cropimage,array(0,80),100)->save($center,'png',100,true);           
                $image->open($center)->water($this->ping,array(0,0),100)->save($center,'png',100,true);
                $image->open($center)->water($this->logo,array(0,0),100)->save($center,'png',100,true);
                $image->open($center)->water($this->font,array(0,0),100)->save($center,'png',100,true);               
                $image->open($center)->water($this->leng,array(0,0),100)->save($center,'png',100,true);
        
                $this->pictransparent($center);
                
            	//写上昵称
                $arr[0] = msubstr($this->user['nickname'],0,1);
                $arr[1] = msubstr($this->user['nickname'],1,1);
                $arr[2] = msubstr($this->user['nickname'],2,1);
                $arr[3] = msubstr($this->user['nickname'],3,1);
                
                $flag = 0;
                if($arr[0] && $arr[1] && $arr[2] && $arr[3]){
                	$flag = 4;
                	$x = 145; $y= 378;
                } else if($arr[0] && $arr[1] && $arr[2]){
                	$flag = 3;
                	$x = 145; $y= 383;
                } else if($arr[0] && $arr[1]){
                	$flag = 2;
                	$x = 145; $y= 388;
                } else if($arr[0]){
                	$flag = 1;
                	$x = 145; $y= 393;
                }
              	
                if($flag > 0){
                	for ($i=0;$i<4;$i++){
                		$image->open($center)->text($arr[$i],$this->fontfile,eregi('[^\x00-\x7F]', $arr[$i]) ? 10:12,'#FFFFFF',array(eregi('[^\x00-\x7F]', $arr[$i]) ? $x:$x+2, $y),0,0)->save($center,$type,100,true);
                		$y+=14;
                	}                	
                }
                              
                //大图
                $image->open($filepath)->water($this->biglogo,array(0,0),100)->save($filepath,'png',100,true);
                $image->open($filepath)->water($this->bigfont,array(0,0),100)->save($filepath,'png',100,true);  
                
            	//写上昵称
                $arr[0] = msubstr($this->user['nickname'],0,1);
                $arr[1] = msubstr($this->user['nickname'],1,1);
                $arr[2] = msubstr($this->user['nickname'],2,1);
                $arr[3] = msubstr($this->user['nickname'],3,1);
                
                $flag = 0;
                if($arr[0] && $arr[1] && $arr[2] && $arr[3]){
                	$flag = 4;
                	$x = 495; $y= 305;
                } else if($arr[0] && $arr[1] && $arr[2]){
                	$flag = 3;
                	$x = 495; $y= 310;
                } else if($arr[0] && $arr[1]){
                	$flag = 2;
                	$x = 495; $y= 315;
                } else if($arr[0]){
                	$flag = 1;
                	$x = 495; $y= 320;
                }
              	
                if($flag > 0){
                	for ($i=0;$i<4;$i++){
                		$image->open($filepath)->text($arr[$i],$this->fontfile,eregi('[^\x00-\x7F]', $arr[$i]) ? 10:12,'#FFFFFF',array(eregi('[^\x00-\x7F]', $arr[$i]) ? $x:$x+2, $y),0,0)->save($filepath,$type,100,true);
                		$y+=14;
                	}                	
                }

                return array('center'=>$center,'imgurl'=>$filepath);
            //生成
            } else {

                $path = './Public/TyRyBottleInChina/create/'.date('Y-m-d');
                if(!is_dir($path)){
                    mkdir($path.'/crop/', 0777, true);
                    mkdir($path.'/center/', 0777, true);
                    mkdir($path.'/left/', 0777, true);
                    mkdir($path.'/right/', 0777, true);
                }
                $cropimage =  $path.'/crop/'.$name.'_crop.'.$type;

                //上传图片-处理
                if($patticipationtype==2){

                    $image->open($filepath)->thumb($param['scale']/100*$image->width(), $param['scale']/100*$image->height())->save($filepath,$type,100,true);
                    
                    $image->open($filepath);
                    $width = $image->width()-$param['location']['x'] > 900 ? 900 : $image->width()-$param['location']['x'];
                    $height = $image->height()-$param['location']['y'] > 600 ? 600 : $image->height()-$param['location']['y'];
                                                        
                    $image->crop($width, $height, $param['location']['x'], $param['location']['y'])->save($filepath,$type,100,true);
                    $image->open($this->baidi)->water($filepath,array(0,0),100)->save($filepath,$type,100,true);
                }

                //左侧
                $left = $path.'/left/'.$this->user['id'].$name.'_left.'.$type;
                $image->open($filepath)->crop(208, 600, 138, 0)->save($cropimage,$type,100,true);
                $image->open($this->ping)->water($cropimage,array(0,80),100)->save($left,'png',100,true);
                $image->open($left)->water($this->ping,array(0,0),100)->save($left,'png',100,true);
                $image->open($left)->water($this->leng,array(0,0),100)->save($left,'png',100,true);

                $this->pictransparent($left);

                //中间
                $center = $path.'/center/'.$this->user['id'].$name.'_center.'.$type;
                $image->open($filepath)->crop(208, 600, 346, 0)->save($cropimage,$type,100,true);
                $image->open($this->ping)->water($cropimage,array(0,80),100)->save($center,'png',100,true);
                $image->open($center)->water($this->ping,array(0,0),100)->save($center,'png',100,true);
                $image->open($center)->water($this->logo,array(0,0),100)->save($center,'png',100,true);
                $image->open($center)->water($this->font,array(0,0),100)->save($center,'png',100,true);
                $image->open($center)->water($this->leng,array(0,0),100)->save($center,'png',100,true);

                $this->pictransparent($center);
                
            	//写上昵称
                $arr[0] = msubstr($this->user['nickname'],0,1);
                $arr[1] = msubstr($this->user['nickname'],1,1);
                $arr[2] = msubstr($this->user['nickname'],2,1);
                $arr[3] = msubstr($this->user['nickname'],3,1);
                
                $flag = 0;
                if($arr[0] && $arr[1] && $arr[2] && $arr[3]){
                	$flag = 4;
                	$x = 145; $y= 378;
                } else if($arr[0] && $arr[1] && $arr[2]){
                	$flag = 3;
                	$x = 145; $y= 383;
                } else if($arr[0] && $arr[1]){
                	$flag = 2;
                	$x = 145; $y= 388;
                } else if($arr[0]){
                	$flag = 1;
                	$x = 145; $y= 393;
                }
                
                if($flag > 0){
                	for ($i=0;$i<4;$i++){
                		$image->open($center)->text($arr[$i],$this->fontfile,eregi('[^\x00-\x7F]', $arr[$i]) ? 10:12,'#FFFFFF',array(eregi('[^\x00-\x7F]', $arr[$i]) ? $x:$x+2, $y),0,0)->save($center,$type,100,true);
                		$y+=14;
                	}                	
                }
                
                //右侧
                $right = $path.'/right/'.$this->user['id'].$name.'_right.'.$type;
                $image->open($filepath)->crop(208, 600, 554, 0)->save($cropimage,$type,100,true);
                $image->open($this->ping)->water($cropimage,array(0,80),100)->save($right,'png',100,true);
                $image->open($right)->water($this->ping,array(0,0),100)->save($right,'png',100,true);
                $image->open($right)->water($this->leng,array(0,0),100)->save($right,'png',100,true);

                $this->pictransparent($right);

                //大图
                $image->open($filepath)->water($this->biglogo,array(0,0),100)->save($filepath,'png',100,true);
            	$image->open($filepath)->water($this->bigfont,array(0,0),100)->save($filepath,'png',100,true);  
                
            	//写上昵称
                $arr[0] = msubstr($this->user['nickname'],0,1);
                $arr[1] = msubstr($this->user['nickname'],1,1);
                $arr[2] = msubstr($this->user['nickname'],2,1);
                $arr[3] = msubstr($this->user['nickname'],3,1);
                
                $flag = 0;
                if($arr[0] && $arr[1] && $arr[2] && $arr[3]){
                	$flag = 4;
                	$x = 495; $y= 305;
                } else if($arr[0] && $arr[1] && $arr[2]){
                	$flag = 3;
                	$x = 495; $y= 310;
                } else if($arr[0] && $arr[1]){
                	$flag = 2;
                	$x = 495; $y= 315;
                } else if($arr[0]){
                	$flag = 1;
                	$x = 495; $y= 320;
                }
              	
                if($flag > 0){
                	for ($i=0;$i<4;$i++){
                		$image->open($filepath)->text($arr[$i],$this->fontfile,eregi('[^\x00-\x7F]', $arr[$i]) ? 10:12,'#FFFFFF',array(eregi('[^\x00-\x7F]', $arr[$i]) ? $x:$x+2, $y),0,0)->save($filepath,$type,100,true);
                		$y+=14;
                	}                	
                }

                return array('left'=>$left,'center'=>$center,'right'=>$right,'img'=>$filepath);
            }
        }
    }

    //处理为透明
    private function pictransparent($filepath) {

        list($src_w,$src_h,$src_type) = getimagesize($filepath);

        //创建透明画布
        $target_im = imagecreatetruecolor($src_w,$src_h);//新图
        $color=imagecolorallocate($target_im,255,255,255);
        imagecolortransparent($target_im,$color);
        imagefill($target_im,0,0,$color);

        //读取源文件
        $src_im = imagecreatefrompng($filepath);

        //变为透明
        imagecolortransparent($src_im, imagecolorallocate($target_im, 0, 255, 255));

        //合成图片
        //imagecopymerge($target_im,$src_im,0,0,0,0,$src_w,$src_h,100);

        imagepng($src_im, $filepath);
    }

    //滤镜效果
    //$filter Gotham  Toaster  Nashville  Lomo  Kelvin  Shift
    private function instagram($filepath, $filter){

        $path=strstr(substr($filepath,1),'.',true);
        $patharr = explode('_',$path);
        $filtername = '.'.$patharr[0].'_'.$filter.strstr(substr($filepath,1),'.');

        import("Org.Sinre.Instagraph");

        $filepath = '.'.$patharr[0].strstr(substr($filepath,1),'.');

        //原图返回
        if($filter=='source'){
            return $filepath;
        }

        //文件存在直接返回
        if(file_exists($filtername)){
            return $filtername;
        }

        $instagraph = new \Instagraph();
        $instagraph->setInput($filepath);
        $instagraph->setOutput($filtername);
        $instagraph->process($filter);

        return $filtername;
    }

}

