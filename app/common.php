<?php
// 应用公共文件

function delete_dir_file($dir_name)
{
    $result = false;
    if (is_dir($dir_name)) {
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DIRECTORY_SEPARATOR . $item)) {
                        delete_dir_file($dir_name . DIRECTORY_SEPARATOR . $item);
                    } else {
                        unlink($dir_name . DIRECTORY_SEPARATOR . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) { //删除空白目录
                $result = true;
            }
        }
    }
    return $result;
}

function subtext($text, $length)
{
    $text2 = strip_tags($text);
    if(mb_strlen($text2, 'utf8') > $length)
        return mb_substr($text2,0,$length,'utf8');
    return $text2;
}

function generateRandomString($length = 4) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

//验证session中的验证码和手机号码是否正确
function verifycode($code,$phone){
    if (is_null(session('xwx_sms_code')) || $code != session('xwx_sms_code')){
        return 0;
    }
    if (is_null(session('xwx_cms_phone')) || $phone != session('xwx_cms_phone')){
        return 0;
    }
    return 1;
}

function random_color(){
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(0, 255));
    }
    return $c;
}