<?php
/**
 * Created by PhpStorm.
 * User: wangmeng
 * Date: 2015/4/22
 * Time: 12:44
 */

/**
 * 验证来源
 */
function check_referer($refWhiteList) {

    if(isset($_SERVER['HTTP_REFERER'])){
        $ref = $_SERVER['HTTP_REFERER'];
        if(strpos( $ref, 'http://') !== 0 && strpos($ref , 'https://') !== 0 ){
            $ref = 'http://' . $ref;
        }
        foreach ($refWhiteList as $item ){
            if(preg_match( "/{$item}/i" , $ref) ){
                return true;
            }
        }
        return false;
    }
    return false;
}

/**
 * 判断是否微信访问
 */
function is_wechat() {

    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    return strpos($agent, 'micromessenger') ? true : false ;
}

/**
 * 验证手机号
 */
function test_phone($phone) {

    return preg_match('/^1[345789][0-9]{9}$/', $phone);
}
/**
 * 验证身份证
 */
function test_card($vStr) {

    $vCity = array(
        '11','12','13','14','15','21','22',
        '23','31','32','33','34','35','36',
        '37','41','42','43','44','45','46',
        '50','51','52','53','54','61','62',
        '63','64','65','71','81','82','91'
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;

    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
    $vLength = strlen($vStr);

    if ($vLength == 18)
    {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
    if ($vLength == 18)
    {
        $vSum = 0;

        for ($i = 17 ; $i >= 0 ; $i--)
        {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
        }

        if($vSum % 11 != 1) return false;
    }

    return true;
}

/**
 * 判断用户是否手机访问
 */
function is_mobile_request() {

    $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
    $mobile_browser = 0;

    if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) $mobile_browser++;

    if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false)) $mobile_browser++;

    if(isset($_SERVER['HTTP_X_WAP_PROFILE'])) $mobile_browser++;

    if(isset($_SERVER['HTTP_PROFILE'])) $mobile_browser++;

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
        'wapr','webc','winw','winw','xda','xda-'
    );
    if(in_array($mobile_ua, $mobile_agents)) $mobile_browser++;

    if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) $mobile_browser++;

    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false) $mobile_browser=0;

    if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) $mobile_browser++;

    if ($mobile_browser > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * 字符串加密、解密函数
 * @param	string	$txt		字符串
 * @param	string	$operation	ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
 * @param	string	$key		密钥：数字、字母、下划线
 * @param	string	$expiry		过期时间
 * @return	string
 */
function sinre_auth($string, $operation = 'ENCODE', $key = 'SIgdi1Xa2uyt&SD^!@', $expiry = 0) {
    $key_length = 4;
    $key = md5($key != '' ? $key : C('auth_key'));
    $fixedkey = md5($key);
    $egiskeys = md5(substr($fixedkey, 16, 16));
    $runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
    $keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
    $string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

    $i = 0; $result = '';
    $string_length = strlen($string);
    for ($i = 0; $i < $string_length; $i++){
        $result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
    }
    if($operation == 'ENCODE') {
        return $runtokey . str_replace('=', '', base64_encode($result));
    } else {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$egiskeys), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    }
}

/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string) {
    $string = str_replace('%20','',$string);    //空格
    $string = str_replace('%27','',$string);    //单引号
    $string = str_replace('%2527','',$string);  //单引号被 urlencode两次以后是 %2527
    $string = str_replace('*','',$string);      //
    $string = str_replace('"','&quot;',$string);//
    $string = str_replace("'",'',$string);      //
    $string = str_replace('"','',$string);      //
    $string = str_replace(';','',$string);      //
    $string = str_replace('<','&lt;',$string);  //
    $string = str_replace('>','&gt;',$string);  //
    $string = str_replace("{",'',$string);      //
    $string = str_replace('}','',$string);      //
    $string = str_replace('\\','',$string);     //
    return $string;
}

/**
 * 设置 cookie
 * @param string $var     变量名
 * @param string $value   变量值
 * @param int $time    过期时间
 */
