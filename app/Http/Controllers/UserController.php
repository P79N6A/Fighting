<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserModel;

class UserController extends Controller
{   
    /**
     * 用户注册 
     * Author JiaXu
     * Date 2018-04-07
     */
    public function regist(Request $request)
    {
        $user_mobile = $request->input("user_mobile");
        $user_passwd = $request->input("user_passwd");

        $sms_code = $request->input("sms_code");

        $device_id = $request->input("device_id");
        $user_platform = $request->input("user_platform");

        if(empty($user_mobile) || preg_match("/^1[34578]{1}\d{9}$/",$user_mobile) == FALSE){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "手机号码格式不正确"
            );
            $this->_response($res);
        }

        if(empty($user_passwd) || strlen($user_passwd) != 32){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "密码格式不正确"
            );
            $this->_response($res);
        }

        if (empty($sms_code) || is_numeric($sms_code) == FALSE) {
            $res = array(
                "errNo" => "0002",
                "errMsg" => "短信验证码格式不正确"
            );
            $this->_response($res);
        }

        $UserModel = new UserModel();

        $ret = $UserModel->regist($user_mobile, $user_passwd, $sms_code, $device_id, $user_platform);

        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "注册成功"
        );

        $this->_response($res);

    }

    /**
     * 用户登录
     * Author Liuran
     * Date 2018-04-07
     */
    public function login(Request $request)
    {
        $user_mobile = $request->input('user_mobile');

        $login_type = $request->input('login_type');

        $sms_code = $request->input('sms_code');
        $user_passwd = $request->input('user_passwd');    

        if(empty($user_mobile) || preg_match("/^1[34578]{1}\d{9}$/",$user_mobile) == FALSE){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "手机号码格式不正确"
            );
            $this->_response($res);
        }

        if($login_type == 2 && (empty($user_passwd) || strlen($user_passwd) != 32)){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "密码格式不正确"
            );
            $this->_response($res);
        }

        if ($login_type == 1 && (empty($sms_code) || is_numeric($sms_code) == FALSE)){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "短信验证码格式不正确"
            );
            $this->_response($res);
        }

        if(empty($login_type)){
            $res = array(
                "errNo" => "0002",
                "errMsg" => "登录类型错误"
            );
            $this->_response($res);
        }

        $UserModel = new UserModel();

        $ret = $UserModel->login($user_mobile, $login_type, $sms_code, $user_passwd);

        if($ret == FALSE){
            $res = array(
                "errNo" => "0003",
                "errMsg" => "系统错误"
            );
            $this->_response($res);
        }elseif(isset($ret['errNo'])){
            $this->_response($ret);
        }

        $res = array(
            "errNo" => 0,
            "errMsg" => "登陆成功"
        );

        $this->_response($res);
    }

    /**
     * 接口安全
     */
    public function apijson()
    {
        // echo 1;die;
        $api = array(
            'v' => '1.0.1',
            'os' => 'android',
            'osv' => '6.0',
            'token' => '',
            'timestamp' => time(),
            'sk' => rand(1111,9999),
            'device_id' => '447769804451095',
            'device_name' => 'HUAWEI MT7-TL00',
            'sign' => ''
        );
        arsort($api);
        $str = '';
        foreach ($api as $key => $val) {
            $str.= $key . $val;
        }
        // var_dump($api);die;
        
        // Secret值 是MD5(amber32)
        // $sign = md5($str . '88068e33c78eb72f1b371c7110846085');
// $seret = ;
var_dump(config('secret'));die;
        // $url = "liuran.top&v";
    }
}