function set_cookie($var, $value = '', $time = 0) {
    $time = $time > 0 ? SYS_TIME+$time : ($value == '' ? SYS_TIME - 3600 : 0);
    $s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
    $var = C('cookie_pre').$var;
    $_COOKIE[$var] = $value;
    if (is_array($value)) {
        foreach($value as $k=>$v) {
            setcookie($var.'['.$k.']', sinre_auth($v, 'ENCODE'), $time, C('cookie_path'), C('cookie_domain'), $s);
        }
    } else {
        setcookie($var, sinre_auth($value, 'ENCODE'), $time, C('cookie_path'), C('cookie_domain'), $s);
        //cookie($var,sinre_auth($value, 'ENCODE'),$time);
    }
}

/**
 * 获取通过 set_cookie 设置的 cookie 变量
 * @param string $var 变量名
 * @param string $default 默认值
 * @return mixed 成功则返回cookie 值，否则返回 false
 */
function get_cookie($var, $default = '') {
    $var = C('cookie_pre').$var;
    $value = isset($_COOKIE[$var]) ? sinre_auth($_COOKIE[$var], 'DECODE') : $default;
    //$value = sinre_auth(cookie($var), 'DECODE');
    if(in_array($var,array('_userid','siteid'))) {
        $value = intval($value);
    } elseif($var=='_usename') {
        $value = safe_replace($value);
    }
    return $value;
}

/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function new_addslashes($string) {
    if(!is_array($string)) return addslashes($string);
    foreach($string as $key => $val) $string[$key] = new_addslashes($val);
    return $string;
}

/**
 * 返回经stripslashes处理过得字符串和数组
 * @param $string 需要处理的字符串和组数
 * @return mixed
 */
function new_stripslashes($string) {
    if (!is_array($string)) return stripslashes($string);
    foreach ($string as $key => $val) $string[$key] = new_stripslashes($val);
    return $string;
}

/**
 * 获取请求ip
 *
 * @return ip地址
 */
function ip() {
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
}

/**
 * 产生随机字符串
 *
 * @param    int        $length  输出长度
 * @param    string     $chars   可选的 ，默认为 0123456789
 * @return   string     字符串
 */
function random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 判断模块是否安装
 * @param $m	模块名称
 */
function module_exists($m = '') {
    if ($m=='admin') return true;
    $modules = F('commons/modules');
    $modules = array_keys($modules);
    return in_array($m, $modules);
}

/**
 * 获取当前站点ID
 */
function get_siteid() {
    static $siteid;
    if (!empty($siteid)) return $siteid;
    if (defined('IN_ADMIN')) {
        if ($d = get_cookie('siteid')) {
            $siteid = $d;
        } else {
            return '';
        }
    } else {
        $data = F('commons/sitelist');
        if (!is_array($data)) return '1';
        $site_url = SITE_PROTOCOL.SITE_URL;
        foreach ($data as $v) {
            if ($v['url'] == $site_url.'/') $siteid = $v['siteid'];
        }
    }
    if (empty($siteid)) $siteid = 1;
    return $siteid;
}

/**
 * 获取站点信息
 * @param $siteid  站点ID
 */
function siteinfo($siteid) {
    static $sitelist;
    if (empty($sitelist)) $sitelist = F('commons/sitelist');
    return isset($sitelist[$siteid]) ? $sitelist[$siteid] : '';
}

/**
 * 将数组转换为字符串
 * @param array $data 数组
 * @param bool $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
 * @return string 返回字符串，如果，data为空，则返回空
 */
function array2string($data, $isformdata = 1) {
    if ($data == '') return '';
    if ($isformdata) $data = new_stripslashes($data);
    return var_export($data, true);
}

/**
 * 将字符串转换为数组
 *
 * @param	string	$data	字符串
 * @return	array	返回数组格式，如果，data为空，则返回空数组
 */
function string2array($data) {
    if($data == '') return array();
    eval("\$array = $data;");
    return $array;
}

/**
 * 返回经htmlspecialchars处理过的字符串或数组
 * @param $obj 需要处理的字符串或数组
 * @return mixed
 */
function new_html_special_chars($string) {
    $encoding = 'utf-8';
    if (strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
    if (!is_array($string)) return htmlspecialchars($string, ENT_QUOTES, $encoding);
    foreach ($string as $key => $val) $string[$key] = new_html_special_chars($val);
    return $string;
}

/**
 * 组装生成ID号
 * @param $modules 模块名
 * @param $contentid 内容ID
 * @param $siteid 站点ID
 */
function id_encode($modules,$contentid, $siteid) {
    return urlencode($modules.'-'.$contentid.'-'.$siteid);
}

/**
 * 解析ID
 * @param $id 评论ID
 */
function id_decode($id) {
    return explode('-', $id);
}

/**
 * 检查id是否存在于数组中
 *
 * @param $id
 * @param $ids
 * @param $s
 */
function check_in($id, $ids = '', $s = ',') {
    if(!$ids) return false;
    $ids = explode($s, $ids);
    return is_array($id) ? array_intersect($id, $ids) : in_array($id, $ids);
}

/**
 * IE浏览器判断
 */

function is_ie() {
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if((strpos($useragent, 'opera') !== false) || (strpos($useragent, 'konqueror') !== false)) return false;
    if(strpos($useragent, 'msie ') !== false) return true;
    return false;
}

/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function str_cut($string, $length, $dot = '...') {
    $strlen = strlen($string);
    if($strlen <= $length) return $string;
    $string = str_replace(array(' ','&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵',' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
    $strcut = '';
    if(strtolower(CHARSET) == 'utf-8') {
        $length = intval($length-strlen($dot)-$length/3);
        $n = $tn = $noc = 0;
        while($n < strlen($string)) {
            $t = ord($string[$n]);
            if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1; $n++; $noc++;
            } elseif(194 <= $t && $t <= 223) {
                $tn = 2; $n += 2; $noc += 2;
            } elseif(224 <= $t && $t <= 239) {
                $tn = 3; $n += 3; $noc += 2;
            } elseif(240 <= $t && $t <= 247) {
                $tn = 4; $n += 4; $noc += 2;
            } elseif(248 <= $t && $t <= 251) {
                $tn = 5; $n += 5; $noc += 2;
            } elseif($t == 252 || $t == 253) {
                $tn = 6; $n += 6; $noc += 2;
            } else {
                $n++;
            }
            if($noc >= $length) {
                break;
            }
        }
        if($noc > $length) {
            $n -= $tn;
        }
        $strcut = substr($string, 0, $n);
        $strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
    } else {
        $dotlen = strlen($dot);
        $maxi = $length - $dotlen - 1;
        $current_str = '';
        $search_arr = array('&',' ', '"', "'", '“', '”', '—', '<', '>', '·', '…','∵');
        $replace_arr = array('&amp;','&nbsp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;',' ');
        $search_flip = array_flip($search_arr);
        for ($i = 0; $i < $maxi; $i++) {
            $current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
            if (in_array($current_str, $search_arr)) {
                $key = $search_flip[$current_str];
                $current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
            }
            $strcut .= $current_str;
        }
    }
    return $strcut.$dot;
}

/**
 * 转义 javascript 代码标记
 *
 * @param $str
 * @return mixed
 */
 function trim_script($str) {
     if(is_array($str)){
         foreach ($str as $key => $val){
             $str[$key] = trim_script($val);
         }
     }else{
         $str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str );
         $str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str );
         $str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str );
         $str = str_replace ( 'javascript:', 'javascript：', $str );
     }
     return $str;
 }

function new_html_entity_decode($string) {
    $encoding = 'utf-8';
    if(strtolower(CHARSET)=='gbk') $encoding = 'ISO-8859-15';
    return html_entity_decode($string,ENT_QUOTES,$encoding);
}

/**
 * 生成上传附件验证
 * @param $args   参数
 * @param $operation   操作类型(加密解密)
 */
function upload_key($args) {
    $pc_auth_key = md5(C('auth_key').$_SERVER['HTTP_USER_AGENT']);
    $authkey = md5($args.$pc_auth_key);
    return $authkey;
}

function decode_commentid($commentid) {
    return explode('-', $commentid);
}

function remove_xss($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08\x0b-\x0c\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=@avascript:alert('XSS')>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

        // @ @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
        // @ @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;
}

/**
 * 设置 cookie
 * @param string $var     变量名
 * @param string $value   变量值
 * @param int $time    过期时间
 */
function set_cookies($var, $value = '', $time = 0) {
    $s = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
    $var = C('cookie_pre').$var;
    $_COOKIE[$var] = $value;
    if (is_array($value)) {
        foreach($value as $k=>$v) {
            cookie($var.'['.$k.']', sinre_auth($v, 'ENCODE'), array('expire'=>$time,'path'=>C('cookie_path'),'domain'=>C('cookie_domain')));
        }
    } else {
        cookie($var.'['.$k.']', sinre_auth($v, 'ENCODE'), array('expire'=>$time,'path'=>C('cookie_path'),'domain'=>C('cookie_domain')));
        //cookie($var,sinre_auth($value, 'ENCODE'),$time);
    }
}

/**
 * 获取通过 set_cookie 设置的 cookie 变量
 * @param string $var 变量名
 * @param string $default 默认值
 * @return mixed 成功则返回cookie 值，否则返回 false
 */
function get_cookies($var, $default = '') {
    $var = C('cookie_pre').$var;
    $value = isset($_COOKIE[$var]) ? sinre_auth($_COOKIE[$var], 'DECODE') : $default;
    //$value = sinre_auth(cookie($var), 'DECODE');
    if(in_array($var,array('_userid','siteid'))) {
        $value = intval($value);
    } elseif($var=='_usename') {
        $value = safe_replace($value);
    }
    return $value;
}

function mbStrSplit ($string, $len=1) {
    $start = 0;
    $strlen = mb_strlen($string);
    if($strlen < $len){
        return $string;
    }else {
        while ($strlen) {
            $array[] = mb_substr($string,$start,$len,"utf8");
            $string = mb_substr($string, $len, $strlen,"utf8");
            $strlen = mb_strlen($string);
        }
        return $array[0].'...';
    }

}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        return mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}

function tranTime($time) {
    $rtime = date("m-d H:i",$time);
    $htime = date("H:i",$time);
    $time = time() - $time;
    //dump($time);
    if ($time < 60)
    {
        $str = '刚刚';
    }
    elseif ($time < 60 * 60)
    {
        $min = floor($time/60);
        $str = $min.'分钟前';
    }
    elseif ($time < 60 * 60 * 24)
    {
        $h = floor($time/(60*60));
        $str = $h.'小时前 ';
    }
    elseif ($time < 60 * 60 * 24 * 3)
    {
        $d = floor($time/(60*60*24));
        if($d==1)
            $str = '昨天 '.$rtime;
        else
            $str = '前天 '.$rtime;
    }
    else
    {
        $str = '很久以前';
    }
    return $str;
}

/**
 * http_post 请求
 */
function http_post($url,$param) {

    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
    }
    if (is_string($param)) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key=>$val){
            $aPOST[] = $key."=".urlencode($val);
        }
        $strPOST =  join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($oCurl, CURLOPT_POST,true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}

/**
 * http_get 请求
 */
 function http_get($url) {

     $oCurl = curl_init();
     if(stripos($url,"https://")!==FALSE){
         curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
     }
     curl_setopt($oCurl, CURLOPT_URL, $url);
     curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
     $sContent = curl_exec($oCurl);
     $aStatus = curl_getinfo($oCurl);
     curl_close($oCurl);
     if(intval($aStatus["http_code"])==200){
         return $sContent;
     }else{
         return false;
     }
 }

	function images($field, $value, $fieldinfo) {
        /*
        extract($fieldinfo);
        $list_str = '';
        if($value) {
            $value = string2array(new_html_entity_decode($value));
            if(is_array($value)) {
                foreach($value as $_k=>$_v) {
                $list_str .= "<div id='image_{$field}_{$_k}' style='padding:1px'><input type='text' name='{$field}_url[]' value='{$_v[url]}' style='width:310px;' ondblclick='image_priview(this.value);' class='input-text'> <input type='text' name='{$field}_alt[]' value='{$_v[alt]}' style='width:160px;' class='input-text'> <a href=\"javascript:remove_div('image_{$field}_{$_k}')\">".L('remove_out', '', 'content')."</a></div>";
                }
            }
        } else {
            $list_str .= "<center><div class='onShow' id='nameTip'>".L('upload_pic_max', '', 'content')." <font color='red'>{$upload_number}</font> ".L('tips_pics', '', 'content')."</div></center>";
        }
        $string = '<input name="info['.$field.']" type="hidden" value="1">
        <fieldset class="blue pad-10">
        <legend>'.L('pic_list').'</legend>';
        $string .= $list_str;
        $string .= '<div id="'.$field.'" class="picList"></div>
        </fieldset>
        <div class="bk10"></div>
        ';
        if(!defined('IMAGES_INIT')) {
            $str = '<script type="text/javascript" src="statics/js/swfupload/swf2ckeditor.js"></script>';
            define('IMAGES_INIT', 1);
        }
        $authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
        $string .= $str."<div class='picBut cu'><a herf='javascript:void(0);' onclick=\"javascript:flashupload('{$field}_images', '".L('attachment_upload')."','{$field}',change_images,'{$upload_number},{$upload_allowext},{$isselectimage}','content','$this->catid','{$authkey}')\"/> ".L('select_pic')." </a></div>";
        return $string;
        */
        extract($fieldinfo);
        $list_str = '';
        if ($value) {
            $value = string2array(new_html_entity_decode($value));
            if(is_array($value)) {
                foreach($value as $_k=>$_v) {
                    $list_str .= "<div id='image_{$field}_{$_k}' style='padding:1px'><input type='text' name='{$field}_url[]' value='{$_v[url]}' style='width:310px;' class='input-text'> <input placeholder='请输入图片备注' type='text' name='{$field}_alt[]' value='{$_v[alt]}' style='width:260px;' class='input-text'> <input placeholder='请输入链接' type='text' name='{$field}_link[]' value='{$_v[link]}' style='width:260px;' class='input-text'> <a href=\"javascript:remove_div('image_{$field}_{$_k}')\">移除</a></div>";
                }
            }
        } else {
            $list_str .= "";
        }

        $str = '<script id="'.$field.'" type="text/plain"></script>';
        $str .= '<script>
				 var _'.$field.' = UE.getEditor("'.$field.'" ,{
				 	serverUrl :\'/Content/Content/ueditor.html\'
				});
				 _'.$field.'.ready(function () {
				 	 _'.$field.'.setDisabled();
				 	 _'.$field.'.hide();
				 	 _'.$field.'.addListener("beforeInsertImage", function (t, arg) {
           		 		var html = "<div id=pictureurls class=picList>";
						var random = 0;
						for(var i =0; i < arg.length; ++i){
							var item = arg[i];
							var alt = item.alt;
							var arr = new Array();
							arr = alt.split(\'.\');
    						//html += "<li id= image" + i + "><input class='."'txt'".' type='."'hidden'".' value="+ item.src + " name='.$field.'_url[]><img src=" + item.src + " width='."'80'".'></li>";
							random = getRandomNum();
							html += "<li id=image" + random + "><input class='."'txt'".' type='."'text'".' style=width:310px; value="+ item.src +" name='.$field.'_url[]> <input class=txt type=text style=width:260px; name='.$field.'_alt[] placeholder=请输入图片备注> <input class=txt type=text style=width:260px;  name='.$field.'_link[] placeholder=请输入图片链接> <a href=\"javascript:remove_div(\'image" + random +"\')\">移除</a></li> ";
						}
						html += "</div>";
						$("#'.$field.'").append(html);
       				});
				});

				//选择照片function
				function '.$field.'() {
					var '.$field.'_ = _'.$field.'.getDialog("insertimage");
					'.$field.'_.open();
				}
				//删除div
				function remove_div(id) {
					$("#"+id).remove();
				}

				//生成四位随机数
				function getRandomNum() {
					var retValue="";
					var num=4;
			 		for(var i=0;i<num;i++){
 			 			retValue += ""+parseInt(10*Math.random());
 					}
 					return retValue;
				}
				</script>';

        $string = '<input name="info['.$field.']" type="hidden" value="1">';
        $string .= $list_str;
        $string .= '<div id="'.$field.'" class="picList"></div><br/>';
        $string .= $str."<button class='btn' type='button' onclick='$field()';>选择图片</button>";
        return $string;

    }

/**
 * 发送短信
 */
    function send_message($url,$channel,$key,$mobile,$tpl_id,$tpl_value,$ispost=0) {

        $tmpArr = array($channel, $mobile, $tpl_id, $tpl_value ,$key);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $sign = sha1($tmpStr);

        $param['channel'] = $channel;
        $param['mobile'] = $mobile;
        $param['tpl_id'] = $tpl_id;
        $param['tpl_value'] = $tpl_value;
        $param['sign'] = $sign;
        //单发送
        if ($ispost==0){
            $params = '?';
            foreach($param as $key=>$val){
                $params .= $key."=".urlencode($val).'&';
            }
            $url = $url.$params;
            return http_get($url);
            //多条发送
        } elseif ($ispost==1){
            return http_post($url, $param);
        }
    }

    function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol)-1;

        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }

        return $str;
    }
